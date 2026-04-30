<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Worker Test',
            'email' => 'worker@test.com',
        ]);

        User::factory()->create([
            'name' => 'User Test',
            'email' => 'user@test.com',
        ]);

        $this->call(SectorSeeder::class);
        $this->call(WorkerSeeder::class);
        $this->call(PrioritySeeder::class);
        $this->call(CallSeeder::class);
    }
}
