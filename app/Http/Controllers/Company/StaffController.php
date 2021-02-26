<?php

namespace App\Http\Controllers\Company;

use Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_id = Role::where('name','=','staff')->first()->id;

        $id = Auth::user()->id;
        $staffs = User::where('company_id','=',$id)->where('role_id','=',$role_id)->get();

        $allowed_staff = Auth::user()->total_staff;
        $registered_staff_count = User::where('company_id','=',$id)->where('role_id','=',$role_id)->count('id');

        // dd($registered_staff_count);

        return view('Company.Staff.index',compact('staffs', 'registered_staff_count','allowed_staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company.Staff.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'address' => 'required',
        'contact' => 'required|regex:/(03)[0-9]{9}/',
        'cnic' => 'required|unique:users|digits:13|regex:/^[1-9][0-9]{12}$/',
        ]);

        $comp_id = Auth::user()->id;
        $role_id = Role::where('name','=','staff')->first()->id;

        $staff = new User;
        $staff->name      = $request->name;
        $staff->address   = $request->address;
        $staff->contact   = $request->contact;
        $staff->cnic   = $request->cnic;
        $staff->email     = $request->email;
        $staff->role_id   = $role_id;
        $staff->company_id   = $comp_id;
        $staff->slug      = Str::slug($request->name) . '-' . time();
        $staff->password  =  Hash::make($request->password);
        $staff->save();

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
        $staff=User::find($id);
        return response()->json([
            'staff' => $staff
        ]);
     }


     public function edit($id)
     {
       return view('Company.Staff.edit')->withId($id);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $staff=User::find($id);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255| unique:users,email, $staff->id",
            'address' => 'required',
            'contact' => 'required|regex:/(03)[0-9]{9}/',
            'cnic' => "required|unique:users,cnic, $staff->id|digits:13|regex:/^[1-9][0-9]{12}$/",
        ]);

        if (isset($request->password)) {
            $this->validate($request,[
                'password' => 'required|string|min:6',
            ]);

            $staff->password  =  Hash::make($request->password);
        }//if password set

        $staff->name      = $request->name;
        $staff->address   = $request->address;
        $staff->contact   = $request->contact;
        $staff->cnic      = $request->cnic;
        $staff->email     = $request->email;
        $staff->slug      = Str::slug($request->name) . '-' . time();

        $staff->save();

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }

    public function delete_staff($id)
    {
        User::where('id','=',$id)->delete();
        return redirect()->route('staff.index');
    }
}
