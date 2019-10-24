<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Partner_registeration;
use Validator;

class PartnerController extends Controller
{
  public function index()
  {
    return view('become-partner');
  }

  public function storeRegisterApplication(Request $request){
    $input = $request->all();

    $validator = Validator::make($request->all(), [
              'photo_1' => 'mimes:jpeg,png,jpg|max:256',
              'photo_2' => 'mimes:jpeg,png,jpg|max:256',
              'photo_3' => 'mimes:jpeg,png,jpg|max:256',
          ]);
   if ($validator->fails()) {
         return redirect()->back()
                 ->withErrors($validator)
                 ->withInput();
    }
    else{

      $partner_registeration = new Partner_registeration($input);

      if($request->file('photo_1')!==NULL){
        $imageName = time().'_'.request()->file('photo_1')->getClientOriginalName();
        request()->file('photo_1')->move(public_path('images'), $imageName);
        $photo_1 = new Photo();
        $photo_1->file = $imageName;
        $photo_1->save();
        $partner_registeration->photo_1 = $photo_1->id;
      }

      if($request->file('photo_2')!==NULL){
        $imageName = time().'_'.request()->file('photo_2')->getClientOriginalName();
        request()->file('photo_2')->move(public_path('images'), $imageName);
        $photo_2 = new Photo();
        $photo_2->file = $imageName;
        $photo_2->save();
        $partner_registeration->photo_2 = $photo_2->id;
      }

      if($request->file('photo_3')!==NULL){
        $imageName = time().'_'.request()->file('photo_3')->getClientOriginalName();
        request()->file('photo_3')->move(public_path('images'), $imageName);
        $photo_3 = new Photo();
        $photo_3->file = $imageName;
        $photo_3->save();
        $partner_registeration->photo_3 = $photo_3->id;
      }
      $partner_registeration->save();
      return redirect()->back()->with('success_message', 'ขอบคุณที่สนใจร่วมเป็นพาร์ทเนอร์กับเรา ทางเราจะตรวจสอบข้อมูลและติดต่อกลับในภายหลัง ขอบคุณค่ะ :)');

    }
  }
}
