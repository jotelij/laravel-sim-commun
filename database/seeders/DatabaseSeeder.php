<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create 10 users
        $users = User::factory(10)->create();

        // create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
             'password' => Hash::make(env('ADMIN_USER_PASSWORD')),
        ]);

        // create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
             'password' => Hash::make(env('TEST_USER_PASSWORD')),
        ])->each(function ($user) use ($users) {
            // create 3 posts for each user
            Post::factory(3)->create(['user_id' => $user->id])->each(function ($post) use ($users) {
                // create 3 comments for each post
                Comment::factory(3)->create(['post_id' => $post->id, 'user_id' => $users->random()->id]);
            });
        });

        // Create 10 posts
        Post::factory(10)->create(['user_id' => $users->random()->id])->each(function ($post) use ($users) {
            // Create 5 comments for each post
            Comment::factory(5)->create(['post_id' => $post->id, 'user_id' => $users->random()->id]);
        });
    }
}
