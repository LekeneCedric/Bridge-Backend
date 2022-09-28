<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    //
    public function index(){
        $likes = Like::all();
        return response()->json(array('likes' => $likes));
    }
    public function get_likes_annonce($id_annonce){
        $likes = Like::where('annonce_id',$id_annonce)->get();
        foreach($likes as $like){
            $like->donateur;
        }
        return response()->json($like);
    }
    public function liker_annonce(Request $request){
     $validator = Validator::make($request->all(),[
      'donateur_id'=>'required',
      'annonce_id'=>'required',
     ]);
     if($validator->fails()){
        return response()->json($validator->errors(),400);
     }
     $like = Like::create(array_merge($validator->validated()));
     return response()->json(
        [
            'like'=>$like,
            'likeur'=>$like->donateur()
        ]
     );

    }
    public function dislike_annonce($id_annonce,$id_donateur){
        $like  = Like::where('annonce_id',$id_annonce)->where('donateur_id',$id_donateur)->delete();
        return response()->json([
          'message'=>'dislike',
          'data'=>$like
        ]);
    }
    public function mesAnnoncesFavoris($id_donateur){
        $likes  = Like::where('donateur_id',$id_donateur)->get();
       
        foreach ($likes as $like){
            $nblikes = Like::where('annonce_id',$like->annonce->id)->get();
            $nbLike = count($nblikes);
            $like->annonce->nbLikes = $nbLike;
            $like->annonce->media;
            $like->annonce->association->media;
            
        }
        return response()->json($likes);
    }
    
}
