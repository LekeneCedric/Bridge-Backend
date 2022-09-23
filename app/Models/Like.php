<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'donateur_id',
        'annonce_id'
    ];
    protected $dates = ['created_at', 'updated_at'];
    public function donateur(){
        return $this->belongsTo(Donateur::class);
    }
    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }
}
