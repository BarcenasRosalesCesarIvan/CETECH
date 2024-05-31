<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Especialidades extends Model
{
   
    protected $table = 'especialidades';
    
    public $timestamps = false;

    public function planEstudio() {
        return $this->belongsTo(PlanEstudio::class);
    }
   


}