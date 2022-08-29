<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'association_id',
        'category',
        'intitule',
        'date_rencontre',
        'heure_debut',
        'heure_fin',
        'latitude',
        'longitude',
        'description'

    ];
    protected $dates = ['created_at','updated_at'];
    public function association(){
        return $this->belongsTo(Association::class);
    }

    public function media(){
        return $this->hasMany(media::class);
    }

}
