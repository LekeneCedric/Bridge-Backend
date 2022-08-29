<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class associationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Association::paginate(10);
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
            'type'=>'required',
            'name'=>'required',
            'category'=>'required',
            'pays'=>'required',
            'ville'=>'required',
            'contact'=>'required',
            'email'=>'required',
            'adresse'=>'required',
            'siteweb'=>'required',
            'numero_contribuable',
            'password'=>'required|string|confirmed',
            'nom_responsable'=>'required',
            'longitude'=>'required',
            'latitude'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $Association = Association::create(
            array_merge($validator->validated(),
            [
                'password'=>bcrypt($request->password)
            ]
        ));

        return response()->json(
            [
                'message'=>'Association created successfully',
                'Association'=>$Association
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
        $Association = Association::find($id);
        if(is_null($Association)){
            return response()->json([
                'message'=>'Not Found!'
            ],200);
        }
        return response()->json($Association,200);
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
        $Association = Association::find($id);
        if(is_null($Association)){
            return response()->json([
                'message'=>'Not Found!'
            ],200);
        }
        $Association->update($request->all());
        return response()->json([
            'message'=>'modification successfully',
            'Association'=>$Association
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
        $Association = Association::find($id);
        Association::destroy($id);
        return response()->json([
            'message'=>'Association deleted successfully',
            'Association'=>$Association
        ], 202);
    }
}
