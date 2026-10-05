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
        \App\Models\User::factory()->create([
            'name' => 'Gioacchino',
            'email' => 'gioacchino@libero.it',
        ]);

        $this->call([TypeSeeder::class, TechnologySeeder::class]);

        $technology_ids = \App\Models\Technology::pluck('id')->toArray();

        \App\Models\Project::factory(10)->create()->each(function ($project) use ($technology_ids) {
            $project->technologies()->attach(fake()->randomElements($technology_ids, rand(1, 3)));
        });
    }
}
