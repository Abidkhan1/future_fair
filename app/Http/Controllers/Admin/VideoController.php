<?php
namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Events\RealTimeMessage;
use App\Events\AdminNotificationEvent;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function create_notification($value='')
    {
        return view('Admin.Notification.notification');
    }

    public function send_notification(Request $request)
    {
      // $users = User::all();
      if (! $request->title) {
        $title = 'Alert! This is title from Admin';
      }else if(! $request->message) {
        $message = "This is Ping message from Admin, don't ignore this message.";
      }else {
        $title = $request->title;
        $message = $request->message;
      }
      // $notification = new AdminNotification();
      // $notification->title = $title;
      // $notification->message = $message;
      // $notification->save();

      // event(new AdminNotificationEvent($title, $message));

      event(new RealTimeMessage($title, $message));

      return response()->json([
          'status' => true,
          'message' => 'Notification sent successfully',
      ]);

    }

    public function send_notification_test(Request $request)
    {
      // $users = User::all();
      $title = 'Alert! This is message title from Admin';
      $message = "This is message from Admin, don't ignore this message.";

      // $notification = new AdminNotification();
      // $notification->title = $title;
      // $notification->message = $message;
      // $notification->save();

      // event(new AdminNotificationEvent($title, $message));

      event(new RealTimeMessage($title, $message));

      return response()->json([
          'status' => true,
          'message' => 'Notification sent successfully',
      ]);

    }
    //
    public function video()
    {
      return view('video');
    }
}
