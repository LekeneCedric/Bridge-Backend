<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class social extends Model
{
    protected $fillable = [
     'id',
     'association_id',
     'donateur_id',
     'name',
     'link'
    ];
    protected $dates = ['created_at', 'updated_at'];
    public function donateur(){
        return $this->belongsTo(donateur::class);
    }
    public function association(){
        return $this->belongsTo(association::class);
    }
    use HasFactory;
    
}
