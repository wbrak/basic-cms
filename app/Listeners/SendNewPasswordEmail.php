<?php

namespace App\Listeners;

use App\Events\UserNewPassword;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class SendNewPasswordEmail
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
     * @param  UserNewPassword  $event
     * @return void
     */
    public function handle(UserNewPassword $event)
    {
        //send the recover email to the user
        $data = $event->data;
        $user = $event->user;
        Mail::send('emails.resetPassword', ['user' => $user, 'data' => $data], function ($message) use ($user) {
            $message->from('webmasterbrak@gmail.com', Lang::get('Name Employee'));
            $message->subject(Lang::get('Reset password ').Config::get('company.name').' '.' !');
            $message->to($user->email);
        });
    }
}
