<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    public function store(User $user,CommentRequest $request){
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->commentable_id = auth()->user()->id;
        $comment->content = $request->input('comment');
        $comment->commentable_type = User::class;
        $comment->save();
        return redirect()->back()->withStatus("Commented");
    }
}
