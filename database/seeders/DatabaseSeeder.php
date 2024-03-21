<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Vlad',
            'email' => 'admin@example.com',
            'password' => '12345678'
        ]);

        User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
            TagSeeder::class
        ]);
    }
}
