<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Session;
use App\Events\MsgReadEvent;
use App\Events\PrivateChatEvent;
use App\Http\Resources\ChatResource;
use Carbon\Carbon;
use App\Events\BlockEvent;


class ChatController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    return view('chat.chat');
  }

  public function fetchAllMessages()
  {
    return Chat::with('user')->get();
  }

  public function sendMessage(Request $request)
  {
    $chat = auth()->user()->messages()->create([
          'message' => $request->message
      ]);

    broadcast(new ChatEvent($chat->load('user')))->toOthers();

    return ['status' => 'success'];
  }





  public function chats(Session $session)
  {
      return ChatResource::collection($session->chats->where('user_id', auth()->id()));

  }
  public function send(Session $session, Request $request)
  {
      $message = $session->messages()->create([
          'content' => $request->message
      ]);


      $chat = $message->createForSend($session->id);

      $message->createForReceive($session->id, $request->to_user);

      broadcast(new PrivateChatEvent($message->content, $chat));

      return response($chat->id, 200);
  }
  public function read(Session $session)
  {
      $chats = $session->chats->where('read_at', null)->where('type', 0)->where('user_id', '!=', auth()->id());

      foreach ($chats as $chat) {
          $chat->update(['read_at' => Carbon::now()]);
          broadcast(new MsgReadEvent(new ChatResource($chat), $chat->session_id));
      }
  }
  public function clear(Session $session)
  {
      $session->deleteChats();
      $session->chats->count() == 0 ? $session->deleteMessages() : '';
      return response('cleared', 200);
  }




  public function block(Session $session)
  {
      $session->block();

      broadcast(new BlockEvent($session->id, true));

      return response(null, 201);
  }

  public function unblock(Session $session)
  {
      $session->unblock();

      broadcast(new BlockEvent($session->id, false));

      return response(null, 201);
  }

  public function chat()
  {
      return view('chat.chats1');
      // return view('chat.chats');
  }

}
