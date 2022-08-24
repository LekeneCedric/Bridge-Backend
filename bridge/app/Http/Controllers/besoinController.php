<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
class besoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Besoin::all(),200);
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
            'association_id'=>'required|int',
            'contenu'=>'required|string',
            'category'=>'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $Besoin = Besoin::create(
            array_merge($validator->validated()             
        ));

        return response()->json(
            [
                'Besoin'=>'Besoin created successfully',
                'besoin'=>$Besoin
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
        $Besoin = Besoin::find($id);
        if(is_null($Besoin)){
            return response()->json([
                'Besoin'=>'not Found!'
            ],200);
        }
        return response()->json($Besoin,200);
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
        $Besoin = Besoin::find($id);
        if(is_null($Besoin)){
            return response()->json([
                'Besoin'=>'Not Found!'
            ],200);
        }
        $Besoin->update($request->all());
        return response()->json([
            'Besoin'=>'modification successfully',
            'Besoin'=>$Besoin
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
        $Besoin = Besoin::find($id);
        Besoin::destroy($id);
        return response()->json([
            'Besoin'=>'Besoin deleted successfully',
            'Besoin'=>$Besoin
        ], 202);
    }
}
