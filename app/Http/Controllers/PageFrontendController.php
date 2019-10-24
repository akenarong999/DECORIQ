<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;

class PageFrontendController extends Controller
{
  public function showPage($slug)
  {
    $page = Pages::where('slug',$slug)->first();
    if($page){
    return view('page',compact('page'));
    }else{
       return abort(404);
    }
  }
}
