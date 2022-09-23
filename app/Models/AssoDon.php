<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssoDon extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'association_id',
        'donateur_id',
        'besoin_id',
        'titre',
        'category',
        'etat',
        'adresse',
        'description',
        'quantite',
        'longitude',
        'latitude',
        'verifie',
        'valide'

    ];
    protected $dates = ['created_at','updated_at'];
    public function donateur(){
        return $this->belongsTo(Donateur::class);
    }
    public function association(){
        return $this->belongsTo(Association::class);
    }

    public function media(){
        return $this->hasMany(media::class);
    }
    public function besoin(){
        return $this->belongsTo(Besoin::class);
    }
}
