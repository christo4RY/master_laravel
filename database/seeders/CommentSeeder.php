<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Blog::all();
        $users = User::all();
        $count = $this->command->ask('How many generate comments',50);

        Comment::factory($count)->make()->each(function ($comment) use ($posts, $users) {
            $comment->commentable_id = $posts->random()->id;
            $comment->commentable_type = 'App\Models\Blog';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });

        Comment::factory($count)->make()->each(function ($comment) use ($users) {
            $comment->commentable_id = $users->random()->id;
            $comment->commentable_type = 'App\Nodels\User';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });

    }
}
