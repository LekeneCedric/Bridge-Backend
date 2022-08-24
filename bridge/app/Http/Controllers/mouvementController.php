<?php

namespace App\Http\Controllers;

use App\Models\Mouvement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class mouvementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Mouvement::all(),200);
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
            'association_id'=>'required|int',
            'category'=>'required|string',
            'intitule'=>'required|string',
            'date_rencontre'=>'required',
            'heure_debut'=>'required',
            'heure_fin'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'description'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $Mouvement = Mouvement::create(
            array_merge($validator->validated()             
        ));

        return response()->json(
            [
                'Mouvement'=>'Mouvement created successfully',
                'mouvement'=>$Mouvement
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
        //
    }
}