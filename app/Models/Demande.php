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
        'title',
        'contenu',
        'adresse',
        'category',
        'resolu'
    ];
    protected $dates = ['created_at', 'updated_at'];
    public function donateur(){
        return $this->belongsTo(Donateur::class);
    }
    public function message(){
        return $this->hasMany(Message::class);
    }
    
}
