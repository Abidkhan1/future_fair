<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class RegisterUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
      $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
      ]);

        $public_role_id = Role::where('name','=','public')->first()->id;

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $public_role_id;
        $user->slug = Str::slug($request->name) . '-' . time();
        $user->password =  Hash::make($request->password);
        $user->save();

        $this->guard()->login($user);

        return redirect('/home');
    }


    protected function guard()
    {
        return Auth::guard();
    }

}
