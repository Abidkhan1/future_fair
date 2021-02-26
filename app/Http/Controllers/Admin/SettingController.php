<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class SettingController extends Controller
{
    public function user_dashboard()
    {
      return view('Admin.Setting.enduser_setting');
    }

    public function user_dashboard_data()
    {
        $data = SiteSetting::all();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function save_settings(Request $request)
    {

        // $this->validate($request,[
        //     'title' => 'required|string|max:30',
        //     'description' => 'required|string|max:1000',
        // ]);

        // $this->validate($request,[
        //     'title' => 'required|string',
        //     'description' => 'required|string',
        // ]);

        // dd($request->title);
        $title_check = SiteSetting::where('name','=','dashboard_title')->first();
        // dd(isset($title_check->name));
        if (isset($title_check->name)) {
            $title_check->value = $request->title;
            $title_check->save();
        }else {
            $site = new SiteSetting;
            $site->name = 'dashboard_title';
            $site->value = $request->title;
            $site->save();
        }

        $desc_check = SiteSetting::where('name','=','dashboard_description')->first();

        if (isset($desc_check->name)) {
            $desc_check->value = $request->description;
            $desc_check->save();
        }else {
            $site = new SiteSetting;
            $site->name = 'dashboard_description';
            $site->value = $request->description;
            $site->save();
        }

        //clear old logos
        SiteSetting::where('name','like','dashboard_logo'.'%')->delete();
        //clear old logos
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $upload_path = public_path().'/uploads/';
        if(!Storage::exists($upload_path)){
            Storage::makeDirectory($upload_path);
        }

        if($request->hasFile('logos')){

          foreach ($request->logos as $key => $image) {
            $filename = $image->getClientOriginalName();
            $path = $upload_path.$user_id.'/dashboard_logos'.'/';
            if(Storage::exists($path)){
                Storage::deleteDirectory($path);
                unlink($path);
            }
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }
            $status = $image->move($path, $filename);
            $path = '/uploads/'.$user_id.'/dashboard_logos'.'/'.$filename;

            $name = 'dashboard_logo'.$key;

            $check = SiteSetting::where('name','=',$name)->first();

            if ($check) {
                $check->value = $path;
                $check->save();
            }else {
                $site_logo = new SiteSetting;
                $site_logo->name = $name;
                $site_logo->value = $path;
                $site_logo->save();
            }
          }//foreach images
        }//if images
        return redirect()->back();
    }//save_settings
}
