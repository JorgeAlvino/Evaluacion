<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $table = 'turno';
    
    protected $fillable = ['turno','estado','id_pelicula'];

    public function pelicula(){
        return $this->belongsTo(Pelicula::class);
    }
}
