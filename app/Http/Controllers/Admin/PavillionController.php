<?php

namespace App\Http\Controllers\Admin;
use App\Models\Event;
use App\Models\Pavillion;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PavillionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pavillions = Pavillion::all();
        return view('Admin.Pavillion.index')
             ->withPavillions($pavillions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pavillion.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $check_pav = Pavillion::where('name','=',$request->name)
        ->where('event_id','=',$request->event_id)
        ->first();

        if($check_pav){
            return response()->json([
                'status' => false,
                'not_unique' => true,
            ]);
        }

        $this->validate($request,[
            'name' => 'required|string',
            'event_id' => 'required',
        ]);

        $free_slots = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14');
        $allot_slots = [];
        $pavillion = new Pavillion;
        $pavillion->name = $request->name;
        $pavillion->remaining_slots = json_encode($free_slots);
        $pavillion->alloted_slots = json_encode($allot_slots);
        $pavillion->event_id = $request->event_id;
        $pavillion->save();

        return response()->json([
            'status' => true,
            'not_unique' => false,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pavillion  $pavillion
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
         $pavillion = Pavillion::find($id);
         $events = Event::all();

         return response()->json([
             'pavillion' => $pavillion,
             'events' => $events,
         ]);
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Slot  $slot
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         return view('Admin.Pavillion.edit')->withId($id);
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Slot  $slot
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
         $check_pav = Pavillion::where('name','=',$request->name)
         ->where('event_id','=',$request->event_id)
         ->first();

         if($check_pav){
             return response()->json([
                 'status' => false,
                 'not_unique' => true,
             ]);
         }

         $this->validate($request,[
             'name' => 'required|string',
             'event_id' => 'required',
         ]);

         $pavillion = Pavillion::find($id);
         $pavillion->name = $request->name;
         $pavillion->event_id = $request->event_id;
         $pavillion->save();

         return response()->json([
             'status' => true
         ]);
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pavillion  $pavillion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pavillion $pavillion)
    {
        //
    }

    public function events_list()
    {
        $events = Event::all();
        return response()->json([
            'events' => $events
        ]);
    }

    public function event_pavillions($event_id,$company_id)
    {
        $event_user = EventUser::where('user_id','=',$company_id)
        ->where('event_id','=',$event_id)->first();

        $pavillions = [];

        if ($event_user) {
            $status = false;
        }else {
            $status = true;
            $pavillions = Pavillion::where('event_id','=',$event_id)
                               ->get();
        }

        return response()->json([
            'status' => $status,
            'pavillions' => $pavillions,
        ]);
    }

    public function delete_pavillion($id)
    {
        Pavillion::where('id','=',$id)->delete();
        return redirect()->route('pavillions.index');
    }
}
