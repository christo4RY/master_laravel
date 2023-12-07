<?php

namespace App\Providers;

use App\Events\BlogCommented;
use App\Events\Posted;
use App\Listeners\SendAdminPostedNotification;
use App\Listeners\SendCommentedNotification;
use App\Models\Blog;
use App\Models\Comment;
use App\Observers\BlogObserver;
use App\Observers\CommentObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BlogCommented::class => [
            SendCommentedNotification::class
        ],
        Posted::class => [
            SendAdminPostedNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Blog::observe(BlogObserver::class);
        Comment::observe(CommentObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
