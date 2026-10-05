<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::makeDirectory('project_images');

        $title = fake()->text(20);
        $slug = Str::slug($title);
        $img = fake()->image(null, 250, 250);
        // Se il download dell'immagine non va a buon fine il progetto resta senza immagine
        $img_url = $img ? Storage::putFileAs('project_images', $img, "$slug.png") : null;

        $type_ids = Type::pluck('id')->toArray();

        return [
            'type_id' => $type_ids ? Arr::random($type_ids) : null,
            'title' => $title,
            'slug' => $slug,
            'content' => fake()->paragraphs(20, true),
            'image' => $img_url
        ];
    }
}
