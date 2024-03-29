<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'donateur_id',
        'titre',
        'category',
        'etat',
        'adresse',
        'disponibilite',
        'description',
        'longitude',
        'latitude',
        'nombre_reserve',
        'disponible'
    ];
    protected $dates = ['created_at', 'updated_at'];
    public function donateur(){
        return $this->belongsTo(Donateur::class);
    }

    public function media(){
        return $this->hasMany(media::class);
    }
    public function message(){
        return $this->hasMany(Message::class);
    }
    public function reserver(){
        return $this->hasOne(reserver::class);
    }
}
