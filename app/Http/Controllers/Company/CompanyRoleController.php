<?php

namespace App\Http\Controllers\Company;

use Auth;
use App\Models\Slot;
use App\Models\User;
use App\Models\Event;
use App\Models\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CompanyRoleController extends Controller
{
    public function index()
    {
      $company_id = Auth::user()->id;
      $company = User::where('id','=',$company_id)->with('events')->first();
      // dd($company->events);
      $events = $company->events;
      return view('Company.Event.index')->withEvents($events);
    }

    public function register_event_index($event_id)
    {
      $id = $event_id;
      return view('Company.Event.register')->withId($id);
    }

    public function event_detail($event_id)
    {
      $event = Event::find($event_id);
      return response()->json([
          'event' => $event,
      ]);
    }

    public function register_event(Request $request)
    {
        // dd($request->all());
        $slot_id = $request->slot_id;
        $event_id = $request->event_id;
        $template_id = $request->template_id;
        $user_id = Auth::user()->id;

        $upload_path = public_path().'/uploads/';
        if(!Storage::exists($upload_path)){
            Storage::makeDirectory($upload_path);
        }

        if($request->hasFile('video')){

            $video = $request->file('video');
            $filename = $video->getClientOriginalName();
            $path = $upload_path.$user_id.'/';
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }
            $status = $video->move($path, $filename);

            $upload = new Upload;
            $upload->name = $filename;
            $upload->type = 'video';
            $upload->user_id = $user_id;
            $upload->save();
        }//if video

        // dd($request->all());
        if(!empty($request->images)){
            // dd($request->images);
            foreach ($request->images as $key => $image) {
                $imagename = $image->getClientOriginalName();
                $path = $upload_path.Auth::user()->id.'/';
                if(!Storage::exists($path)){
                    Storage::makeDirectory($path);
                }
                // dd($image);
                $status = $image->move($path, $imagename);

                $upload = new Upload;
                $upload->name = $imagename;
                $upload->type = 'image';
                $upload->user_id = $user_id;
                $upload->save();
            }
        }//if images

        $slot = Slot::find($slot_id);
        $slot->status = 1;
        $slot->template_id = $template_id;
        $slot->template_id = $user_id;
        $slot->save();

        $event = Event::find($event_id);
        $event->users()->attach($user_id);
      // dd($status);

        return redirect()->route('company_events');
    }
}
