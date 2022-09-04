<?php

namespace App\Http\Controllers;

use App\Models\appartenir;
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
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'association_id'=>'required',
            'donateur_id'=>'required',
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
