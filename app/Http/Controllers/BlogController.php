<?php

namespace App\Http\Controllers;

use App\Abstract\AlertResponse;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create','edit','destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Cache::tags(['blogs'])->remember('blogs',30,fn () => Blog::latest()->withCount('comments')->with('author')->with('tags')->get());

        return view('blog.index',['blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $validated = $request->validated();
        Blog::create($validated);
        return AlertResponse::sendSuccessAlertResponse($validated['title'].' was created', to_route('blogs.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $showBlog  = Cache::remember("show-blog-{$blog->id}",30,fn () => $blog->load(['comments','tags']));

        $sessionId = session()->getId();
        $counterKey = "blog-{$blog->id}-counter";
        $userKey = "blog-{$blog->id}-users";

        $users = Cache::get($userKey,[]);
        $usersUpdate = [];
        $diffrence = 0;
        $now = now();
        foreach ($users as $session => $lastTime){
            if($now->diffInMinutes($lastTime) >= 1){
                $diffrence--;
            }else{
                $usersUpdate[$session] = $lastTime;
            }
        }

        if(!array_key_exists($sessionId,$users) || $now->diffInMinutes($users[$sessionId]) >= 1){
            $diffrence++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::forever($userKey,$usersUpdate);

        if(!Cache::has($counterKey)){
            Cache::forever($counterKey,1);
        }else{
            Cache::increment($counterKey,$diffrence);
        }

        $counter = Cache::get($counterKey);

        return view('blog.show', [
            'blog'=>$showBlog,
            'counter'=>$counter
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
//        if(Gate::denies('update-blog',$blog)){
//            abort(403);
//        }
        $this->authorize('update',$blog);
        $showBlog  = Cache::remember("show-blog-{$blog->id}",30,fn () => $blog);
        return view('blog.edit', [
            'blog'=>$showBlog
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $this->authorize('update',$blog);
        $validated = $request->validated();
        $blog->update($validated);
        return AlertResponse::sendUpdateAlertResponse($blog->title.' was updated', to_route('blogs.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, Request $request)
    {
//        if(!$this->authorize('delete-blog',$blog)){
//            abort(403,"You can't delete this blog");
//        }

        $this->authorize('delete',$blog);
        $title= $blog->title;
        $blog->delete();
        return AlertResponse::sendErrorAlertResponse($title.' was deleted!', to_route('blogs.index'));
    }
}
