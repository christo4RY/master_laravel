<?php

namespace App\Listeners;

use App\Events\Posted;
use App\Jobs\Posted as JobsPosted;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendAdminPostedNotification
{
    /**
     * Handle the event.
     */
    public function handle(Posted $event): void
    {
        User::getAdmin()->get()->map(function(User $user){
            JobsPosted::dispatch($user);
        });
    }
}
