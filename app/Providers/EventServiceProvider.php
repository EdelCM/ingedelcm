<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        //
    ];

    public function boot(): void
    {
        Event::listen(Registered::class, function ($event) {
            $event->user->assignRole('admin');
        });
    }
}
