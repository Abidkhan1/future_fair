<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Offer;
use App\Models\User;
use App\Models\Event;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
      if($request->user()->hasRole('admin')){
        return view('dashboard');
      }elseif ($request->user()->hasRole('company')) {
        return view('dashboard');
      }elseif ($request->user()->hasRole('staff')) {
        return view('dashboard');
      }elseif ($request->user()->hasRole('public')) {
        $events = Event::all();
        return view('Enduser.dashboard')->withEvents($events);
      }else {
         dd('not admin');
      }
    }

    public function getFriends()
    {
        return UserResource::collection(User::where('id','!=', auth()->id())->get());
    }

    public function getFriend($id)
    {
      return new UserResource(User::findOrFail($id));
    }
}
