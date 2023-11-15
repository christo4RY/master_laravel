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
        $blogs = Cache::tags(['blogs'])->remember('blogs',30,fn () => Blog::latest()->withCount('comments')->with('author')->with('tags')->get());
        return view('blog.index',['blogs'=>$blogs]);

    }
}
