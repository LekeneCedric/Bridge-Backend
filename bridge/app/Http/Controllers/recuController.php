<?php

namespace App\Http\Controllers;

use App\Models\Recu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class recuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getrecusassociation($id){
        $recu = Recu::where('association_id', $id)->get();
        if(count($recu) <1){
            return response()->json([
                'message' => 'not found',
            ]);
        }
        $response=[];
        foreach($recu as $recu){
            $recu->association = $recu->association;
            $recu->don = $recu->don;
            array_push($response, $recu);
        }
        return response()->json([
            'message' => 'success',
            'data' => $response,
        ]); 
    }
    public function getrecusdonateurassociation($id_association,$id_donateur){
        $recu = Recu::where('donateur_id', $id_donateur)->where('association_id', $id_association)->get();
        if(count($recu) <1){
            return response()->json([
                'message' => 'not found',
            ]);
        }
        $response=[];
        foreach($recu as $recu){
            $recu->association = $recu->association;
            $recu->don = $recu->don;
            array_push($response, $recu);
        }
        return response()->json([
            'message' => 'success',
            'association'=> $response[0]->association->name,
            'data' => $response,
        ]);
    }
    public function getrecusdonateur($id){
        $recu = Recu::where('donateur_id', $id)->get();
        if(count($recu) <1){
            return response()->json([
                'message' => 'not found',
            ]);
        }
        $response=[];
        foreach($recu as $recu){
            $recu->association = $recu->association;
            $recu->don = $recu->don;
            array_push($response, $recu);
        }
        return response()->json([
            'message' => 'success',
            'data' => $response,
        ]);
    }
    public function index()
    {
        return response()->json(Recu::all(),200);
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
            'contenu'=>'required',
            'don_id'=>'required',
            'association_id'=>'required',
            'donateur_id'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $Recu = Recu::create(
            array_merge($validator->validated()             
        ));

        return response()->json(
            [
                'Recu'=>'Recu created successfully',
                'recu'=>$Recu
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
        $Recu = Recu::find($id);
        if(is_null($Recu)){
            return response()->json([
                'Recu'=>'not Found!'
            ],200);
        }
        return response()->json($Recu,200);
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
          
        $Recu = Recu::find($id);
        if(is_null($Recu)){
            return response()->json([
                'Recu'=>'Not Found!'
            ],200);
        }
        $Recu->update($request->all());
        return response()->json([
            'Recu'=>'modification successfully',
            'Recu'=>$Recu
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
        $Recu = Recu::find($id);
        Recu::destroy($id);
        return response()->json([
            'Recu'=>'Recu deleted successfully',
            'Recu'=>$Recu
        ], 200);
    }
}
