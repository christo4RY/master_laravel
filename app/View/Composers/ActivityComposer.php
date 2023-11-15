<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ActivityComposer
{
    public function compose(View $view)
    {
        $mostCommentedBlogs = Cache::remember(
            'mostCommentedBlogs',
            30,
            fn() => Blog::mostCommentBlog()
                ->take(5)
                ->get(),
        );
        $authors = Cache::remember(
            'authors',
            30,
            fn() => User::withMostBlogPosts()
                ->take(5)
                ->get(),
        );
        $lastMonthBlog = Cache::remember(
            'lastMonthBlog',
            30,
            fn() => User::withMostBlogPostsLastMonth()
                ->take(3)
                ->get(),
        );

        $view->with(['mostCommentedBlogs' => $mostCommentedBlogs, 'authors' => $authors, 'lastMonthBlog' => $lastMonthBlog]);
    }
}
