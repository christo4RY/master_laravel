<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    public function store(Blog $blog,CommentRequest $request){

        $blog->comments()->create([
            'user_id'=>auth()->user()->id,
            'content'=>$request->input('comment'),
        ]);

        session()->flash('message','Comment was ceated.');
        return redirect()->back();
    }
}
