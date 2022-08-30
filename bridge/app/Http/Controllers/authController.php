<?php

namespace App\Http\Controllers;

use App\Models\Donateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class authController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'surname'=>'required|string',
            'email'=>'required|string|email|max:100|unique:donateurs',
            'date_naissance'=>'required|date',
            'sexe'=>'required',
            'contact'=>'required|int',
            'pays'=>'required|string',
            'ville'=>'required|string',
            'password'=>'required|string|confirmed',
            'imageProfil'=>'required'    
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $donateur = Donateur::create(
            array_merge($validator->validated(),
            [
                'password'=>bcrypt($request->password)
            ]
            ));
        $token = $donateur->createToken('tokenFamily')->plainTextToken; 
        $response = [
            'token' => $token,
            'user'  => $donateur
        ];
        return response()->json($response,201);

    }
    public function login(Request $request){
        
        $validator=Validator::make($request->all(),[
            
            'email'=>'required|string|email|max:100',
            'password'=>'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $donateur = Donateur::where('email',$request->email)->first();
        if(!$donateur || !Hash::check($request->password , $donateur->password))
        {
            return response()->json(['message'=>'Invalid account'],401);
        }
        $token = $donateur->createToken('myapptoken')->plainTextToken; 
        $response = [
            'message'=>'welcome'.$donateur->name,
            'user' => $donateur,
            'token' => $token
        ];
        return response()->json($response,201);

    } 

    public function logout(Request $request){
        Auth::user()->tokens->each(function($token){
            $token->delete();
            });
            return response()->json([
                'message'=>'logout successfully'
            ],200);
    }
}
