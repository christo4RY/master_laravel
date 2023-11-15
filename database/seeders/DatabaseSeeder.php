<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $confirm = $this->command->confirm('Are you sure for database refresh', true);
        if ($confirm) {
            $this->command->call('migrate:fresh');
            $this->command->info('database refreshed.');
        }

        Cache::tags(['blogs', 'authors'])->flush();

        $this->call([UserSeeder::class, BlogSeeder::class, CommentSeeder::class, TagSeeder::class, BlogTagSeeder::class]);
    }
}
