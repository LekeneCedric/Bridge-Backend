<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
class besoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function besoins_non_resolus(){
        $besoins = Besoin::where('resolu','0')->get();
        if(count($besoins) < 1){
            return response()->json([
                'message' => 'No besoin found.'
            ]);
        }
        $result = [];
        foreach($besoins as $besoin){
            $besoin->association->media;
          array_push($result, $besoin);
        }
        return response()->json($result);
    }
    public function besoins_resolus(){
        $besoins = Besoin::where('resolu','1')->get();
        if(count($besoins) < 1){
            return response()->json([
                'message' => 'No besoin found.'
            ]);
        }
        $result = [];
        foreach($besoins as $besoin){
            $besoin->association->media;
          array_push($result, $besoin);
        }
        return response()->json($result);
    }
    public function besoins_association($id){
        $besoins = Besoin::where('association_id',$id)->get();
        if(count($besoins) < 1){
            return response()->json([
                'message' => 'this association dont have requiert'
            ]);
        }
        $result = [];
        foreach($besoins as $besoin){
            $besoin->association->media;
          array_push($result, $besoin);
        }
        return response()->json($result); 
    }
    public function besoins_non_resolu_association($id){
        $besoins = Besoin::where('association_id',$id)->where('resolu','0')->get();
        if(count($besoins) < 1){
            return response()->json([]);
        }
        $result = [];
        foreach($besoins as $besoin){
            $besoin->association->media;
          array_push($result, $besoin);
        }
        return response()->json($result); 
    }
    public function besoins_resolu_association($id){
        $besoins = Besoin::where('association_id',$id)->where('resolu','1')->get();
        if(count($besoins) < 1){
            return response()->json([]);
        }
        $result = [];
        foreach($besoins as $besoin){
            $besoin->association->media;
          array_push($result, $besoin);
        }
        return response()->json($result); 
    }
    public function index()
    {
        $besoins = Besoin::where('quantite_actuelle','<','quantite')->orderBy('created_at','DESC')->get();
        foreach ($besoins as $besoin){
            $besoin->association->media;
        }
        return response()->json($besoins,200);
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
            'association_id'=>'required|int',
            'title'=>'required|string',
            'contenu'=>'required|string',
            'category'=>'required|string',
            'attente'=>'required',
            'resolu'=>'required',
            'quantite'=>'required',
            'quantite_actuelle'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $Besoin = Besoin::create(
            array_merge($validator->validated()             
        ));

        return response()->json(
            [
                'Besoin'=>'Besoin created successfully',
                'besoin'=>$Besoin
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
        $Besoin = Besoin::find($id);
        if(is_null($Besoin)){
            return response()->json([
                'Besoin'=>'not Found!'
            ],200);
        }
        $Besoin->association->media;
        return response()->json($Besoin,200);
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
        $Besoin = Besoin::find($id);
        if(is_null($Besoin)){
            return response()->json([
                'Besoin'=>'Not Found!'
            ],200);
        }
        $Besoin->update($request->all());
        return response()->json([
            'Besoin'=>'modification successfully',
            'Besoin'=>$Besoin
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
        $Besoin = Besoin::find($id);
        Besoin::destroy($id);
        return response()->json([
            'Besoin'=>'Besoin deleted successfully',
            'Besoin'=>$Besoin
        ], 202);
    }
}
