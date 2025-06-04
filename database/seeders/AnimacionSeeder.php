<?php

namespace Database\Seeders;

use App\Models\Animacion;
use Illuminate\Database\Seeder;

class AnimacionSeeder extends Seeder
{
    public function run(): void
    {
        Animacion::factory()->count(20)->create();
    }
}
