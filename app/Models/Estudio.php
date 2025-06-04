<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ← Esto faltaba
use Illuminate\Database\Eloquent\Model;
use App\Models\Animacion; // Opcional, pero recomendable si usas Animacion en este archivo

class Estudio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'anio_fundacion'];

    public function animaciones()
    {
        return $this->hasMany(Animacion::class);
    }
}
