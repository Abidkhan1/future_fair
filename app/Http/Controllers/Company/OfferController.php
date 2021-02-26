<?php

namespace App\Http\Controllers\Company;
use Auth;
use App\Models\Offer;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $offers = Offer::where('company_id','=',$id)
                        ->get();
        return view('Company.Offer.index')->withOffers($offers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company.Offer.add');
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
            'title' => 'required|string',
            'description' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $c_id = Auth::user()->id;

        $offer = new Offer;
        $offer->title = $request->title;
        $offer->description = $request->description;
        $offer->start_time = $request->start_time;
        $offer->end_time = $request->end_time;
        $offer->company_id = $c_id;
        $offer->save();

        return response()->json([
            'request' => $request->all(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer=Offer::find($id);
        return response()->json([
            'offer' => $offer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Company.Offer.edit')->withId($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|string',
            'description' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $offer = Offer::find($id);
        $offer->title = $request->title;
        $offer->description = $request->description;
        $offer->start_time = $request->start_time;
        $offer->end_time = $request->end_time;
        $offer->save();

        return response()->json([
            'request' => $request->all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function delete_offer($id)
    {
        Offer::where('id','=',$id)->delete();
        return redirect()->back();
    }
}
