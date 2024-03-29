<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;
    protected $fillable = [
         'id',
        'type',
         'name',
        'category',
         'pays',
         'ville',
         'contact',
         'adresse',
         'numero_contribuable',
         'nom_responsable',
         'password',
         'longitude',
         'latitude',
         'description',
         'verifie',
         'valide'
    ];
    protected $dates = ['created_at', 'updated_at'];
    public function annonce(){
        return $this->hasMany(Annonce::class);
    }
    public function mouvement(){
        return $this->hasMany(Mouvement::class);
    }
    public function don(){
        return $this->hasMany(Don::class);
    }
    public function recu(){
        return $this->hasMany(Recu::class);
    }

    public function media(){
        return $this->hasMany(media::class);
    }
    public function social(){
        return $this->hasMany(social::class);
    }
    public function besoin(){
        return $this->hasMany(Besoin::class);
    }
}
