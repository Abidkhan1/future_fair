<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    //
    public function video()
    {
      return view('Company.VideoChat.video');
    }
}
