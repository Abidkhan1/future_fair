<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use App\Models\Session;


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

Broadcast::channel('admin_notification', function ($user) {
  Auth::check();
  return true;
});

Broadcast::channel('events', function ($user) {
  Auth::check();
  return true;
});

Broadcast::channel('users.{userId}', function ($user, $userId) {
  return true;
  Auth::check();
  return (int) $user->id === (int) $userId;
});

Broadcast::channel('App.User.{id}', function ($user, $id) {
  return true;
    Auth::check();
    return (int) $user->id === (int) $id;
});
//
// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// },['guards' => ['web']]);

Broadcast::channel('Chat', function ($user) {
    return $user;
},['guards' => ['web']]);


Broadcast::channel('Chat.{session}', function ($user, Session $session) {
    if ($user->id  === $session->user1_id || $user->id  === $session->user2_id) {
        return true;
    }
    return false;
},['guards' => ['web']]);


Broadcast::channel('chat-old', function ($user) {

    return $user;

});
