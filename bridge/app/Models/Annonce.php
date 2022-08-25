<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'association_id',
        'title',
        'intitule',
        'category',
        'nbvue',
        'images'
    ];
    protected $dates =  ['created_at', 'updated_at'];
    public function association(){
        return $this->belongsTo(Association::class);
    }
}
