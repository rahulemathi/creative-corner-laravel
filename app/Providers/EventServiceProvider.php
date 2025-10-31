<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\WelcomeMail;
use App\Listeners\SendWelcomeMail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        WelcomeMail::class => [
            SendWelcomeMail::class,
        ],
    ];
}