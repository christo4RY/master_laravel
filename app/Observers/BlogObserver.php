<?php

namespace App\Observers;

use App\Models\Blog;
use Illuminate\Support\Facades\Cache;

class BlogObserver
{
    /**
     * Handle the Blog "updated" event.
     */
    public function updated(Blog $blog): void
    {
        Cache::tags(['blogs'])->forget("show-blog-{$blog->id}");
    }

    /**
     * Handle the Blog "deleted" event.
     */
    public function deleted(Blog $blog): void
    {
        $blog->comments()->delete();
        Cache::tags(['blogs'])->forget("show-blog-{$blog->id}");
    }

    /**
     * Handle the Blog "restored" event.
     */
    public function restored(Blog $blog): void
    {
        $blog->comments()->restore();
    }

}
