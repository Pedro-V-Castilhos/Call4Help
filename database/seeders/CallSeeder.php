<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Call;

class CallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Call::factory()->create([
            'status' => 'open',
            'title' => 'Problema com o computador',
            'content' => 'O computador não liga.',
            'sector_id' => 1,
            'attachment_url' => null,
            'priority_id' => 3,
            'worker_id' => 1,
            'user_id' => 2,
        ]);
    }
}
