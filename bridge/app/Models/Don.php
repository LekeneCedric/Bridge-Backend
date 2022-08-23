<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'titre',
        'images',
        'category',
        'etat',
        'description',
        'longitude',
        'latitude',
        'nombre_reserve',
        'disponible'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
