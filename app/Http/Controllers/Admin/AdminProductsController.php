<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use DB;
use App\Category;
use App\Product_variations;
use App\Product_photos;
use App\Shipping;
use App\Store;
use FileUploader;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Photo;


class AdminProductsController extends Controller
{
  public function index()
  {
   $products = Products::all();
   return view('admin.products.index', compact('products'));
 }


  public function edit($id)
  {
      $product = Products::findOrFail($id);
      $store = Store::where('id',$product->store->id)->firstOrFail();
      $parent_categories = Category::where('category_id',0)->pluck('name','id')->all();
      $all_categories  = Category::pluck('name','id')->all();
      $product_variations = Product_variations::where('product_id',$id)->get();
      $product_photos = Product_photos::where('product_id',$id)->orderBy('photo_order','asc')->get();
      $product_photos_amount = count($product_photos);
      $shippings = Shipping::where('store_id',$store->id)->leftjoin('photos', 'photos.id', '=', 'shippings.photo_id')->select('shippings.id as shippingsId','photos.*','shippings.*')->get();
      $product_shippings = DB::table('product_shippings')->where('product_id', $product->id)->get()->toArray();
      return view('admin.products.edit',compact('product','store','parent_categories','all_categories','product_variations','product_photos','product_photos_amount','shippings','product_shippings'));
  }

  public function update(Request $request, $id)
  {
      $input = $request->all();
      Products::findOrFail($input['product_id'])->update($input);
      $product_id = $input['product_id'];
      $store_username = Store::where('id',$input['store_id'])->first()->username;

      $public_path = public_path();
      $uploadDir = $public_path.'/images/';
      $product_photos = Product_photos::where('product_id',$input['product_id'])->orderBy('photo_order','asc')->get();

      foreach($product_photos as $product_photo) {
        // add file to our Preloaded File Array
        $preloadedFiles[] = array(
          "name" => $product_photo->name,
          "type" => 'image/*',
          "size" => filesize($uploadDir . $product_photo->name),
          "file" => url('images/') .'/'. $product_photo->name,
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
          'title' => '{timestamp}_{random}_{random}',
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
               $upload = new Product_photos();
               $upload->name = $name;
               $upload->resized_name = " ";
               $upload->original_name = $original_name;
               $upload->photo_order = $photo['listProps']['index'];
               $upload->product_id = $input['product_id'];
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
             $product_photos = Product_photos::where('name',$file_name)->delete( );
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
                $product_photos = Product_photos::where('name',$file_name)->update(['photo_order'=>$listInputs['values'][$i]['index']]);
            }
          }

        // Update Product variation
        $product_variation_ids = $request->input('variationid');
        $product_variation_names = $request->input('variationname');
        $product_variation_prices = $request->input('variationprice');
        $product_variation_weights = $request->input('variationweight');
        $product_variation_stocks = $request->input('variationstock');
        $product_variation_files = $request->file('file');
        if($request->input('product_type')=="variable"){
          for ($i = 0; $i < count($product_variation_stocks); $i++) {
            if(empty($product_variation_ids[$i])){
              $new_product_variation = Product_variations::create();
              $product_variation_id = $new_product_variation->id;
              array_push($product_variation_ids,"$new_product_variation->id");
            }
            else{
              $product_variation_id = $product_variation_ids[$i];
            }
            $product_variation_name = $product_variation_names[$i];
            $product_variation_price = $product_variation_prices[$i];
            $product_variation_weight = $product_variation_weights[$i];
            $product_variation_stock = $product_variation_stocks[$i];

            $product_variation = Product_variations::findOrFail($product_variation_id);
            $product_variation->name = $product_variation_name;
            $product_variation->price = $product_variation_price;
            $product_variation->weight = $product_variation_weight;
            $product_variation->stock = $product_variation_stock;
            $product_variation->product_id = $input['product_id'];

            if(!empty($product_variation_files[$i])){
              $product_variation_file = $product_variation_files[$i];
              $product_variation_photo_name = time(). $product_variation_file->getClientOriginalName();
              $product_variation_file->move('images', $product_variation_photo_name);
              $variation_photo = Photo::create(['file'=>$product_variation_photo_name]);
              $product_variation->photo_id = $variation_photo->id;
            }
            $product_variation->update();
         }
       }


         // Assign Shipping to product via switch
         $shipping_list = Input::get('shippings_switch');
         if(isset($shipping_list)){
           for ($i = 0; $i < count($shipping_list); $i++) {
             $shipping_row = DB::table('product_shippings')->where('product_id', '=', $product_id)->where('shipping_id', '=', $shipping_list[$i])->get();
             if($shipping_row->count()==0){
             DB::table('product_shippings')->insert(
                ['shipping_id' => $shipping_list[$i], 'product_id' => $product_id]
            );
            }
           }
         }
         else{
           $shipping_list = array();
         }

         // Remove unselected product shipping
         $product_shippings_dbs = DB::table('product_shippings')->where('product_id', $product_id)->get();
         foreach ($product_shippings_dbs as $product_shippings_db) {
           if(!(in_array($product_shippings_db->shipping_id,$shipping_list))){
             DB::table('product_shippings')->where('id', '=',$product_shippings_db->id)->delete();
           }
         }


         // Remove Product Variation
         $product_variations_dbs = Product_variations::where('product_id',$input['product_id'])->get();
         foreach ($product_variations_dbs as $product_variations_db) {
           if(!(in_array($product_variations_db->id,$product_variation_ids))){
             $product_variation = Product_variations::findOrFail($product_variations_db->id);
             $product_variation->delete();
           }
         }


       Session::flash('edit_successful','สินค้านี้ได้ถูกแก้ไขเป็นที่เรียบร้อยแล้ว');
       return redirect()->back();
  }


