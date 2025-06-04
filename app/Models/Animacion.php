<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animacion extends Model
{
    use HasFactory;

    // 👇 Esto es lo que corrige el error
    protected $table = 'animaciones';

    protected $fillable = ['titulo', 'duracion', 'imagen', 'estudio_id'];

    public function estudio()
    {
        return $this->belongsTo(Estudio::class);
    }
}
