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
            array_merge($validator->validated()             
        ));

        return response()->json(
            [
                'message'=>'Message created successfully',
                'donateur'=>$Message
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
