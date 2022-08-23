<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_association',
        'title',
        'intitule',
        'category',
        'nbvue',
        'images'
    ];
    protected $dates =  ['created_at', 'updated_at'];
}
