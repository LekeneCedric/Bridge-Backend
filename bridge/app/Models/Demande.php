<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'donateur_id',
        'contenu',
        'category',
        'resolu'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
