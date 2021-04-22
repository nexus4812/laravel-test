<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Comment;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $createdAt = CarbonImmutable::today()->subDays(rand(3, 365));

        return [
            'blog_id' => Blog::factory(),
            'name' => $this->faker->name,
            'body' => $this->faker->realText(20),
            Comment::CREATED_AT => $createdAt,
            Comment::UPDATED_AT => $createdAt
        ];
    }
}
