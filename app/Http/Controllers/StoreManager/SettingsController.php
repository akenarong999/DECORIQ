<?php

namespace App\Http\Controllers\StoreManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use DB;
use Auth;
use App\Store_addresses;
use FileUploader;
use App\Photo;
use App\User;

class SettingsController extends Controller
{
  public function index($store_username)
  {
    $store_id = Store::where('username',$store_username)->first()->id;
    $store = Store::where('id',$store_id)->firstOrFail();
    return view('storemanager.store.settings',compact('store'));
  }

  public function editStoreProfile(Request $request, $store_username){
    $store = Store::where('username',$store_username)->first();
    $store->name = $request->store_name;
    $store->description = $request->store_description;
    $store->save();
    return back()->with('success','เปลี่ยนแปลงรายละเอียดร้านค้าเรียบร้อยแล้ว');
  }

  public function StorePhoto($store_username){
    $store_id = Store::where('username',$store_username)->first()->id;
    $store = Store::where('id',$store_id)->firstOrFail();
    return view('storemanager.store.setting-store-photo',compact('store'));
  }


    public function updateStorePhoto(Request $request, $store_username){
      if(Auth::check()){
        $input = $request->all();


        $profile_photo = $request->file('profilephoto');
        $cover_photo = $request->file('coverphoto');

        $public_path = public_path();
        $uploadDir = $public_path.'/images/';

        if(!is_null($profile_photo)){

        // Set up FileUploader
        $profilephoto = new FileUploader('profilephoto', array(
          'limit' => null,
          'maxSize' => null,
          'fileMaxSize' => null,
          'extensions' => null,
          'required' => false,
          'uploadDir' => $uploadDir,
          'title' => $input['store_name'].'_{random}',
          'replace' => false,
          'editor' => array(
            'minWidth' => 400,
            'minHeight' => 400,
            'quality' => 80,
            'crop' => true,
          ),
          'listInput' => true,
          'files' => null,
          ));
         $upload = $profilephoto->upload();
         if($upload['isSuccess']) {
              // get the uploaded files
           $photos = $upload['files'];

           if(!empty($photos[0])){
             for ($i = 0; $i < count($photos); $i++) {
                 $photo = $photos[$i];
                 $upload = new Photo();
                 $upload->file = $photo['name'];
                 $upload->save();
                 $store = Store::where('username',$store_username)->first();
                 $store->photo_id = $upload->id;
                 $store->save();
              }
            }

         } else {
           $warnings = $upload['warnings'];
           var_dump($warnings);
         }
       }

        if(!is_null($cover_photo)){
          // Set up FileUploader
          $coverphoto = new FileUploader('coverphoto', array(
            'limit' => null,
            'maxSize' => null,
            'fileMaxSize' => null,
            'extensions' => null,
            'required' => false,
            'uploadDir' => $uploadDir,
            'title' => $input['store_name'].'_{random}_cover',
            'replace' => false,
            'editor' => array(
              'minWidth' => 1024,
              'minHeight' => 341,
              'quality' => 80,
              'crop' => true,
            ),
            'listInput' => true,
            'files' => null,
            ));
           $upload = $coverphoto->upload();
           if($upload['isSuccess']) {
                // get the uploaded files
             $photos = $upload['files'];

             if(!empty($photos[0])){
               for ($i = 0; $i < count($photos); $i++) {
                   $photo = $photos[$i];
                   $upload = new Photo();
                   $upload->file = $photo['name'];
                   $upload->save();
                   $store = Store::where('username',$store_username)->first();
                   $store->cover_photo_id = $upload->id;
                   $store->save();
                }
              }

           } else {
             $warnings = $upload['warnings'];
             var_dump($warnings);
           }

        }


        return redirect()->back()->with('success','อัพเดทโปรไฟล์นี้เรียบร้อยแล้ว!');

      }
        else{
          return "Cant update. No authorize to update this profile.";
        }
    }

  public function settingaddress($store_username)
  {
    $store_id = Store::where('username',$store_username)->first()->id;
    $store = Store::where('id',$store_id)->firstOrFail();
    $store_addresses = Store_addresses::where('store_id',$store_id)->get();
    return view('storemanager.store.setting-address',compact('store','store_addresses'));
  }

  public function addStoreaddress(Request $request,$store_username)
  {
    $input = $request->all();
    $store_id = Store::where('username',$store_username)->first()->id;
    $address1 = $request->input('address1');
    $address2 = $request->input('address2');
    $thai_city_id = $request->input('thai_city_id');
    $postal_code = $request->input('postal_code');
    $tel_number = $request->input('tel_number');
    $thai_city = DB::table('thai_city')->where('id', $thai_city_id)->pluck('name')->first();
    DB::table('store_addresses')->insert(
    [
      'store_id' => $store_id,
      'address1' => $address1 ,
      'address2' => $address2 ,
      'thai_city_id' => $thai_city_id,
      'thai_city' => $thai_city,
      'postal_code' =>  $postal_code,
      'tel_number' => $tel_number
    ]
    );
    return redirect()->back();
  }

  public function saveStoreaddress(Request $request,$store_username)
  {

    $store_id = Store::where('username',$store_username)->first()->id;
    $store = Store::find($store_id);
    $store->main_address_id = $request->main_address_id;
    $store->return_address_id = $request->return_address_id;
    $store->save();
    return back()->with('success','เปลี่ยนแปลงที่อยู่ร้านค้าเรียบร้อยแล้ว');
  }


}
