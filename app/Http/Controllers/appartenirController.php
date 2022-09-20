<?php

namespace App\Http\Controllers;

use App\Models\appartenir;
use App\Models\Donateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class appartenirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $result = appartenir::all();
       return $result;
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
    public function association_member_list($id_association){
        $appartenances = appartenir::where('association_id', $id_association)->get();
        $member=[];
        foreach($appartenances as $appart){
          array_push($member, $appart->donateur->media);
        }
        
        return response()->json($appartenances);        
    }
    public function non_association_member_list($id_association){
        $appartenances = appartenir::where('association_id', $id_association)->get();
        $users = Donateur::all();
        $members=[];
        $non_members=[];
        foreach($appartenances as $appart){
            array_push($members,$appart['donateur_id']);
        }
        foreach($users as $user){
         in_array($user->id,$members)?null:array_push($non_members,$user);
        }
        return response()->json($non_members);

    }
    public function isMemberAssociation($id,$id_association){
        $appartenance = appartenir::where('association_id', $id_association)->where('donateur_id',$id)->get();
        if(count($appartenance)==0){
         return response()->json([
            'message'=>'false'
         ]);
        }
        else if (count($appartenance)>0 && $appartenance[0]->valide==1)
        {
            return response()->json([
                'message'=>'true'
             ]);
        }
        else if (count($appartenance)>0 && $appartenance[0]->valide==0)
        {
            return response()->json([
                'message'=>'attente'
             ]);
        }
    }
    public function rejectAssociationMember($id,$id_association){
        $appartenance = appartenir::where('association_id',$id_association)->where('donateur_id',$id)->delete();
        return response()->json($appartenance);
    }
    public function addAssociationMember($id,$id_association){
      $appartenance = appartenir::where('association_id',$id_association)->where('donateur_id',$id)->update([
        'valide'=>1
       ]);
       return response()->json($appartenance);
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'association_id'=>'required',
            'donateur_id'=>'required',
            'valide'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $appartenir = appartenir::create(
            array_merge($validator->validated()
        ));

        return response()->json(
            [
                'message'=>'Register to Association successfully',
                'Association'=>$appartenir->association
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
        $appartenir = appartenir::find($id);
        if(is_null($appartenir)){
            return response()->json([
                'message'=>'Not Found!'
            ],200);
        }
        return response()->json($appartenir,200);
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
        $appartenance = appartenir::find($id);
        if(is_null($appartenance)){
            return response()->json([
                'message'=>'Not found !'
            ],200);
        }
        appartenir::destroy($id);
        return response()->json([
            'message'=>'remove Successfully'
        ],200);
    }
}
