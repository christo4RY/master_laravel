<?php

namespace App\Listeners;

use App\Events\BlogCommented;
use App\Jobs\Commented;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCommentedNotification
{

    /**
     * Handle the event.
     */
    public function handle(BlogCommented $event): void
    {
       Commented::dispatch($event->blog,$event->comment);
    }
}
