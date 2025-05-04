<?php

namespace App\Listeners;

use App\Events\sendMail;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class sendMailFired
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(sendMail $event): void
    {
        $user = User::findOrFail($event->userId);
        Mail::to("jujutsukaisen011011@gmail.com")->queue(new TestMail($user));
    }
}
