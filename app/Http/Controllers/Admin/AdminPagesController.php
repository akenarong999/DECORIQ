<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pages;
use FileUploader;
use Session;
use App\Photo;

class AdminPagesController extends Controller
{
  public function index()
  {
    $pages = Pages::orderBy('id', 'desc')->get();
    return view('admin.pages.index',compact('pages'));
  }

  public function edit($page_id)
  {
    $page = Pages::where('id',$page_id)->firstOrFail();
    $page_cover_photo = $page->photo;
    return view('admin.pages.edit',compact('page','page_cover_photo'));
  }

  public function update(Request $request, $page_id)
  {
    $input = $request->all();
    Pages::findOrFail($page_id)->update($input);

    $public_path = public_path();
    $uploadDir = $public_path.'/images/';


    // Set up FileUploader
   $FileUploader = new FileUploader('pagefile', array(
        'limit' => 1,
        'maxSize' => null,
        'fileMaxSize' => null,
        'extensions' => null,
        'required' => true,
        'uploadDir' => $uploadDir,
        'title' => '{timestamp}_{random}_{random}',
        'replace' => false,
        'editor' => array(
          'maxWidth' => 3000,
          'maxHeight' => 800,
          'quality' => 90
        ),
        'listInput' => true,
        ));
       $upload = $FileUploader->upload();

     if($upload['isSuccess']) {
          // get the uploaded files
       $photos = $upload['files'];
       if(!empty($photos[0])){
         for ($i = 0; $i < count($photos); $i++) {
             $photo = $photos[$i];
             $name = $photo['name'];
             $upload = new Photo();
             $upload->file = $name;
             $upload->save();
             $page = Pages::where('id',$page_id)->firstOrFail();
             $page->photo_id = $upload->id;
             $page->save();
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
           $product_photos = Product_photos::where('name',$file_name)->delete( );
           Storage::delete('/images//'.$file_name);
       }
     }



     Session::flash('edit_successful','หน้านี้ได้ถูกแก้ไขเป็นที่เรียบร้อยแล้ว');
     return redirect('/admin/pages/edit/'.$page_id.'');
  }
}
