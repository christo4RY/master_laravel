<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Mail\Mailable;

class ThrottledMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $mail;
    public function __construct(Mailable $mail)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Redis::throttle('mailtrap')->allow(2)->every(12)->then(function () {
            Mail::to(auth()->user()->email)->send($this->mail);
        }, function () {
            return $this->release(5);
        });
    }
}
