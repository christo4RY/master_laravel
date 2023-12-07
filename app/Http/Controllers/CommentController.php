<?php

namespace App\Http\Controllers;

use App\Events\BlogCommented;
use App\Http\Requests\CommentRequest;
use App\Jobs\Commented as JobsCommented;
use App\Mail\Commented;
use App\Jobs\ThrottledMail;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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


        event(new BlogCommented($blog,$request->input('comment')));

        session()->flash('message','Comment was ceated.');
        return redirect()->back();
    }
}
