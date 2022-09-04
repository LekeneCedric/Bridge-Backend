<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'donateur_id',
        'receiver_id',
        'contenu',
        'vu',
        'demande_id',
        'don_id'

    ];
    protected $dates = ['created_at','updated_at'];

    public function donateur(){
        return $this->belongsTo(Donateur::class);
    }
    public function demande(){
        return $this->belongTo(Demande::class);
    }
    public function don(){
        return $this->belongTo(Don::class);
    }
}
