<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class participer extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'mouvement_id',
        'donateur_id'
    ];
    protected $dates = ['created_at','updated_at'];
}
