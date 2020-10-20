<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
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

        User::factory()
            ->create(['name' => 'adrian', 'email' => 'adrian@test.com', 'password' => '$2a$04$MJL4ZpY4Nrt1g8tjftUHB.ZOnJkTZstr5SEpwpJLMhdMDEjgYoK3O']);
    }
}
