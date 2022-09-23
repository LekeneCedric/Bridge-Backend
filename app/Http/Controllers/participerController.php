<?php

namespace App\Http\Controllers;

use App\Models\participer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class participerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participer = participer::all();
        return $participer;
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
    public function imParticipate($myId,$mouvid){
        $result = participer::where('mouvement_id',$mouvid)->where('donateur_id',$myId)->get();
        if(count($result)<1){
          return response()->json(['message'=>'non_reserve'],200);
        }
        else{
            return response()->json(['message'=>'reserve'],200);
        }
    }
    public function annulerParticipation($myId,$mouvid){
        $result = participer::where('mouvement_id',$mouvid)->where('donateur_id',$myId)->delete();
        return response()->json($result);
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'mouvement_id'=>'required',
            'donateur_id'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $participer = participer::create(
            array_merge($validator->validated()
        ));

        return response()->json(
            [
                'message'=>'Register to participation successfully',
                'Mouvement'=>$participer->mouvement
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
        $participer = participer::find($id);
        if(is_null($participer)){
            return response()->json([
                'message'=>'Not Found!'
            ],200);
        }
        return response()->json($participer,200);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $participation = participer::find($id);
        if(is_null($participation)){
            return response()->json([
                'message'=>'Not found !'
            ],200);
        }
        participer::destroy($id);
        return response()->json([
            'message'=>'remove Successfully'
        ],200);
    }
}
