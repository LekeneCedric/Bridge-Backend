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
        'don_id',
        'association_id',
        'donateur_id'
    ];
    protected $dates = ['created_at','updated_at'];
    public function donateur(){
        return $this->belongsTo(Donateur::class);
    }
    public function association(){
        return $this->belongsTo(Association::class);
    }
    public function don(){
        return $this->belongsTo(Don::class);
    }
}
