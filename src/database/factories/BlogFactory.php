<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use voku\helper\ASCII;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            Blog::USER_ID => User::factory(),
            Blog::STATUS => Blog::STATUS_OPEN,
            Blog::TITLE => $this->faker->realText(20),
            Blog::BODY => $this->faker->realText(100),
        ];
    }

    public function seeding(): self
    {
        return $this->state(fn() => [
            Blog::STATUS  => $this->faker->randomElement([
                Blog::STATUS_OPEN, Blog::STATUS_OPEN , Blog::STATUS_OPEN, // 75 %
                Blog::STATUS_CLOSED // 25%
            ])
        ]);
    }

    public function closedState(): self
    {
        return $this->state(fn () => [
            Blog::STATUS  => Blog::STATUS_CLOSED
        ]);
    }

    /**
     * @param array<Comment> $comments
     * @return $this
     */
    public function withComment(array $comments): self
    {
        return $this->afterCreating(function(Blog $blog) use ($comments): void {
            foreach ($comments as $comment) {
                $comment->setBlogId($blog->id);
                $comment->save();
             }
        });
    }
}
