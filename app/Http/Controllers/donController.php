<?php

namespace App\Http\Controllers;

use App\Models\Don;
use App\Models\Message;
use App\Models\reserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class donController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function nbreservations($iddon){
     $reservation = reserver::where('don_id', $iddon)->get();
     if(count($reservation)<1){
        return response()->json([
            'message'=>'Aucune reservation pour ce don'
        ]);
     }
     else{
        return response()->json([
            'nombre'=>count($reservation),
            'reservations'=>$reservation
        ]);
     }
    }
    public function reserver(Request $request)
    {
        $condition = reserver::where('don_id',$request->don_id)->where('donateur_id',$request->donateur_id)->get();
        if(count($condition)<1){
        $validator=Validator::make($request->all(),[
            'donateur_id'=>'required',
            'don_id'=>'required'
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
     $don = Don::find($request->don_id);
     $don->nombre_reserve = $don->nombre_reserve+1;
     $don->save();
        $reservation = reserver::create(array_merge($request->all()));
        return response()->json(
            [
                'message'=>'nouvelle reservation',   
            ],200
        );
     return response()->json($reservation,200);}
     else{
        return response()->json([
            'message'=>'reservation existante'
        ]);
     }
    }
    public function getDonSimilaire($id,$category){
        $don = Don::where('category',$category)->where('id','!=',$id)->get();
        if(is_null($don)){
            return response()->json([
                'message' => 'Not Found',
              ]);
        }
        foreach($don as $d){
            $d->media;
        }
        return $don;
    }
    public function getDonFiltreByCategory($category){
        $donfiltre = Don::where('category','=',$category)->paginate(6);

        if(count($donfiltre)<1){
         $response = response()->json([
             'error'=>'Aucun don correspondant a vos filtre'
         ]);
         return $response;
        }
        foreach($donfiltre as $don){
         $don->media = $don->media;
         $don->donateur = $don->donateur;
     }
     return response()->json($donfiltre,200);
    }
    public function getDonFiltreByEtat($etat){
        $donfiltre = Don::where('etat','=',$etat)->paginate(6);

        if(count($donfiltre)<1){
         $response = response()->json([
             'error'=>'Aucun don correspondant a vos filtre'
         ]);
         return $response;
        }
        foreach($donfiltre as $don){
         $don->media = $don->media;
         $don->donateur = $don->donateur;
     }
     return response()->json($donfiltre,200);
    }
    public function getDonWithCategoryAndEtat($category,$etat){
       $donfiltre = Don::where('category','=',$category)->where('etat','=',$etat)->paginate(6);

       if(count($donfiltre)<1){
        $response = response()->json([
            'error'=>'Aucun don correspondant a vos filtre'
        ]);
        return $response;
       }
       foreach($donfiltre as $don){
        $don->media = $don->media;
        $don->donateur = $don->donateur;
    }
    return response()->json($donfiltre,200);

    }
    public function getmesdons($id){
        $don = Don::where('donateur_id', $id)->get();
        if(is_null($don)){
           return response()->json([
             'message' => 'Not Found',
           ]);
        }
        $result=[];
        foreach($don as $do){
            $do['association_name'] = $do->association->name;
            array_push($result, $do);
        } 
        return response()->json([
            'message' => 'success',
            'data' => $result
        ]);
    }
    public function index()
    {
        $dons = Don::paginate(6);
        foreach($dons as $don){
            $don->media = $don->media;
            $don->donateur = $don->donateur;
        }
        return response()->json($dons,200);
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
        'donateur_id'=>'required',
        'titre'=>'required',
        'category'=>'required',
        'etat'=>'required',
        'adresse'=>'required',
        'description'=>'required',
        'longitude'=>'required',
        'latitude'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $don = Don::create(array_merge($request->all()));
        return response()->json(
            [
                'message'=>'Don created successfully',
                'Don'=>$don
                
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
        $Don->media = $Don->media;
        $Don->donateur = $Don->donateur;
        $Don->donateur->media = $Don->donateur->media;
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
