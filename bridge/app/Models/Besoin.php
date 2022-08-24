<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Besoin extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'association_id',
        'contenu',
        'category',
        'resolu',
        'images'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
