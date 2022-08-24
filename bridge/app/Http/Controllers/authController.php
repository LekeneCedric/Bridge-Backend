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
            'age'=>'required|int',
            'sexe'=>'required',
            'contact'=>'required|int',
            'pays'=>'required|string',
            'ville'=>'required|string',
            'password'=>'required|string|confirmed',
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
        $token = $donateur->createToken('myapptoken')->plainTextToken; 
        $response = [
            'user' => $donateur,
            'token' => $token
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
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
