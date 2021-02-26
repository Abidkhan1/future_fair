<?php

namespace App\Http\Controllers;
use Pusher\Pusher;
use Illuminate\Http\Request;

class VideoChatController extends Controller
{
  public function videoChat()
  {
    return view('Staff.VideoChat.video');
  }

  public function videoCall($room_name,$username)
  {
    return view('Staff.VideoChat.videoRoom',["room"=>"$room_name","user"=>"$username"]);
  }

  public function index(Request $request) {
      $user = $request->user();
      $others = \App\Models\User::where('id', '!=', $user->id)->pluck('name', 'id');
      return view('video_chat.index')->with([
          'user' => collect($request->user()->only(['id', 'name'])),
          'others' => $others
      ]);
  }

  public function auth(Request $request) {
      $user = $request->user();
      $socket_id = $request->socket_id;
      $channel_name = $request->channel_name;
      $pusher = new Pusher(
          config('broadcasting.connections.pusher.key'),
          config('broadcasting.connections.pusher.secret'),
          config('broadcasting.connections.pusher.app_id'),
          [
              'cluster' => config('broadcasting.connections.pusher.options.cluster'),
              'encrypted' => true
          ]
      );
      return response(
          $pusher->presence_auth($channel_name, $socket_id, $user->id)
      );
  }
}
