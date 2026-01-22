<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Login;
use Carbon\Carbon;

class UpdateLoginData
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $request = request();

        $user->last_login = Carbon::now();
        $user->last_ip = ($request) ? $request->ip() : '0.0.0.0';
        $user->login_count += 1;

        $user->save();

        logger('User Login Success. Name: '.$user->name.' | Id: '.$user->id.' | Email: '.$user->email.' | Username: '.$user->username.' IP:'.$user->last_ip.' | UpdateLoginData');
    }
}
