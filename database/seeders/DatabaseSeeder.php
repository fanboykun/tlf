<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(2)->hasPosts(2)->create();
        $posts = \App\Models\Post::all();
        foreach ($posts as $post) {
            \App\Models\Detail::factory()->for($post)->create();
        }

    }
}
