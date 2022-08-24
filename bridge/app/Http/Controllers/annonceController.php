<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class annonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Annonce::all(),200);
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
           'association_id'=>'required',
           'title'=>'required',
           'intitule'=>'required',
           'category'=>'required',
           'nbvue'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $Annonce = Annonce::create(
            array_merge($validator->validated()             
        ));

        return response()->json(
            [
                'Annonce'=>'Annonce created successfully',
                'annonce'=>$Annonce
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
        $Annonce = Annonce::find($id);
        if(is_null($Annonce)){
            return response()->json([
                'Annonce'=>'not Found!'
            ],200);
        }
        return response()->json($Annonce,200);
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
        $Annonce = Annonce::find($id);
        if(is_null($Annonce)){
            return response()->json([
                'Annonce'=>'Not Found!'
            ],200);
        }
        $Annonce->update($request->all());
        return response()->json([
            'Annonce'=>'modification successfully',
            'Annonce'=>$Annonce
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
        $Annonce = Annonce::find($id);
        Annonce::destroy($id);
        return response()->json([
            'Annonce'=>'Annonce deleted successfully',
            'Annonce'=>$Annonce
        ], 202);
    }
}
