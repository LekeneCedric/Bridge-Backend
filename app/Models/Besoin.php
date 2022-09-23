<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Besoin extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'association_id',
        'contenu',
        'category',
        'attente',
        'resolu',
        'quantite',
        'quantite_actuelle'
    ];
    protected $dates = ['created_at', 'updated_at'];
    public function association(){
        return $this->belongsTo(Association::class);
    }
    public function AssoDon(){
        return $this->hasMany(AssoDon::class);
    }
}
