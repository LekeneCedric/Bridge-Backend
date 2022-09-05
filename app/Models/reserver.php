<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reserver extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'don_id',
        'donateur_id'
    ];
    protected $dates = ['created_at','updated_at'];
    public function don(){
        return $this->belongsTo(Don::class);
    }
    public function donateur(){
        return $this->belongsTo(donateur::class);
    }
}
