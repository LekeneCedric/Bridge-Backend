<?php

namespace App\Http\Controllers;

use App\Models\Don;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class donController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Don::all(),200);
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
            'contenu'=>'required',
            'titre'=>'required',
            'images'=>'required',
            'category'=>'required',
            'etat'=>'required',
            'description'=>'required',
            'longitude'=>'required',
            'latitude'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $Don = Don::create(
            array_merge($validator->validated()             
        ));

        return response()->json(
            [
                'Don'=>'Don created successfully',
                'Don'=>$Don
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
        $Don = Don::find($id);
        if(is_null($Don)){
            return response()->json([
                'Don'=>'not Found!'
            ],200);
        }
        return response()->json($Don,200);
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
        $Don = Don::find($id);
        if(is_null($Don)){
            return response()->json([
                'Don'=>'Not Found!'
            ],200);
        }
        $Don->update($request->all());
        return response()->json([
            'Don'=>'modification successfully',
            'Don'=>$Don
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
        $Don = Don::find($id);
        Don::destroy($id);
        return response()->json([
            'Don'=>'Don deleted successfully',
            'Don'=>$Don
        ], 200);
    }
}
