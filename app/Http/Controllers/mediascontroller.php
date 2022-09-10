<?php

namespace App\Http\Controllers;

use App\Models\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class mediascontroller extends Controller
{
    public function index (){
        $response=media::all();
        return response()->json($response);
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'file' => 'required', 
        ]);
        if($request->hasfile('file')) {
                try {
                    $fileName = time().'_'.$request->file('file')->getClientOriginalName();
               $extension = $request->file('file')->getClientOriginalExtension();
               $filePath = $request->file('file')->storeAs('medias', $fileName, 'public');
               $media = media::create(array_merge($request->all(),
               [
                   'filePath'=>$filePath,
                   'extension'=>$extension,
                   'fileName'=>$fileName,
               ]));
                } catch (\Throwable $th) {
                    return response()->json($validator->errors(), 400);
                }
               
           }
           else{
            return response()->json($validator->errors(), 400);
           }
        return response()->json([
            'message'=>'file(s) uploaded successfully',
        ]);

    }

    public function show($id){
      $media = media::find($id);
    }

    public function destroy($id){
    $media = media::find($id);
    $media->delete();
    return response()->json([
        'message'=>'Media deleted successfully'
    ]);
    }
    public function showDonateurMedia($id){
        $media=media::where('donateur_id', $id)->get();
        if(count($media)<1){
            return response()->json([
                'message'=>'Can\'t find media'
            ]);
        }
        return response()->json($media);
    }
    public function showAnnonceMediaMedia($id){
        $media=media::where('annonce_id', $id)->get();
        if(count($media)<1){
            return response()->json([
                'message'=>'Can\'t find media'
            ]);
        }
        return response()->json($media);
    }

    public function showAssociationMedia($id){
        $media=media::where('association_id', $id)->get();
        if(count($media)<1){
            return response()->json([
                'message'=>'Can\'t find media'
            ]);
        }
        return response()->json($media);
    }
    public function showDonMedia($id){
        $media=media::where('don_id', $id)->get();
        if(count($media)<1){
            return response()->json([
                'message'=>'Can\'t find media'
            ]);
        }
        return response()->json($media);
    }
    public function showMouvementMedia($id){
        $media=media::where('mouvement_id', $id)->get();
        if(count($media)<1){
            return response()->json([
                'message'=>'Can\'t find media'
            ]);
        }
        return response()->json($media);
    }
}
