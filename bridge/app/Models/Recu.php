<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recu extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'contenu',
        'id_don',
        'id_association',
        'id_donateur'
    ];
    protected $dates = ['created_at','updated_at'];
}
