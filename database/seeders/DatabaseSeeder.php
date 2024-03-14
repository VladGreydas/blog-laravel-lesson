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
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        DB::table('posts')->insert([
            [
                'title' => 'End Title',
                'description' => 'lorem',
                'cover' => 'test',
                'body' => 'test'
            ],
            [
                'title' => 'End Title 1',
                'description' => 'lorem',
                'cover' => 'test',
                'body' => 'test'
            ],
            [
                'title' => 'End Title 2',
                'description' => 'lorem',
                'cover' => 'test',
                'body' => 'test'
            ],
            [
                'title' => 'End Title 3',
                'description' => 'lorem',
                'cover' => 'test',
                'body' => 'test'
            ],
            [
                'title' => 'End Title 4',
                'description' => 'lorem',
                'cover' => 'test',
                'body' => 'test'
            ],
            [
                'title' => 'End Title 5',
                'description' => 'lorem',
                'cover' => 'test',
                'body' => 'test'
            ],
            [
                'title' => 'End Title 6',
                'description' => 'lorem',
                'cover' => 'test',
                'body' => 'test'
            ],
            [
                'title' => 'End Title 7',
                'description' => 'lorem',
                'cover' => 'test',
                'body' => 'test'
            ]
        ]);
    }
}
