<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Donateur extends Model
{
    use HasFactory,Notifiable,HasApiTokens;
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
    protected $dates = ['created_at','updated_at'];
}
