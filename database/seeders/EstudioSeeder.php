<?php

namespace Database\Seeders;

use App\Models\Estudio;
use Illuminate\Database\Seeder;

class EstudioSeeder extends Seeder
{
    public function run(): void
    {
        Estudio::factory()->count(5)->create();
    }
}
