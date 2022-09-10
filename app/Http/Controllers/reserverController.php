<?php

namespace App\Http\Controllers;

use App\Models\reserver;
use Illuminate\Http\Request;

class reserverController extends Controller
{
    //
    public function index(){
        return reserver::all();
    }
}
