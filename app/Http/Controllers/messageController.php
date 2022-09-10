<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Don;
use App\Models\Donateur;
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

    public function getLastMessage($id_donateur,$id_receiver,$id_don){
       
      $messages = Message::where('donateur_id',$id_donateur)->where('receiver_id',$id_receiver)->where('don_id',$id_don)->get();
      if(count($messages) > 0)
      {
        $mess = json_decode(json_encode($messages), true);
        $mess = array_reverse($mess);
        $lastMessage = $mess[0];
        return $lastMessage;
    }else{return response()->json(['message' =>'not found']);}
    } 
    public function interesses($id_don){
     $temp=0;
     $temp=[];
     $don = Don::where('id', $id_don)->get();
     if(count($don)<1){
        return response()->json([
            'message'=>'not found',
        ]);
     }
     else{
        $messages = $don[0]->message;
        foreach($messages as $message){
            $pack1 = (object) array(
                'id_demande'=>$message['demande_id'],
                'id_receiver'=>$message['receiver_id'],
                'id_donateur'=>$message['donateur_id'],
               ); 
               $pack2 = (object) array(
                'id_demande'=>$message['demande_id'],
                'id_receiver'=>$message['donateur_id'],
                'id_donateur'=>$message['receiver_id'],
               );
               if(
                in_array($pack1,$temp)||in_array($pack2,$temp)
               ){
                  continue;
               }
               else{
                  array_push($temp,$pack1);
                  $elt = (object) array(
                      
                      'id_demande' => $message->demande_id,
                      'id_donateur'=>$message->donateur_id,
                      'id_receiver' => $message->receiver_id,
                      'id_demande' => $message->demande_id,
                      'sender'=>$message->sender,
                  'receiver'=>$message->receiver
                  );
               }
        }
        return response()->json([
            'nb'=>count($temp),
            'messages'=>$messages
        ]);
     }
     
    }
    public function getDiscussionsDemandes($myid){
        $salons=[];
        $temp = [];
        $i=0;
        $messages = Message::where('donateur_id',$myid)->orwhere('receiver_id',$myid)->get();

            foreach($messages as $message){
            
            
                if($message['demande_id']!=null){
                    $demand = $message->demande->donateur->id;
                    $resolu = $message->demande->resolu;
               $pack1 = (object) array(
                'id_demande'=>$message['demande_id'],
                'id_receiver'=>$message['receiver_id'],
                'id_donateur'=>$message['donateur_id'],
               ); 
               $pack2 = (object) array(
                'id_demande'=>$message['demande_id'],
                'id_receiver'=>$message['donateur_id'],
                'id_donateur'=>$message['receiver_id'],
               );
               if(
                in_array($pack1,$temp)||in_array($pack2,$temp)
               ){
                  continue;
               }
               else{
                  array_push($temp,$pack1);
                  $elt = (object) array(
                      'resolu'=>$resolu,
                      'createur_demande'=>$demand,
                      'id_demande' => $message->demande_id,
                      'id_donateur'=>$message->donateur_id,
                      'id_receiver' => $message->receiver_id,
                      'id_demande' => $message->demande_id,
                      'sender'=>$message->sender,
                      'receiver'=>$message->receiver
                  );
                  array_push($salons,$elt);
               }
            }
             $i+=1;
            }
            return response()->json($salons);
        
    }
    public function getDiscussionsDon($myid){
        $salons=[];
        $temp = [];
        $i=0;
        $messages = Message::where('donateur_id',$myid)->orwhere('receiver_id',$myid)->get();
      
             foreach($messages as $message){
                $donat = $message->don;
                if($message['don_id']!=null){
               $pack1 = (object) array(
                'id_don'=>$message['don_id'],
                'id_receiver'=>$message['receiver_id'],
                'id_donateur'=>$message['donateur_id'],
               ); 
               $pack2 = (object) array(
                'id_don'=>$message['don_id'],
                'id_receiver'=>$message['donateur_id'],
                'id_donateur'=>$message['receiver_id'],
               );
               if(
                in_array($pack1,$temp)||in_array($pack2,$temp)
               ){
                  continue;
               }
               else{
                  array_push($temp,$pack1);
                  $elt = (object) array(
                    'reserver'=>$message->don->nombre_reserve,
                    'disponible'=>$message->don->disponible,
                      'createur_don'=>$donat['donateur_id'],
                      'id_don' => $message->don_id,
                      'id_donateur'=>$message->donateur_id,
                      'id_receiver' => $message->receiver_id,
                      'id_demande' => $message->demande_id,
                      'sender'=>$message->sender,
                      'receiver'=>$message->receiver
                  );
                  array_push($salons,$elt);
               }
            }
             $i+=1;
            }
            
            return response()->json($salons);
       
    }
    public function showMyMessages($myId){
        $message = Message::where('donateur_id',$myId)->orwhere('receiver_id',$myId)->get();
    }
    public function getConversationDon($id_sendr,$id_reicv,$id_don){
        $don = Don::find($id_don);
        if($don){
        $createur_don_id = $don->donateur->id;
        $message1 = Message::where('donateur_id','=',$id_sendr)->where('receiver_id','=',$id_reicv)->where('don_id','=',$id_don)->get();
        $message2 = Message::where('donateur_id','=',$id_reicv)->where('receiver_id','=',$id_sendr)->where('don_id','=',$id_don)->get();        // $result = array_merge(...$messages1,...$messages2);
        
            return response()->json([
                'message' => 'conversation get successfully',
                'createur_don_id'=>$createur_don_id,
                'data1'=>$message1,
                'data2'=>$message2
            ]);
        }
        else{
            return response()->json([
                'message' => 'conversation get failed / Don innexistant',
            ]);
        }
    }
    public function getConversationDemande($id_sendr,$id_reicv,$id_demande){
        $demande = Demande::find($id_demande);
        
        if($demande){
        $createur_demande_id = $demande->donateur->id;
        $message1 = Message::where('donateur_id','=',$id_sendr)->where('receiver_id','=',$id_reicv)->where('demande_id','=',$id_demande)->get();
        $message2 = Message::where('donateur_id','=',$id_reicv)->where('receiver_id','=',$id_sendr)->where('demande_id','=',$id_demande)->get();        // $result = array_merge(...$messages1,...$messages2);
        
            return response()->json([
                'message' => 'conversation get successfully',
                'createur_demande_id' => $createur_demande_id,
                'data1'=>$message1,
                'data2'=>$message2
            ]);
        }
        else{
            return response()->json([
                'message' => 'conversation get failed / Demande innexistante',
            ]);
        }
       
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
            'sender'=>'required|int',
            'receiver'=>'required|int',
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
