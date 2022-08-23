<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_association',
        'category',
        'intitule',
        'date_rencontre',
        'latitude',
        'longitude',
        'description',
        'images'

    ];
    protected $dates = ['created_at','updated_at'];

}
