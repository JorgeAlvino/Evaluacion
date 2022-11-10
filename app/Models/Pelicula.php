<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    protected $table = 'pelicula';

    protected $fillable = ['nombre','fecha_publicacion','imagen'];

    public function turno(){

        return $this->hasMany(Turno::class);
    }
}
