<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'type',
        'name',
        'category',
        'pays',
        'ville',
        'contact',
        'email',
        'adresse',
        'siteweb',
        'numero_contribuable',
        'password',
        'nom_responsable',
        'imagesProfil',
        'longitude',
        'latitude'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
