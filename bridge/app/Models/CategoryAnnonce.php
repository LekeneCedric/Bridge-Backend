<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAnnonce extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'intitule',
        'icon'
    ];
}
