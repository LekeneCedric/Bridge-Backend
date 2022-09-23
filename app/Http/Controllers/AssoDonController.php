<?php

namespace App\Http\Controllers;

use App\Models\AssoDon;
use Illuminate\Http\Request;

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
}
