<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::factory()->create([
            'name' => 'Baixa',
            'expected_time_minutes' => 1440, // 24 horas
        ]);

        Priority::factory()->create([
            'name' => 'Média',
            'expected_time_minutes' => 720, // 12 horas
        ]);

        Priority::factory()->create([
            'name' => 'Alta',
            'expected_time_minutes' => 180, // 3 horas
        ]);
    }
}
