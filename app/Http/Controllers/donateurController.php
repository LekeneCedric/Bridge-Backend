<?php

namespace App\Http\Controllers;

use App\Models\appartenir;
use App\Models\Association;
use App\Models\Donateur;
use App\Models\participer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $result = Donateur::paginate(5);
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
        $dons = count($donateur->don);
        $donateur->dons = $dons;
        if($dons<=2){
        $donateur->statut = 'bebe Bridger';
        }
        else if($dons>2 && $dons<=10){
            $donateur->statut = 'petit Bridger';
        }
        else if($dons>10 && $dons<=25){
            $donateur->statut = 'Ado Bridger';
        }
        else if($dons>25 && $dons<=50){
            $donateur->statut = 'adulte Bridger';
        }
        else if($dons>50 && $dons<=100){
            $donateur->statut = 'costaud Bridger';
        }
        else if($dons>100 && $dons<=500){
            $donateur->statut = 'Roi des Bridger';
        }
        else if($dons>500 && $dons<=1000){
            $donateur->statut = 'dieu Bridger';
        }
        
        $donateur->media = $donateur->media;
        $response=$donateur;
        return response()->json($response);
        
    }
    public function showdonateursAssociation($id){
      $association = appartenir::where('association_id','=',''.$id.'')->get();
      $response = [];
      foreach($association as $asso){
       array_push($response,$asso->donateur);
      }
      return response()->json($response,200);
    }
    public function showdonateurMouvements($id){
        $mouvements = participer::where('mouvement_id','=',$id)->get();
        $reponse=[];
        foreach( $mouvements as $mov){
            array_push($reponse,$mov->donateur);
        }
        return response()->json($reponse,200);
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