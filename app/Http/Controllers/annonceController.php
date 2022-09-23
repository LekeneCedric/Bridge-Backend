<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
class annonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function isLikeAnnonce($id_annonce,$id_donateur){
    
    // }
    // public function likeAnnonce($id_annonce){
    //     $annonce = Annonce::where('id',$id_annonce)->get();
    //     $like_actuelle = $annonce[0]->like;
    //     $like_update = $like_actuelle+1;
    //     $annonce = Annonce::where('id',$id_annonce)->update([
    //         'like'=>$like_update
    //        ]);
    //        return response()->json($annonce);
    // }

    public function index($id_donateur)
    {  $annonces = Annonce::all();
        foreach($annonces as $annonce){
            $annonce->association->media;
            $annonce->media;
            $likes = Like::where('annonce_id',$annonce->id)->get();
            $nbLike = count($likes);
            $annonce->nbLikes = $nbLike;
            $res = Like::where('donateur_id',$id_donateur)->where('annonce_id',$annonce->id)->get();
            if(count($res) > 0)
            {
                $annonce->isLike = true;
            }
            else
            {
                $annonce->isLike = false;
            }
        }
        return response()->json($annonces,200);
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
           'nbvue'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
            $Annonce = Annonce::create(
                array_merge($validator->validated()));

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
    public function show($id,$id_donateur)
    {
        $Annonce = Annonce::find($id);
        if(is_null($Annonce)){
            return response()->json([
                'Annonce'=>'not Found!'
            ],200);
        }
        $Annonce->association->media;
        $Annonce->media;
        $likes = Like::where('annonce_id',$Annonce->id)->get();
        $nbLike = count($likes);
        $Annonce->nbLikes = $nbLike;
        $res = Like::where('donateur_id',$id_donateur)->where('annonce_id',$Annonce->id)->get();
        if(count($res) > 0)
        {
            $Annonce->isLike = true;
        }
        else
        {
            $Annonce->isLike = false;
        }
        return response()->json($Annonce,200);
    }
    public function showAnnoncesAssociation($id){
        $result = Annonce::where('association_id',$id)->get();
        if(count($result)<1){
            return response()->json([
                'message'=>'Not Found!'
            ]);
        }
        foreach($result as $annonce){
            $annonce->media;
            $annonce->association->media;
            $likes = Like::where('annonce_id',$annonce->id)->get();
            $nbLike = count($likes);
            $annonce->nbLikes = $nbLike;
        }
        return response()->json($result,200);
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
        $Annonce->save();
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
