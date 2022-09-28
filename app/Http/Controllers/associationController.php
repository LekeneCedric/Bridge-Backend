<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\appartenir;
use App\Models\Association;
use App\Models\Mouvement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class associationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function galerieAssociation($id){
        $association = Association::find($id);
        $res = (object) array();
        $res->Association = $association->media;
    // Recuperation des images des mouvementss
        $mouvements = $association->mouvement;
        $mediaMouv = [];
        foreach($mouvements as $mouvement){
            foreach($mouvement->media as $mouvMedia){
          array_push($mediaMouv, $mouvMedia);
            }
        }
    // Recuperation des images des annonces 
        $annonces = $association->annonce;
        $annonceMouv=[];
        foreach($annonces as $annonce){
            foreach($annonce->media as $annMedia){
                array_push($annonceMouv,$annMedia);
            }
            
        }

        $res->Mouvements = $mediaMouv;
        $res->Annonces = $annonceMouv;
        return response()->json($res);
    }
    public function index()
    {
        $result = Association::all();
        foreach($result as $res){
        $appartenances = appartenir::where('association_id', $res->id)->get();
        $donateurs = [];
        $id_attente = [];
        $id_donateurs = [];
        foreach($appartenances as $appart){
            if($appart->valide ==1)
            {
                array_push($donateurs,$appart->donateur);
                array_push($id_donateurs,$appart->donateur->id);
            } 
            else{
                
                array_push($id_attente,$appart->donateur->id);
            }
        }
        $res->idDonateurs = $id_donateurs;
        $res->membres = $donateurs;
        $res->attenteId = $id_attente;
        $res->annonce;
        $res->mouvement;
        $res->recu;
        $res->media;
        $res->social;
        }
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
            'adresse'=>'required',
            'numero_contribuable',
            'password'=>'required|string|confirmed',
            'nom_responsable'=>'required',
            'longitude'=>'required',
            'latitude'=>'required',
            'description'=>'required|string'
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
        $appartenances = appartenir::where('association_id', $id)->get();
        $donateurs = [];
        $id_attente = [];
        $attente=[];
        $id_donateurs = [];
        foreach($appartenances as $appart){
            if($appart->valide ==1)
            {
                array_push($donateurs,$appart->donateur);
                array_push($id_donateurs,$appart->donateur->id);
            } 
            else{
                array_push($attente,$appart->donateur);
                array_push($id_attente,$appart->donateur->id);
            }
             
        }
        $Association->idDonateurs = $id_donateurs;
        $Association->membres = $donateurs;
        $Association->attenteId = $id_attente;
        $Association->attentes = $attente;
        $Association->annonce;
        $Association->mouvement;
        $Association->besoin;
        foreach($Association->besoin as $besoin){
            $besoin->AssoDon;
        }
        $Association->recu;
        $Association->media;
        $Association->social;
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
