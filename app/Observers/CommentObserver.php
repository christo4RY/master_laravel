<?php

namespace App\Observers;

use App\Models\Comment;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        Cache::tags(['blogs'])->forget("show-blog-{$comment->blog_id}");
        Cache::tags(['blogs'])->forget("mostCommentedBlogs");
    }

}
