<?php

namespace App\Http\Controllers\Company;

use DB;
use Auth;
use App\Models\Role;
use App\Models\User;
use App\Models\Upload;
use App\Models\Template;
use App\Models\SlotDesign;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        return view('Company.Profile.profile')->withId($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company=User::where('id','=',$id)->with('links')->first();

        foreach ($company->links as $key => $link) {
            $type = $link->type;
            $name = $link->name;
            $url = $link->type.'_url';
            $company->$type = $name;
            $company->$url = $link->url;
        }

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

    public function comp_prof_details(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $this->validate($request,[
            'name' => 'required|string',
            'slogan' => 'required|string',
            'details' => 'required|string',
            'web_url' => 'required|url',
            'display_name' => 'required|string',
            'location' => 'required|string',
            'total_employees' => 'required|integer',
            'email' => "required|string|email|max:255| unique:users,email,$id"
        ]);

        $user->name = $request->name;
        $user->slogan = $request->slogan;
        $user->details = $request->details;
        $user->web_url = $request->web_url;
        $user->display_name = $request->display_name;
        $user->location = $request->location;
        $user->creation_date = $request->creation_date;
        $user->description = $request->description;
        $user->email = $request->email;
        $user->total_employees = $request->total_employees;
        $user->save();

        // if ($request->name_ext_link && $request->ext_link) {
        SocialLink::where('user_id','=',$id)
        ->where('type','=', 'name_ext_link')
        ->orWhere('type','=', 'name_comp_link_1')
        ->orWhere('type','=', 'name_comp_link_2')
        ->delete();

            $link = new SocialLink;
            $link->type = 'name_ext_link';
            $link->name = $request->name_ext_link;
            $link->url = $request->ext_link;
            $link->user_id = $id;
            $link->save();
        // }

        // if ($request->name_comp_link_1 && $request->comp_link_1) {

            $link = new SocialLink;
            $link->type = 'name_comp_link_1';
            $link->name = $request->name_comp_link_1;
            $link->url = $request->comp_link_1;
            $link->user_id = $id;
            $link->save();
        // }

        // if ($request->name_comp_link_2 && $request->comp_link_2) {

            $link = new SocialLink;
            $link->type = 'name_comp_link_2';
            $link->name = $request->name_comp_link_2;
            $link->url = $request->comp_link_2;
            $link->user_id = $id;
            $link->save();
        // }

        SocialLink::where('user_id','=',$id)
        ->where('type','=', 'youtube')
        ->orWhere('type','=', 'twitter')
        ->orWhere('type','=', 'linkedin')
        ->orWhere('type','=', 'facebook')->delete();

        $link = new SocialLink;
        $link->type = 'facebook';
        $link->name =  'facebook';
        $link->url = $request->facebook;
        $link->user_id = $id;
        $link->save();

        $link = new SocialLink;
        $link->type = 'twitter';
        $link->name =  'twitter';
        $link->url = $request->twitter;
        $link->user_id = $id;
        $link->save();

        $link = new SocialLink;
        $link->type = 'linkedin';
        $link->name =  'linkedin';
        $link->url = $request->linkedin;
        $link->user_id = $id;
        $link->save();

        $link = new SocialLink;
        $link->type = 'youtube';
        $link->name =  'youtube';
        $link->url = $request->youtube;
        $link->user_id = $id;
        $link->save();

        return response()->json([
         'request' => $request->all(),
         'status' => true
        ]);
    }

    public function comp_banner_poster()
    {
        $id = Auth::user()->id;
        return view('Company.Profile.banner_poster')->withId($id);
    }

    public function get_banner_poster()
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user,
        ]);
    }

    public function save_banner_poster(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $upload_path = public_path().'/uploads/';
        if(!Storage::exists($upload_path)){
            Storage::makeDirectory($upload_path);
        }

        if($request->hasFile('banner')){

            $banner = $request->file('banner');
            $filename = $banner->getClientOriginalName();
            $path = $upload_path.$user_id.'/';
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }

            if (file_exists(public_path().$user->banner) && $user->banner) {
                unlink(public_path().$user->banner);
            }

            $status = Storage::delete($user->banner);
            $status = $banner->move($path, $filename);
            $banner_path = '/uploads/'.$user_id.'/'.$filename;
            $user->banner = $banner_path;
            $user->save();
        }//if banner

        if($request->hasFile('logo')){

            $logo = $request->file('logo');
            $filename = $logo->getClientOriginalName();
            $path = $upload_path.$user_id.'/';
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }

            if (file_exists(public_path().$user->logo) && $user->logo) {
                unlink(public_path().$user->logo);
            }

            $status = Storage::delete($user->logo);
            $status = $logo->move($path, $filename);
            $logo_path = '/uploads/'.$user_id.'/'.$filename;
            $user->logo = $logo_path;
            $user->save();
        }//if logo

        if($request->hasFile('poster')){
            $poster = $request->file('poster');
            $filename = $poster->getClientOriginalName();
            $path = $upload_path.$user_id.'/';
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }

            if (file_exists(public_path().$user->poster) && $user->poster) {
                unlink(public_path().$user->poster);
            }

            $status = $poster->move($path, $filename);
            $poster_path = '/uploads/'.$user_id.'/'.$filename;
            $user->poster = $poster_path;
            $user->save();
        }//if banner
        return redirect()->route('comp_banner_poster');
    }

    public function comp_documents()
    {
        $id = Auth::user()->id;
        return view('Company.Profile.upload_documents')->withId($id);
    }

    public function get_documents()
    {
        $id = Auth::user()->id;
        $documents = Upload::where('user_id','=',$id)
        ->where('type','=','document')
        ->get();

        return response()->json([
            'documents' => $documents,
        ]);
    }

    public function save_documents(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $upload_path = public_path().'/uploads/';
        if(!Storage::exists($upload_path)){
            Storage::makeDirectory($upload_path);
        }

        // Upload::where('user_id','=',$user_id)->where('type','=','document')->delete();

        if($request->hasFile('images')){

          foreach ($request->images as $key => $image) {

            $filename = $image->getClientOriginalName();
            $path = $upload_path.$user_id.'/';
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }

            // if (file_exists(public_path().$filename)) {
            //     unlink(public_path().$filename);
            // }

            $status = $image->move($path, $filename);
            $path = '/uploads/'.$user_id.'/'.$filename;

            $doc = new Upload;
            $doc->name = $path;
            $doc->type = 'document';
            $doc->user_id = $user_id;
            $doc->save();
            // code...
          }//foreach images
      }//if images

        return redirect()->route('comp_documents');
    }

    public function remove_document(Request $request)
    {
        $doc = Upload::where('name','=',$request->document['name'])->first();

        if (! empty($doc)) {
            $filename = $doc->name;
            if (file_exists(public_path().$filename)) {
                unlink(public_path().$filename);
            }

            Upload::where('name','=',$request->document['name'])->delete();
        }

        return response()->json([
            'request' => $request->all()
        ]);
    }

    public function videos()
    {
        $id = Auth::user()->id;
        return view('Company.Profile.upload_videos')->withId($id);
    }

    public function upload_videos(Request $request)
    {
        // return response()->json([
        //     'videos'=>$request->videos,
        //     'status' => true
        // ]);
        $user_id = Auth::user()->id;

        Upload::where('type','=','video')->where('user_id','=', $user_id)->delete();

        foreach ($request->videos as $key => $video) {
            $doc = new Upload;
            $doc->name = $video['url'];
            $doc->type = 'video';
            $doc->user_id = $user_id;
            $doc->save();
        }

        return response()->json([
            'videos'=>$request->videos,
            'status' => true
        ]);
    }

    public function upload_videos_old(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $upload_path = public_path().'/uploads/';
        if(!Storage::exists($upload_path)){
            Storage::makeDirectory($upload_path);
        }

        if($request->hasFile('videos')){

          foreach ($request->videos as $key => $video) {

            $filename = $video->getClientOriginalName();
            $path = $upload_path.$user_id.'/';
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }

            $status = $video->move($path, $filename);
            $path = 'uploads/'.$user_id.'/'.$filename;

            $doc = new Upload;
            $doc->name = $path;
            $doc->type = 'video';
            $doc->user_id = $user_id;
            $doc->save();
            // code...
        }//foreach videos
    }//if videos
        return redirect()->route('home');
    }

    public function get_videos()
    {
        $id = Auth::user()->id;
        $videos = Upload::where('user_id','=',$id)
        ->where('type','=','video')
        ->get();

        return response()->json([
            'videos' => $videos,
        ]);
    }

    public function remove_video(Request $request)
    {
        $id = Auth::user()->id;
        $vid = Upload::where('name','=',$request->video['name'])->where('user_id','=',$id)->first();

        if (! empty($vid)) {
            $filename = $vid->name;
            if (file_exists(public_path().$filename)) {
                unlink(public_path().$filename);
            }

            Upload::where('name','=',$request->video['name'])->where('user_id','=', $id)->delete();
        }

        return response()->json([
            'request' => $request->all()
        ]);
    }

    public function design()
    {
        return view('Company.Profile.design');
    }

    public function get_design()
    {
        $r_id = Role::where('name','=','staff')
                    ->first()->id;
        $company = Auth::user();
        $slot_design = $company->slot_design;
        $u_id = Auth::user()->id;
        $staffs = User::where('role_id','=',$r_id)
        ->where('company_id','=',$u_id)->get();

        $templates = Template::all();

        return response()->json([
            'staffs' => $staffs,
            'templates' => $templates,
            'slot_design' => $slot_design,
        ]);
    }

    public function save_design(Request $request)
    {
        $company_id = Auth::user()->id;

        SlotDesign::where('company_id','=',$company_id)->delete();

        $des = new SlotDesign;
        $des->staff_id = $request->staff_id;
        $des->template_id = $request->template_id;
        $des->company_id = $company_id;
        $des->save();

        return response()->json([
            'status'=>true
        ]);
    }
}
