<?php

namespace App\Http\Controllers\StoreManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\Service_category;
use App\Services;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use FileUploader;
use App\Service_photos;
use App\Service_status;
use App\Service_conversations;
use File;
use Storage;
use DB;


class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store_username)
    {
        $store = Store::where('username',$store_username)->first();
        $services = Services::where('store_id',$store->id)->get();
        $service_conversation = Service_conversations::where('store_id',$store->id)->orderBy('id','desc')->get();
        return view('storemanager.store.services',compact('store','services','service_conversation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($store_username)
    {
      $store = Store::where('username',$store_username)->first();
      $parent_categories = Service_category::where('parent_category_id',0)->pluck('name','id')->all();
      return view('storemanager.store.add-service',compact('store','parent_categories'));
    }


    public function GetSubCategoriesAjax($name,$id)
    {
        $subcategories = Service_category::where('parent_category_id',$id)->pluck('name','id')->all();
        return json_encode($subcategories);
    }

    public function GetSelectedSubCategoryAjax($name,$id,$service_id)
    {
        $subcategories = Service_category::where('parent_category_id',$id)->pluck('name','id')->all();
        $selectedsubcategory = Services::where('id',$service_id)->pluck('service_category_id')->first();
        $variable = array($subcategories,$selectedsubcategory);
        return json_encode($variable);
    }

    public function GetParentCategoryAjax($name,$id)
    {
        $parent_id = Service_category::where('id',$id)->first()->parent_category_id;
        $parentcategory = Service_category::where('id',$parent_id)->pluck('name','id')->all();
        return json_encode($parentcategory);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $service = new Services();
      $service->store_id = Crypt::decrypt($request->input('store_id'));
      $service->name = $request->input('name');
      $service->start_price = $request->input('start_price');
      $service->description = $request->input('description');
      $service->requirement = $request->input('requirement');
      $service->work_duration = $request->input('work_duration');
      $service->revision_time	 = $request->input('revision_time');
      $service->after_service_support_duration = $request->input('after_service_support_duration');
      $service->after_service_support_description = $request->input('after_service_support_description');
      $service->service_status_id = 1;
      $service->allowlocations = $request->input('allowlocations');
      $service->notallowlocations = $request->input('notallowlocations');
      $service->save();

      $store = Store::find($service->store_id);

      $public_path = public_path();
      $uploadDir = $public_path.'/images/';
      // Set up FileUploader
      $FileUploader = new FileUploader('productfile', array(
        'limit' => null,
        'maxSize' => null,
        'fileMaxSize' => null,
        'extensions' => null,
        'required' => false,
        'uploadDir' => $uploadDir,
        'title' => 'service_{timestamp}_{random}',
        'replace' => false,
        'editor' => array(
          'maxWidth' => 640,
          'maxHeight' => 480,
          'quality' => 100
        ),
        'listInput' => true,
        'files' => null,
        ));
       $upload = $FileUploader->upload();
       if($upload['isSuccess']) {
            // get the uploaded files
         $photos = $upload['files'];

         if(!empty($photos[0])){
           for ($i = 0; $i < count($photos); $i++) {
               $photo = $photos[$i];
               $name = $photo['name'];
               $original_name = $photo['old_name'];
               $upload = new Service_photos();
               $upload->name = $name;
               $upload->resized_name = " ";
               $upload->original_name = $original_name;
               $upload->photo_order = $photo['listProps']['index'];
               $upload->service_id = $service->id;
               $upload->save();
            }
          }

       } else {
         $warnings = $upload['warnings'];
         var_dump($warnings);
       }

      return redirect('/storemanager/store/'.$store->username.'/services');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($store_username, $service_id)
    {
      $store = Store::where('username',$store_username)->first();
      $service = Services::where('id',$service_id)->where('store_id',$store->id)->first();
      $service_photos = Service_photos::where('service_id',$service->id)->orderBy('photo_order','asc')->get();
      $parent_categories = Service_category::where('parent_category_id',0)->pluck('name','id')->all();
      $all_categories  = Service_category::where('parent_category_id','!=','0')->pluck('name','id')->all();

      return view('storemanager.store.edit-service',compact('store','service','service_photos','parent_categories','all_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $store_username, $service_id)
    {
      $input = $request->all();
      $service = Services::findOrFail($service_id)->update($input);

      $public_path = public_path();
      $uploadDir = $public_path.'/images/';
      $service_photos = Service_photos::where('service_id',$service_id)->orderBy('photo_order','asc')->get();

      foreach($service_photos as $service_photo) {
        // add file to our Preloaded File Array
        $preloadedFiles[] = array(
          "name" => $service_photo->name,
          "type" => 'image/*',
          "size" => filesize($uploadDir . $service_photo->name),
          "file" => url('images/') .'/'. $service_photo->name,
         );
       }

       if(empty($preloadedFiles)){
         $preloadedFiles = '';
       }


        // Set up FileUploader
        $FileUploader = new FileUploader('productfile', array(
          'limit' => null,
          'maxSize' => null,
          'fileMaxSize' => null,
          'extensions' => null,
          'required' => false,
          'uploadDir' => $uploadDir,
          'title' => 'service_{timestamp}_{random}',
          'replace' => false,
          'editor' => array(
            'maxWidth' => 640,
            'maxHeight' => 480,
            'quality' => 100
          ),
          'listInput' => true,
          'files' => $preloadedFiles,
          ));
         $upload = $FileUploader->upload();
         if($upload['isSuccess']) {
              // get the uploaded files
           $photos = $upload['files'];

           if(!empty($photos[0])){
             for ($i = 0; $i < count($photos); $i++) {
                 $photo = $photos[$i];
                 $name = $photo['name'];
                 $original_name = $photo['old_name'];
                 $upload = new Service_photos();
                 $upload->name = $name;
                 $upload->resized_name = " ";
                 $upload->original_name = $original_name;
                 $upload->photo_order = $photo['listProps']['index'];
                 $upload->service_id = $service_id;
                 $upload->save();
              }
            }

         } else {
           $warnings = $upload['warnings'];
           var_dump($warnings);
         }


       //Remove delete file
      $removedfiles = $FileUploader->getRemovedFiles();
      if(!empty($removedfiles)){
        for($i = 0; $i<count($removedfiles); $i++)
        {
             $file_name = $removedfiles[$i]['name'];
             $service_photos = Service_photos::where('name',$file_name)->delete( );
             Storage::delete('/images//'.$file_name);
         }
       }

        // Update image order
         $listInputs = $FileUploader->getListInput();
         if (isset($listInputs)) {
           for($i = 0; $i<count($listInputs['values']); $i++)
           {
                $file_values = pathinfo($listInputs['values'][$i]['file']);
                $file_name = $file_values['basename'];
                $product_photos = Service_photos::where('name',$file_name)->update(['photo_order'=>$listInputs['values'][$i]['index']]);
            }
          }




       Session::flash('edit_successful','บริการนี้ได้ถูกแก้ไขเรียบร้อยแล้ว');
       return redirect('/storemanager/store/'.$store_username.'/services/'.$service_id.'/edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($store_username,$id)
    {
        return redirect()->back();
    }

    public function deleteService($store_username,$service_id){

      $service = Services::find($service_id);
      foreach($service->service_photos as $photo)
      {
        $service_photo = Service_photos::where('name',$photo->name);
        $service_photo->delete();
        File::delete("images/".$photo->name);

      }
      $service->delete();
      return "success";

    }

    public function setServicePublish(Request $request,$store_username){
      $service = Services::find($_GET['service_id']);
      $service->is_publish = "1";
      $service->save();
      return json_encode(TRUE);
    }

    public function setServiceUnPublish(Request $request,$store_username){
      $service = Services::find($_GET['service_id']);
      $service->is_publish = "0";
      $service->save();
      return json_encode(TRUE);
    }
}
