<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = $this->command->ask('How many create Blog?', 10);
        $users = User::all();
        Blog::factory($count)->make()->each(function(Blog $blog) use($users){
            $blog->user_id = $users->random()->id;
            $blog->save();
        });
    }
}
