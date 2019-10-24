<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services;
use App\Store;
use App\Service_photos;
use App\Service_category;
use FileUploader;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Validator;
use App\Photo;

class AdminServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
      $services = Services::all();
      return view('admin.services.index', compact('services'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($service_id)
    {
      $service = Services::where('id',$service_id)->first();
      $store = Store::where('id',$service->store->id)->first();
      $service_photos = Service_photos::where('service_id',$service->id)->orderBy('photo_order','asc')->get();
      $parent_categories = Service_category::where('parent_category_id','0')->pluck('name','id')->all();
  //    $all_categories  = Service_category::whereNotNull('parent_category_id')->pluck('name','id')->all();
      return view('admin.services.edit',compact('store','service','service_photos','parent_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $service_id)
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
       return redirect()->back();
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

    public function setActive()
    {
      $service = Services::find($_GET['service_id']);
      $service->service_status_id = "2";
      $service->save();
      return json_encode("true");
    }

    public function setInactive()
    {
      $service = Services::find($_GET['service_id']);
      $service->service_status_id = "1";
      $service->save();
      return json_encode("true");
    }

    /* ServiceCategory */


    public function showServiceCategoryList(){
      $categories = Service_category::all();
      return view('admin.services.categories.index', compact('categories'));
    }

    public function editServiceCategory(Request $request,$category_id){
      $category = Service_category::where('id',$category_id)->first();
      $all_parent_categories = Service_category::where('parent_category_id','0')->get();
      return view('admin.services.categories.edit', compact('category','all_parent_categories'));
    }


    public function updateServiceCategory(Request $request,$category_id){
      $input = $request->all();
      $validator = Validator::make($request->all(), [
                'profile_photo_id' => 'mimes:jpeg,png,jpg|max:512',
                'cover_photo_id' => 'mimes:jpeg,png,jpg|max:512',
                'icon_photo_id' => 'mimes:jpeg,png,jpg|max:512',
            ]);
     if ($validator->fails()) {
           return redirect()->back()
                   ->withErrors($validator)
                   ->withInput();
      }
      else{
        $category = Service_category::where('id',$category_id)->first();
        $category->name = $input['name'];
        $category->description = $input['description'];
        $category->parent_category_id = $input['category_id'];

        if($request->file('profile_photo_id')!==NULL){
          $imageName = time().'_'.request()->file('profile_photo_id')->getClientOriginalName();
          request()->file('profile_photo_id')->move(public_path('images'), $imageName);
          $profile_photo = new Photo();
          $profile_photo->file = $imageName;
          $profile_photo->save();
          $category->profile_photo = $profile_photo->id;
        }

        if($request->file('cover_photo_id')!==NULL){
          $imageName = time().'_'.request()->file('cover_photo_id')->getClientOriginalName();
          request()->file('cover_photo_id')->move(public_path('images'), $imageName);
          $cover_photo = new Photo();
          $cover_photo->file = $imageName;
          $cover_photo->save();
          $category->cover_photo = $cover_photo->id;
        }

        if($request->file('icon_photo_id')!==NULL){
          $imageName = time().'_'.request()->file('icon_photo_id')->getClientOriginalName();
          request()->file('icon_photo_id')->move(public_path('images'), $imageName);
          $icon_photo = new Photo();
          $icon_photo->file = $imageName;
          $icon_photo->save();
          $category->icon_photo = $icon_photo->id;
        }

        $category->save();
        return redirect()->back()->with('success-message', 'ได้แก้ไขหมวดหมู่สินค้าเรียบร้อยแล้ว');
      }

     }

     public function createServiceCategory(){
       $all_parent_categories = Service_category::where('parent_category_id','0')->get();
       return view('admin.services.categories.create',compact('all_parent_categories'));
     }

     public function storeNewServiceCategory(Request $request){
       $input = $request->all();
       $category = new Service_category();
       $category->name = $input['name'];
       $category->description = $input['description'];
       $category->parent_category_id = $input['category_id'];
       $category->save();

       if($request->file('profile_photo_id')!==NULL){
         $imageName = time().'_'.request()->file('profile_photo_id')->getClientOriginalName();
         request()->file('profile_photo_id')->move(public_path('images'), $imageName);
         $profile_photo = new Photo();
         $profile_photo->file = $imageName;
         $profile_photo->save();
         $category->profile_photo = $profile_photo->id;
       }

       if($request->file('cover_photo_id')!==NULL){
         $imageName = time().'_'.request()->file('cover_photo_id')->getClientOriginalName();
         request()->file('cover_photo_id')->move(public_path('images'), $imageName);
         $cover_photo = new Photo();
         $cover_photo->file = $imageName;
         $cover_photo->save();
         $category->cover_photo = $cover_photo->id;
       }

       if($request->file('icon_photo_id')!==NULL){
         $imageName = time().'_'.request()->file('icon_photo_id')->getClientOriginalName();
         request()->file('icon_photo_id')->move(public_path('images'), $imageName);
         $icon_photo = new Photo();
         $icon_photo->file = $imageName;
         $icon_photo->save();
         $category->icon_photo = $icon_photo->id;
       }
       $category->save();
       return redirect('/admin/service-categories')->with('success-message', 'ได้สร้างหมวดหมู่บริการใหม่เรียบร้อยแล้ว');
     }
}
