<?php

namespace App\Http\Controllers\Company;
use Auth;
use App\Models\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('hello Gallery');
        $id = Auth::user()->id;
        return view('Company.Profile.gallery')->withId($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('add gallery');
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
            'image' => 'required',
        ]);

        $user = Auth::user();
        $user_id = Auth::user()->id;
        $upload_path = public_path().'/uploads/';
        if(!Storage::exists($upload_path)){
            Storage::makeDirectory($upload_path);
        }

        if($request->hasFile('image')){

            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $path = $upload_path.$user_id.'/';
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }

            $status = $image->move($path, $filename);
            $path = '/uploads/'.$user_id.'/'.$filename;

            $doc = new Upload;
            $doc->name = $path;
            $doc->title = $request->title;
            $doc->type = 'gallery';
            $doc->user_id = $user_id;
            $doc->save();
      }//if images

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $images = Upload::where('user_id','=',$id)->where('type','=','gallery')->get();
        return response()->json([
            'images' => $images
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
        //
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
        //
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
}
