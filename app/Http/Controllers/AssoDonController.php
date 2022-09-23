<?php

namespace App\Http\Controllers;

use App\Models\AssoDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssoDonController extends Controller
{
   public function index(){

    $donAssociations = AssoDon::all();
    foreach($donAssociations as $don){
      $don->association;
      $don->donateur;
      $don->besoin;
    }
    return response()->json($donAssociations,200);
   }
   public function AssociationDons($id){
      $dons = AssoDon::where('association_id',$id)->get();
      foreach($dons as $don){
         $don->association;
         $don->donateur;
         $don->besoin;
      }
      return response()->json($dons,200);
   }
   public function AssociationDonsDonateur($id_association,$id_donateur){
      $dons = AssoDon::where('association_id',$id_association)->where('donateur_id',$id_donateur)->get();
      foreach($dons as $don){
         $don->association;
         $don->donateur;
      }
   }
   public function store(Request $request){
     $validator = Validator::make($request->all(),[
      'association_id'=>'required|int',
        'donateur_id'=>'required|int',
        'besoin_id'=>'required|int',
        'titre'=>'required|string',
        'category'=>'required|string',
        'etat'=>'required|string',
        'adresse'=>'required|string',
        'description'=>'required|string',
        'quantite'=>'required|int',
        'longitude'=>'required',
        'latitude'=>'required',
        'verifie'=>'required',
        'valide'=>'required'
     ]);
     if($validator->fails()){
      return response()->json($validator->errors(),400);
     }
     $assoDon = AssoDon::create(
      array_merge($validator->validated())
     );
     return response()->json([
      'message' => 'AssoDon added successfully',
      'Don'=>$assoDon
     ]);
   }
}
