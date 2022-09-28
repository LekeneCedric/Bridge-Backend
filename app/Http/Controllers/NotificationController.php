<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'donateur_id'=>'required',
            'title'=>'required',
            'message'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $notification = notification::create(
            array_merge($validator->validated())
        );
        return response()->json([
            'notification'=>$notification
        ],200);
    }
    public function getNotificationDonateur($donateur_id){
         $notifications = notification::where('donateur_id',$donateur_id)->get();
         return response()->json($notifications,200);
    } 
}
