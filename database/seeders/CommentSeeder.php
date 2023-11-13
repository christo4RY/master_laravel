<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
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
        $count = $this->command->ask('How many generate comments',50);
        Comment::factory($count)->make()->each(function($comment) use ($posts){
            $comment->blog_id = $posts->random()->id;
            $comment->save();
        });
    }
}
