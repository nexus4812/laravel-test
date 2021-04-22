<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory(15)->create()->each(function (User $user) {
            Blog::concreteFactory(random_int(1, 3))
                ->seeding()
                ->has(Comment::factory()->count(random_int(1,2)))
                ->create([Blog::USER_ID => $user]);
        });
    }
}
