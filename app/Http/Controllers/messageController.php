<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class messageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDiscussionsDon($myid){
        $salons=[];
        $temp = [];
        $messages = Message::where('donateur_id',$myid)->orwhere('receiver_id',$myid)->get();
        foreach($messages as $message){
         if(in_array($message->don_id,$temp)){
            continue;
         }
         else{
            array_push($temp,$message->don_id);
            $elt = (object) array(
                'id_don' => $message->don_id,
                'id_donateur'=>$message->donateur_id,
                'id_receiver' => $message->receiver_id,
                'id_demande' => $message->demande_id
            );
            array_push($salons,$elt);
         }
        }
        
        return response()->json($salons);
    }
    public function showMyMessages($myId){
        $message = Message::where('donateur_id',$myId)->orwhere('receiver_id',$myId)->get();
    }
    public function getConversatioDon($id_sendr,$id_reicv,$id_don){
        
        $messages = Message::where('donateur_id','=',$id_sendr,'AND','receiver_id','=',$id_reicv)
        ->orWhere('receiver_id','=',$id_sendr,'and','donateur_id','=',$id_reicv)
        ->where('don_id','=',$id_don)->get();
        // $result = array_merge(...$messages1,...$messages2);
        return response()->json([
            'message' => 'conversation get successfully',
            'data'=>$messages
        ]);
    }
    public function index()
    {
        //
        return response()->json(Message::all(),200);
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
            'donateur_id'=>'required|int',
            'receiver_id'=>'required|int',
            'contenu'=>'required|string',
            'vu'=>'required|int',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $Message = Message::create(
            array_merge($request->all()));

        return response()->json($Message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $message = Message::find($id);
        if(is_null($message)){
            return response()->json([
                'message'=>'not Found!'
            ],200);
        }
        return response()->json($message,200);
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
         
        $Message = Message::find($id);
        if(is_null($Message)){
            return response()->json([
                'message'=>'Not Found!'
            ],200);
        }
        $Message->update($request->all());
        return response()->json([
            'message'=>'modification successfully',
            'Message'=>$Message
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
        $Message = Message::find($id);
        Message::destroy($id);
        return response()->json([
            'message'=>'Message deleted successfully',
            'Message'=>$Message
        ], 202);
    }
}
