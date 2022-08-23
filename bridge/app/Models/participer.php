<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class participer extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'id_mouvement',
        'id_donateur'
    ];
    protected $dates = ['created_at','updated_at'];
}
