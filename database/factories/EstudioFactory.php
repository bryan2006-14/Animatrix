<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EstudioFactory extends Factory
{
    protected $model = \App\Models\Estudio::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company(),
            'anio_fundacion' => $this->faker->year(),
        ];
    }
}
