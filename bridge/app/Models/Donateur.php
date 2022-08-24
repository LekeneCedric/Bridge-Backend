<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donateur extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'surname',
        'email',
        'age',
        'sexe',
        'contact',
        'pays',
        'ville',
        'imageProfil',
        'password'
        
    ];
    protected $hidden =[
        'vpassword',
    ];
    protected $dates = ['created_at','updated_at'];
}
