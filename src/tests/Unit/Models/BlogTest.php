<?php

namespace Tests\Unit\Models;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_relation_user()
    {
        static::assertInstanceOf(User::class, Blog::factory()->create()->user);
    }

    public function test_relation_comment()
    {
        $blog = Blog::factory()->has(Comment::factory()->count(1))->create();
        static::assertInstanceOf(Collection::class, $blog->comments);
        static::assertInstanceOf(Comment::class, $blog->comments->first());
    }

    public function test_filter_open()
    {
        $blog1 = Blog::factory([Blog::STATUS => Blog::STATUS_OPEN])->create();
        $blog2 = Blog::factory([Blog::STATUS => Blog::STATUS_CLOSED])->create();
        $items = Blog::filterOnlyOpen(Blog::query())->get();
        $this->assertTrue($items->contains($blog1));
        $this->assertFalse($items->contains($blog2));
    }
}
