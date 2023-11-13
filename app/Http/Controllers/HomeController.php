<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class HomeController extends Controller
{
    public function __invoke()
    {
        $blogs = Cache::tags(['blogs'])->remember('blogs',30,fn () => Blog::latest()->withCount('comments')->with('author')->get());
        $mostCommentedBlogs = Cache::remember('mostCommentedBlogs',30,fn () => Blog::mostCommentBlog()->take(5)->get());
        $authors = Cache::remember('authors',30,fn () => User::withMostBlogPosts()->take(5)->get());
        $lastMonthBlog = Cache::remember('lastMonthBlog',30,fn () => User::withMostBlogPostsLastMonth()->take(3)->get());

        return view('blog.index', [
            'blogs'=>$blogs,
            'mostCommentedBlogs'=>$mostCommentedBlogs,
            'authors'=>$authors,
            'lastMonthBlog'=>$lastMonthBlog
        ]);

    }
}
