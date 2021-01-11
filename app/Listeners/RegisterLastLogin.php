<?php

namespace App\Listeners;

use App\Events\UserLogin;
use DateTime;
use Exception;

class RegisterLastLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserLogin $event
     * @return void
     * @throws Exception
     */
    public function handle(UserLogin $event)
    {
        $event->user->last_login = $event->user->current_login ? $event->user->current_login : new DateTime;
        $event->user->current_login = new DateTime;
        $event->user->save();
    }
}
