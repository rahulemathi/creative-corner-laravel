<?php

namespace App\Listeners;

use App\Events\WelcomeMail as WelcomeMailEvent;
use App\Mail\WelcomeMail as WelcomeMailMailable;
use Illuminate\Support\Facades\Mail;


class SendWelcomeMail
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
    public function handle(WelcomeMailEvent $event): void
    {
          Mail::to($event->user->email)->send(new WelcomeMailMailable($event->user));
    }
}
