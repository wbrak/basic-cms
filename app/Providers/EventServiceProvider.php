<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\NewUserRegistered::class => [
            \App\Listeners\SendWelcomeEmail::class,
        ],
        \App\Events\UserRecoverPassword::class => [
            \App\Listeners\SendRecoverEmail::class,
        ],
        \App\Events\UserNewPassword::class => [
            \App\Listeners\SendNewPasswordEmail::class,
        ],
        \App\Events\UserLogin::class => [
            \App\Listeners\RegisterLastLogin::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
