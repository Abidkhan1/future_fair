<?php

namespace App\Http\Controllers\EndUser;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Slot;
use App\Models\Offer;
use App\Models\Event;
use App\Models\Visitor;
use App\Models\Pavillion;
use Illuminate\Support\Str;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EndUserController extends Controller
{
    public function user_notification()
    {
      return view('Enduser.testNotification');
    }

    public function user_profile()
    {
      $id = Auth::user()->id;
      return view('Enduser.profile')->withId($id);
    }

    public function user_data($id)
    {
      $user = User::find($id);
      return response()->json([
          'status' => true,
          'user' => $user,
      ]);
    }

    public function profile_image(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $upload_path = public_path().'/uploads/';
        if(!Storage::exists($upload_path)){
           Storage::makeDirectory($upload_path);
        }

        if($request->hasFile('profile_image')){
            $profile_image = $request->file('profile_image');
            $filename = $profile_image->getClientOriginalName();
            $path = $upload_path.$user_id.'/';
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }

            if (file_exists(public_path().$user->profile_image) && $user->profile_image) {
                unlink(public_path().$user->profile_image);
            }

            $status = Storage::delete($user->profile_image);
            $status = $profile_image->move($path, $filename);
            $profile_image_path = '/uploads/'.$user_id.'/'.$filename;
            $user->profile_image = $profile_image_path;
            $user->save();
        }//if profile_image

        return redirect()->back();
    }

    public function save_user_data(Request $request)
    {
      $id = $request->id;
      $this->validate($request,[
          'name' => 'required|max:255',
          'email' => "required|email|unique:users,email,$id",
          'address' => 'required|string|max:255',
          'contact' => 'required|max:255',
          'details' => 'required|string|max:1000',
          'occupation' => 'required|string|max:255',
          'industry' => 'required|string|max:255',
      ]);

      $user = User::find($id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->address = $request->address;
      $user->contact = $request->contact;
      $user->details = $request->details;
      $user->occupation = $request->occupation;
      $user->industry = $request->industry;
      $user->save();
      return response()->json([
          'status' => true,
        'data' => $request->all()
      ]);
    }

    public function change_password(Request $request)
    {
      $id = $request->id;
      $this->validate($request,[
          'password' => 'required|min:6',
      ]);

      $user = User::find($id);
      $user->password  =  Hash::make($request->password);
      $user->save();
      return response()->json([
          'status' => true,
      ]);
    }

    public function update_profile(Request $request)
    {
        dd('update_profile');
    }

    public function pavillion()
    {
      return view('Enduser.pavillion1');
    }

    public function event_select($id)
    {
      $event = Event::where('id','=',$id)->with('pavillions')->first();
      // dd('event Selected',$event);
      $pavillions = $event->pavillions;
      return view('Enduser.pavillion1',compact('event', 'pavillions'));
    }

    public function pavillion_data($event_id)
    {
        // get alloted slots data for respective event
        $slots = Slot::with('company')
                     ->where('event_id','=',$event_id)
                     ->orderBy('pavillion_id','asc')
                     ->get();
        $pavillion_ids = Pavillion::where('event_id','=',$event_id)->pluck('id')->toArray();

        $data = [];

        foreach ($pavillion_ids as $key => $pav_id) {
         $slots = Slot::with('company')
                ->where('event_id','=',$event_id)
                ->where('pavillion_id','=',$pav_id)
                ->get();
         $data[$key] = $slots;
        }

        return response()->json([
            'data' => $data,
            'pavillion_ids' => $pavillion_ids,
            'slots' => $slots,
            'status' => 'hello',
        ]);
    }

    public function reception($company_id,$event_id,Request $request)
    {
        $ip=\Request::getClientIp();
        $user = Auth::user();
        $visitor = new Visitor;
        $visitor->company_id = $company_id;
        $visitor->visitor_id = $user->id;
        $visitor->visitor_name = $user->name;
        $visitor->visitor_email = $user->email;
        $visitor->visitor_registration_date = $user->created_at;
        $visitor->ip = $ip;
        $visitor->created_at = Carbon::now();
        $visitor->updated_at = Carbon::now();
        $visitor->save();

        return view('Enduser.reception',compact( 'company_id','event_id'));
    }

    public function company_staffs($id)
    {
        return UserResource::collection(User::where('company_id','=',$id)->get());
    }

    public function get_sitesettings()
    {
        $offers = Offer::with('company')->get();
        $site_settings = SiteSetting::all();
        return response()->json([
          'site_settings' => $site_settings,
          'offers' => $offers,
        ]);
    }
}
