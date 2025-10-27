<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\PostStatus;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        $status = $this->faker->randomElement([PostStatus::Draft, PostStatus::Published]);

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $title,
            'content' => $this->faker->paragraphs(5, true),
            'status' => $status,
            'source' => 'local',
            'external_id' => null,
        ];
    }
}
