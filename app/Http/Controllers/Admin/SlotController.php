<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slot;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('slots');
        $slots = Slot::all();
        return view('Admin.Slot.index')->withSlots($slots);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Slot.add');
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
            'name' => 'required|string',
            'event_id' => 'required',
        ]);

        $slot = new Slot;
        $slot->name = $request->name;
        $slot->event_id = $request->event_id;
        $slot->save();

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slot = Slot::find($id);
        $events = Event::all();

        return response()->json([
            'slot' => $slot,
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
        return view('Admin.Slot.edit')->withId($id);
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
        $this->validate($request,[
            'name' => 'required|string',
            'event_id' => 'required',
        ]);

        $slot = Slot::find($id);
        $slot->name = $request->name;
        $slot->event_id = $request->event_id;
        $slot->save();

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slot $slot)
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

    public function delete_slot($id)
    {
        Slot::where('id','=',$id)->delete();
        return redirect()->route('slots.index');
    }
}
