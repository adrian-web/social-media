<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
            ->count(10)
            ->create();

        $posts = Post::all();

        foreach ($posts as $post) {
            Comment::factory()
                ->count(rand(0, 5))
                ->create(['post_id' => $post->id]);
        }

        User::factory()
            ->create(['name' => 'adrian', 'email' => 'adrian@test.com', 'password' => '$2a$04$MJL4ZpY4Nrt1g8tjftUHB.ZOnJkTZstr5SEpwpJLMhdMDEjgYoK3O']);
    }
}
