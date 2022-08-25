<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Donateur extends Model
{
    use HasFactory,Notifiable,HasApiTokens;
    protected $fillable = [
        'id',
        'name',
        'surname',
        'email',
        'age',
        'sexe',
        'contact',
        'pays',
        'ville',
        'imageProfil'
        
    ];
    protected $dates = ['created_at','updated_at'];

    public function message(){
        return $this->hasMany(Message::class);
    }
    public function recu(){
        return $this->hasMany(Recu::class);
    }
    public function demande(){
        return $this->hasMany(Demande::class);
    }
    public function don(){
        return $this->hasMany(Don::class);
    }
    public function association(){
        return $this->belongsToMany(Association::class);
    }
    public function mouvement(){
        return $this->belongsToMany(Mouvement::class);
    }
}
