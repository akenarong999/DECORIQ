<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Webelement_homepage_slider_photos;
use App\Photo;
use App\Webelement_components;
use Storage;
use FileUploader;

class AdminWebElementController extends Controller
{
  public function index()
  {
    return view('admin.webelement.index');
  }

  public function HomepageEditor(){
    $slide_photos = Webelement_homepage_slider_photos::all();
    $homepagefeaturedproductcategories = Webelement_components::where('component_name','featured_product_categories')->where('component_page','homepage')->first();
    $homepagefeaturedproducts = Webelement_components::where('component_name','featured_products')->where('component_page','homepage')->first();
    $homepagefeaturedservices = Webelement_components::where('component_name','featured_services')->where('component_page','homepage')->first();
    return view('admin.webelement.homepage-editor', compact('slide_photos','homepagefeaturedproductcategories','homepagefeaturedproducts','homepagefeaturedservices'));
  }

  public function EditHomepageSlideshow(Request $request){
    $input = $request->all();

    for($i=1;$i<=$input["count_slide"];$i++){
      $slide_photo = Webelement_homepage_slider_photos::where('id',$input["slide-photo-id-".$i])->first();
      $slide_photo->description = $input["slide-description-".$i];
      $slide_photo->link = $input["slide-link-".$i];
      $slide_photo->save();

      $public_path = public_path();
      $uploadDir = $public_path.'/images/';

      $preloadedFiles[] = array(
        "name" => $slide_photo->photo_file,
        "type" => 'image/*',
        "size" => filesize($uploadDir . $slide_photo->photo_file),
        "file" => url('images/') .'/'. $slide_photo->photo_file,
       );


       if(empty($preloadedFiles)){
         $preloadedFiles = '';
       }
        // Set up FileUploader
        $FileUploader = new FileUploader('homepage-slideshow', array(
          'limit' => null,
          'maxSize' => null,
          'fileMaxSize' => null,
          'extensions' => null,
          'required' => false,
          'uploadDir' => $uploadDir,
          'replace' => false,
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
               $slide_photo->photo_file = $photo['name'];
               $slide_photo->save();
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
         Storage::delete('/images//'.$file_name);
         }
       }

     }
    return redirect()->back();
  }

  public function EditHomepageFeaturedProductCategories(Request $request){
    $input = $request->all();
    $homepagefeaturedproductcategories = Webelement_components::where('component_name','featured_product_categories')->where('component_page','homepage')->first();
    $homepagefeaturedproductcategories->component_value = $input['component_value'];
    $homepagefeaturedproductcategories->save();
    return redirect()->back();
  }

  public function EditHomepageFeaturedProducts(Request $request){
    $input = $request->all();
    $homepagefeaturedproducts = Webelement_components::where('component_name','featured_products')->where('component_page','homepage')->first();
    $homepagefeaturedproducts->component_value = $input['component_value'];
    $homepagefeaturedproducts->save();
    return redirect()->back();
  }

  public function EditHomepageFeaturedServices(Request $request){
    $input = $request->all();
    $homepagefeaturedservices = Webelement_components::where('component_name','featured_services')->where('component_page','homepage')->first();
    $homepagefeaturedservices->component_value = $input['component_value'];
    $homepagefeaturedservices->save();
    return redirect()->back();
  }

}
