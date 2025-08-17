<?php

use App\Order;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
Broadcast::channel('private-App.User.{userId}', function ($user, $userId) {

     Log::info('Broadcast gate hit', [
        'auth_user_id' => optional($user)->id,
        'param_id'     => $userId,
        'match'        => (int) optional($user)->id === (int) $userId,
    ]);
     return true;
});

Broadcast::channel('App.User.{id}', function ($user, $id) {
    \Log::info('Broadcast gate hit', [
        'auth_user_id' => optional($user)->id,
        'param_id'     => $id,
        'match'        => (int) optional($user)->id === (int) $id,
    ]);
    return (int) $user->id === (int) $id;
});