 public function setActive()
 {
   $product = Products::find($_GET['product_id']);
   $product->product_status_id = "2";
   $product->save();
   return json_encode("true");
 }

 public function setInactive()
 {
   $product = Products::find($_GET['product_id']);
   $product->product_status_id = "1";
   $product->save();
   return json_encode("true");
 }


 /* ProductCategory */

 public function showProductCategoryList(){
   $categories = Category::all();
   return view('admin.products.categories.index', compact('categories'));
 }

 public function editProductCategory(Request $request,$category_id){
   $category = Category::where('id',$category_id)->first();
   $all_parent_categories = Category::where('category_id','0')->get();
   return view('admin.products.categories.edit', compact('category','all_parent_categories'));
 }

  public function updateProductCategory(Request $request,$category_id){
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
      $category = Category::where('id',$category_id)->first();
      $category->name = $input['name'];
      $category->description = $input['description'];
      $category->category_id = $input['category_id'];

      if($request->file('profile_photo_id')!==NULL){
        $imageName = time().'_'.request()->file('profile_photo_id')->getClientOriginalName();
        request()->file('profile_photo_id')->move(public_path('images'), $imageName);
        $profile_photo = new Photo();
        $profile_photo->file = $imageName;
        $profile_photo->save();
        $category->profile_photo_id = $profile_photo->id;
      }

      if($request->file('cover_photo_id')!==NULL){
        $imageName = time().'_'.request()->file('cover_photo_id')->getClientOriginalName();
        request()->file('cover_photo_id')->move(public_path('images'), $imageName);
        $cover_photo = new Photo();
        $cover_photo->file = $imageName;
        $cover_photo->save();
        $category->cover_photo_id = $cover_photo->id;
      }

      if($request->file('icon_photo_id')!==NULL){
        $imageName = time().'_'.request()->file('icon_photo_id')->getClientOriginalName();
        request()->file('icon_photo_id')->move(public_path('images'), $imageName);
        $icon_photo = new Photo();
        $icon_photo->file = $imageName;
        $icon_photo->save();
        $category->icon_photo_id = $icon_photo->id;
      }

      $category->save();
      return redirect()->back()->with('success-message', 'ได้แก้ไขหมวดหมู่สินค้าเรียบร้อยแล้ว');
    }

   }

   public function createProductCategory(){
     $all_parent_categories = Category::where('category_id','0')->get();
     return view('admin.products.categories.create',compact('all_parent_categories'));
   }

   public function storeNewProductCategory(Request $request){
     $input = $request->all();
     $category = new Category();
     $category->name = $input['name'];
     $category->description = $input['description'];
     $category->category_id = $input['category_id'];
     $category->save();

     if($request->file('profile_photo_id')!==NULL){
       $imageName = time().'_'.request()->file('profile_photo_id')->getClientOriginalName();
       request()->file('profile_photo_id')->move(public_path('images'), $imageName);
       $profile_photo = new Photo();
       $profile_photo->file = $imageName;
       $profile_photo->save();
       $category->profile_photo_id = $profile_photo->id;
     }

     if($request->file('cover_photo_id')!==NULL){
       $imageName = time().'_'.request()->file('cover_photo_id')->getClientOriginalName();
       request()->file('cover_photo_id')->move(public_path('images'), $imageName);
       $cover_photo = new Photo();
       $cover_photo->file = $imageName;
       $cover_photo->save();
       $category->cover_photo_id = $cover_photo->id;
     }

     if($request->file('icon_photo_id')!==NULL){
       $imageName = time().'_'.request()->file('icon_photo_id')->getClientOriginalName();
       request()->file('icon_photo_id')->move(public_path('images'), $imageName);
       $icon_photo = new Photo();
       $icon_photo->file = $imageName;
       $icon_photo->save();
       $category->icon_photo_id = $icon_photo->id;
     }
     $category->save();
     return redirect('/admin/product-categories')->with('success-message', 'ได้สร้างหมวดหมู่สินค้าใหม่เรียบร้อยแล้ว');
   }

}
