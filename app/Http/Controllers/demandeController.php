<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class demandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demandes = Demande::where('resolu','<',1)->orderBy('created_at','DESC')->get();
        foreach ($demandes as $demande){
            $demande->donateur= $demande->donateur;
            $demande->donateur->photoprofil = $demande->donateur->media;
        }
        return response()->json($demandes,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDemandesDonateur($id){
        $result = Demande::where('donateur_id', $id)->get();
        if(count($result)<1){
            return response()->json([
                'message'=>'Not Found',
            ]);
        }
        return response()->json($result,200);
    }
    public function showDemandesCategory($name){
        $result = Demande::where('category','like','%'.$name.'%')->get();
        if(count($result)<1){
            return response()->json([
                'message'=>'Not Found',
            ]);
        }
        return response()->json($result,200);
    }
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
            'donateur_id'=>'required|int',
            'title'=>'required|string',
            'contenu'=>'required|string',
            'adresse'=>'required|string',
            'category'=>'required|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $Demande = Demande::create(
            array_merge($validator->validated()             
        ));

        return response()->json(
            [
                'Demande'=>'Demande created successfully',
                'demande'=>$Demande
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
        $Demande = Demande::find($id);
        if(is_null($Demande)){
            return response()->json([
                'Demande'=>'not Found!'
            ],200);
        }
        else{
            $Demande->donateur = $Demande->donateur;
            $Demande->donateur->media;
        }
        return response()->json($Demande,200);
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
        $Demande = Demande::find($id);
        if(is_null($Demande)){
            return response()->json([
                'Demande'=>'Not Found!'
            ],200);
        }
        $Demande->update($request->all());
        return response()->json([
            'Demande'=>'modification successfully',
            'Demande'=>$Demande
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
        $Demande = Demande::find($id);
        Demande::destroy($id);
        return response()->json([
            'Demande'=>'Demande deleted successfully',
            'Demande'=>$Demande
        ], 202);
    }
}
