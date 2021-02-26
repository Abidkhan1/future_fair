<?php

namespace App\Http\Controllers\Admin;
use App\Models\Slot;
use App\Models\User;
use App\Models\Role;
use App\Models\Event;
use App\Models\Pavillion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_id = Role::where('name','=','company')->first()->id;
        $companies = User::where('role_id','=',$role_id)->get();
        return view('Admin.Company.index')
             ->withCompanies($companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Company.add');
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
            // 'cnic' => 'required|unique:users|digits:13|regex:/^[1-9][0-9]{12}$/',
        ]);

        $company = new User;
        $company->name      = $request->name;
        $company->address   = $request->address;
        $company->contact   = $request->contact;
        $company->details   = $request->details;
        $company->email     = $request->email;
        $company->banner     = 'future_html/images/door_company.png';
        $company->poster     = 'future_html/images/door_company.png';
        $company->logo     = 'future_html/images/door_company.png';
        $company->total_staff= $request->total_staff;
        $company->role_id   = 2;
        $company->slug      = Str::slug($request->name) . '-' . time();
        $company->password  =  Hash::make($request->password);
        $company->save();

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
         $company=User::find($id);
         return response()->json([
             'company' => $company
         ]);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Admin.Company.edit')->withId($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company=User::find($id);
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255| unique:users,email, $company->id",
            'password' => 'required|string|min:6',
            'address' => 'required',
            'contact' => 'required|regex:/(03)[0-9]{9}/',
        ]);


        $company->name      = $request->name;
        $company->address   = $request->address;
        $company->contact   = $request->contact;
        $company->details      = $request->details;
        $company->email     = $request->email;
        $company->total_staff= $request->total_staff;
        $company->role_id   = 2;
        $company->slug      = Str::slug($request->name) . '-' . time();

        if (isset($request->password)) {
            $this->validate($request,[
                'password' => 'required|string|min:6',
            ]);
            $company->password  =  Hash::make($request->password);
        }

        $company->save();

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete_company($id)
    {
        User::where('id','=',$id)->delete();
        return redirect()->route('companies.index');
    }

    public function register_event_index($id)
    {
      return view('Admin.Company.register')->withId($id);
    }

    public function register_event(Request $request)
    {
        // return response()->json([
        //     'request' => $request->all(),
        // ]);

        $this->validate($request,[
            'slot_id' => 'required',
            'event_id' => 'required',
            'pavillion_id' => 'required',
        ],
        $messages = [
            'slot_id.required' => 'Select Valid Slot!',
            'event_id.required' => 'Select Valid Event!',
            'pavillion_id.required' => 'Select Valid Pavillion!',
        ]);

        $slot_name = $request['slot_name'];
        $slot_id = $request['slot_id'];
        $event_id = $request['event_id'];
        $company_id  = $request['company_id'];
        $pavillion_id  = $request['pavillion_id'];

        $event = Event::find($event_id);
        $event->users()->attach($company_id);

        $slot = new Slot;
        $slot->name   = $slot_name;
        $slot->event_id   = $event_id;
        $slot->company_id = $company_id;
        $slot->pavillion_id = $pavillion_id;
        $slot->save();

        // $pavillion = Pavillion::find($pavillion_id);
        // $slots_array = $pavillion->remaining_slots;
        // // dd(json_decode($slots_array));
        // return response()->json([
        //     'array' => $slots_array
        // ]);
        //removing selected slot from pavillion
        $pavillion = Pavillion::find($pavillion_id);
        $slots_array = json_decode($pavillion->remaining_slots);
        array_splice($slots_array, $slot_id, 1);
        $pavillion->remaining_slots = json_encode($slots_array);

        $pavillion->total_remaining_slots = $pavillion->total_remaining_slots - 1;

        $alloted_slots = json_decode($pavillion->alloted_slots);
        array_push($alloted_slots,$slot_name);
        $pavillion->alloted_slots = json_encode($alloted_slots);

        $pavillion->save();

        return response()->json([
            'request' => $request->all(),
            'slots_array' => $slots_array,
            'remaining_slots' => $pavillion->remaining_slots,
            'alloted_slots' => $pavillion->alloted_slots,
        ]);
    }
}
