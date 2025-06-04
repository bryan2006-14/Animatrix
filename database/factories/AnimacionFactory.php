<?php

namespace Database\Factories;

use App\Models\Estudio;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimacionFactory extends Factory
{
    protected $model = \App\Models\Animacion::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'duracion' => $this->faker->randomElement(['30 min', '1 hora', '45 min']),
            // Genera imagen en storage/app/public/animaciones y guarda solo la ruta relativa
            'imagen' => 'animaciones/' . $this->faker->image(storage_path('app/public/animaciones'), 640, 480, null, false),
            'estudio_id' => Estudio::factory(),
        ];
    }
}
