<?php

namespace App\Http\Controllers;

use App\Models\Donateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class donateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Donateur::all();
        //
        return response()->json($result,200);
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
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'surname'=>'required|string',
            'email'=>'required|string|email|max:100|unique:donateurs',
            'age'=>'required|int',
            'sexe'=>'required',
            'contact'=>'required|int',
            'pays'=>'required|string',
            'ville'=>'required|string',
            'password'=>'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $donateur = Donateur::create(
            array_merge($validator->validated(),
            [
                'password'=>bcrypt($request->password),
                'vpassword'=>$request->password
            ]
        ));

        return response()->json(
            [
                'message'=>'Donateur created successfully',
                'donateur'=>$donateur
            ],200
        );

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
        $donateur = Donateur::find($id);
        if(is_null($donateur)){
            return response()->json([
                'message'=>'Not Found!'
            ],200);
        }
        return response()->json($donateur,200);
        
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
        
        $donateur = Donateur::find($id);
        if(is_null($donateur)){
            return response()->json([
                'message'=>'Not Found!'
            ],200);
        }
        $donateur->update($request->all());
        return response()->json([
            'message'=>'modification successfully',
            'donateur'=>$donateur
        ],200);
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
        $donateur = Donateur::find($id);
        Donateur::destroy($id);
        return response()->json([
            'message'=>'Donateur deleted successfully',
            'donateur'=>$donateur
        ], 202);
    }
}