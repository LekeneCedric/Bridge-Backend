<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'donateur_id',
        'message'
    ];

    protected $dates = ['created_at','updated_at'];
    public function donateur(){
        return $this->belongsTo(Donateur::class);
    }
}
