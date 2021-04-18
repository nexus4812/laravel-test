<?php

namespace Tests\Feature\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogViewControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOpenTopPage()
    {
        $blog1 = Blog::factory()->has(Comment::factory()->count(1))->create();
        $blog2 = Blog::factory()->has(Comment::factory()->count(2))->create();
        $blog3 = Blog::factory()->has(Comment::factory()->count(3))->create();

        $this->get('/')
            ->assertOk()
            ->assertSee($blog1->title)->assertSee($blog1->user->name)->assertSee('1件')
            ->assertSee($blog2->title)->assertSee($blog2->user->name)->assertSee('2件')
            ->assertSee($blog3->title)->assertSee($blog3->user->name)->assertSee('3件')
            ->assertSeeInOrder([$blog3->title, $blog2->title, $blog1->title]);
    }
}
