<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * @var class-string<Album>
     */
    protected $model = Album::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->unique()->words(asText: true),
            'slug' => Str::slug($title),
            'description' => $this->faker->realText(),
            'location' => $this->faker->country(),
            'shooting_date' => $this->faker->dateTimeBetween('-10 years'),
            'is_visible' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month'),
        ];
    }
}
