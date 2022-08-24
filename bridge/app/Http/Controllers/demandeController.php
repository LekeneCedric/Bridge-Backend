<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class demandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Demande::all(),200);
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
            'contenu'=>'required|string',
            'category'=>'required|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $Demande = Demande::create(
            array_merge($validator->validated()             
        ));

        return response()->json(
            [
                'Demande'=>'Demande created successfully',
                'demande'=>$Demande
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
        $Demande = Demande::find($id);
        if(is_null($Demande)){
            return response()->json([
                'Demande'=>'not Found!'
            ],200);
        }
        return response()->json($Demande,200);
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
        $Demande = Demande::find($id);
        if(is_null($Demande)){
            return response()->json([
                'Demande'=>'Not Found!'
            ],200);
        }
        $Demande->update($request->all());
        return response()->json([
            'Demande'=>'modification successfully',
            'Demande'=>$Demande
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
        $Demande = Demande::find($id);
        Demande::destroy($id);
        return response()->json([
            'Demande'=>'Demande deleted successfully',
            'Demande'=>$Demande
        ], 202);
    }
}
