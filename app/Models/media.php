<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class media extends Model
{
    use HasFactory;
    protected $fillable = [
         'id',
         'filePath',
         'extension',
         'fileName',
         'association_id',
         'annonce_id',
         'donateur_id',
         'don_id',
         'mouvement_id',
    ];
    protected $dates = ['created_at','updated_at'];

    public function annonce(){
        return $this->belongsTo(Annonce::class);
    } 

    public function association(){
        return $this->belongsTo(Association::class);
    }

    public function donateur(){
        return $this->belongsTo(Donateur::class);
    }

    public function don(){
        return $this->belongsTo(Don::class);
    }

    public function mouvement(){
        return $this->belongsTo(Mouvement::class);
    }
}
