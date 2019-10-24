<?php

namespace App\Http\Controllers\StoreManager;

use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Controllers\Controller;
use App\Store;
use App\Category;
use App\Product_photos;
use App\Products;
use App\Product_shippings;
use App\Photo;
use App\Product_variations;
use App\Shipping;
use App\Shipping_weightbase;
use Illuminate\Support\Facades\Input;
use FileUploader;
use DB;
use Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Crypt;
use File;


class ProductsController extends Controller
{
    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('/images');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store_username)
    {
      $store_id = Store::where('username',$store_username)->first()->id;
      $store = Store::where('id',$store_id)->firstOrFail();
      $products = Products::where('store_id',$store_id)
      ->leftjoin('product_photos', 'product_photos.product_id', '=', 'products.id')
      ->leftjoin('product_status','product_status.id','=','products.product_status_id')
      ->select('products.id as productsId','products.name as productsName', 'product_photos.name as productphotosName','products.id as productsId', 'product_photos.id as productphotosId','product_status.name as productstatusName','products.*','product_photos.*','product_status.*')
      ->where('photo_order',0)
      ->orwhere('photo_order',NULL)
      ->get();

      return view('storemanager.store.products',compact('store','products'));
    }



    public static function getVariationHighestPrice($product_id)
    {
     $highestprice = Product_variations::where('product_id',$product_id)->select('price')->orderBy('price', 'desc')->first();
     return $highestprice->price;
    }

    public static function getVariationLowestPrice($product_id)
    {
      $lowestprice = Product_variations::where('product_id',$product_id)->select('price')->orderBy('price', 'asc')->first();
      return $lowestprice->price;
    }

    public static function getVariationPhoto($photo_id)
    {
      $photo = Photo::where('id',$photo_id)->select('file')->first();
      if(!empty($photo->file)){
      return $photo->file;
      }
    }

    public static function getShippingWeightBaseList($shipping_id){
      $weightbaselist = Shipping_weightbase::where('shipping_id',$shipping_id)->get();
      return $weightbaselist;
    }

    public static function IsProductAssignShippingMethod($product_id){
      $has_shipping = DB::table('product_shippings')->where('product_id', '=', $product_id)->get();
      if(!$has_shipping->isEmpty()){
        return "TRUE";
      }else{
        return "FALSE";
      }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($store_username)
    {
        $categories = Category::where('category_id',0)->pluck('name','id')->all();
        $store_id = Store::where('username',$store_username)->first()->id;
        $store = Store::where('id',$store_id)->firstOrFail();
        $shippings = Shipping::where('store_id',$store_id)->leftjoin('photos', 'photos.id', '=', 'shippings.photo_id')->select('shippings.id as shippingsId','photos.*','shippings.*')->get();
        return view('storemanager.store.add-product',compact('store','categories','shippings'));
    }


    public function GetSubCategoriesAjax($name,$id)
    {
        $subcategories = Category::where('category_id',$id)->pluck('name','id')->all();
        return json_encode($subcategories);
    }

    public function GetSelectedSubCategoryAjax($name,$id,$product_id)
    {
        $subcategories = Category::where('category_id',$id)->pluck('name','id')->all();
        $selectedsubcategory = Products::where('id',$product_id)->pluck('category_id')->first();
        $variable = array($subcategories,$selectedsubcategory);
        return json_encode($variable);
    }

    public function GetParentCategoryAjax($name,$id)
    {
        $parent_id = Category::where('id',$id)->first()->category_id;
        $parentcategory = Category::where('id',$parent_id)->pluck('name','id')->all();
        return json_encode($parentcategory);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
      $input = $request->all();
      $product_variation_names = $request->input('variationname');
      $product_variation_prices = $request->input('variationprice');
      $product_variation_weights = $request->input('variationweight');
      $product_variation_stocks = $request->input('variationstock');
      $product_variation_files = $request->file('file');
      $image_order = $request->input('image_order');
      $input['store_id']=Crypt::decrypt($request->input('store_id'));
      $store = Store::find($input['store_id']);
      $product = new Products($input);
      $product->is_publish = 0;
      $product->save();

      $public_path = public_path();
      $uploadDir = $public_path.'/images/';
      // Set up FileUploader
      $FileUploader = new FileUploader('productfile', array(
        'limit' => null,
        'maxSize' => null,
        'fileMaxSize' => null,
        'extensions' => null,
        'required' => true,
        'uploadDir' => $uploadDir,
        'title' => 'product_{timestamp}_{random}',
        'replace' => false,
        'editor' => array(
          'maxWidth' => 800,
          'maxHeight' => 800,
          'quality' => 85
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
               $upload = new Product_photos();
               $upload->name = $name;
               $upload->resized_name = " ";
               $upload->original_name = $original_name;
               $upload->photo_order = $photo['listProps']['index'];
               $upload->product_id = $product->id;
               $upload->save();
            }
          }

       } else {
         $warnings = $upload['warnings'];
         var_dump($warnings);
       }

     if($request->input('product_type')=="variable"){

         for ($i = 0; $i < count($product_variation_stocks); $i++) {
            $product_variation_name = $product_variation_names[$i];
            $product_variation_price = $product_variation_prices[$i];
            $product_variation_weight = $product_variation_weights[$i];
            $product_variation_stock = $product_variation_stocks[$i];


            $product_variation = New Product_variations();
            $product_variation->name = $product_variation_name;
            $product_variation->price = $product_variation_price;
            $product_variation->weight = $product_variation_weight;
            $product_variation->stock = $product_variation_stock;
            $product_variation->product_id = $product->id;

            if(!empty($product_variation_files[$i])){
              $product_variation_file = $product_variation_files[$i];
              $product_variation_photo_name = time(). $product_variation_file->getClientOriginalName();
              $product_variation_file->move('images', $product_variation_photo_name);
              $variation_photo = Photo::create(['file'=>$product_variation_photo_name]);
              $product_variation->photo_id = $variation_photo->id;
            }
            $product_variation->save();
         }

      }

      // Assign Shipping to product via switch
      $shipping_list = Input::get('shippings_switch');
      if(isset($shipping_list)){
        for ($i = 0; $i < count($shipping_list); $i++) {
          $shipping_row = DB::table('product_shippings')->where('product_id', '=', $product->id)->where('shipping_id', '=', $shipping_list[$i])->get();
          if($shipping_row->count()==0){
          DB::table('product_shippings')->insert(
             ['shipping_id' => $shipping_list[$i], 'product_id' => $product->id]
         );
         }
        }
      }
      else{
        $shipping_list = array();
      }

      // Remove unselected product shipping
      $product_shippings_dbs = DB::table('product_shippings')->where('product_id', $product->id)->get();
      foreach ($product_shippings_dbs as $product_shippings_db) {
        if(!(in_array($product_shippings_db->shipping_id,$shipping_list))){
          DB::table('product_shippings')->where('id', '=',$product_shippings_db->id)->delete();
        }
      }

      return redirect('/storemanager/store/'.$store->username.'/products');
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
    public function edit($store_username ,$id)
    {
        $product = Products::findOrFail($id);
        $store_id = Store::where('username',$store_username)->first()->id;
        $store = Store::where('id',$store_id)->firstOrFail();
        $parent_categories = Category::where('category_id',0)->pluck('name','id')->all();
        $all_categories  = Category::pluck('name','id')->all();
        $product_variations = Product_variations::where('product_id',$id)->get();
        $product_photos = Product_photos::where('product_id',$id)->orderBy('photo_order','asc')->get();
        $product_photos_amount = count($product_photos);
        $shippings = Shipping::where('store_id',$store_id)->leftjoin('photos', 'photos.id', '=', 'shippings.photo_id')->select('shippings.id as shippingsId','photos.*','shippings.*')->get();
        $product_shippings = DB::table('product_shippings')->where('product_id', $product->id)->get()->toArray();
        return view('storemanager.store.edit-product',compact('product','store','parent_categories','all_categories','product_variations','product_photos','product_photos_amount','shippings','product_shippings'));
    }

    public function setProductShipping($store_username ,$id){
      $product = Products::findOrFail($id);
      $store_id = Store::where('username',$store_username)->first()->id;
      $store = Store::where('id',$store_id)->firstOrFail();
      $product_photos = Product_photos::where('product_id',$id)->orderBy('photo_order','asc')->get();
      $shippings = Shipping::where('store_id',$store_id)->leftjoin('photos', 'photos.id', '=', 'shippings.photo_id')->select('shippings.id as shippingsId','photos.*','shippings.*')->get();
      $product_shippings = DB::table('product_shippings')->where('product_id', $product->id)->get()->toArray();
      return view('storemanager.store.set-product-shipping',compact('product','store','product_photos','shippings','product_shippings'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, $id)
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
            'required' => true,
            'uploadDir' => $uploadDir,
            'title' => '{timestamp}_{random}_{random}',
        		'replace' => false,
        		'editor' => array(
        			'maxWidth' => 800,
        			'maxHeight' => 800,
        			'quality' => 85
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
                $product_variation_ids[$i] = $new_product_variation->id;
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


             $has_shipping = DB::table('product_shippings')->where('product_id', '=', $product_id)->get();
             if($has_shipping->isEmpty()){
               DB::table('products')->where('id', '=', $product_id)->update(['is_publish' => 0]);
             }



         Session::flash('edit_successful','สินค้านี้ได้ถูกแก้ไขเป็นที่เรียบร้อยแล้ว');
         return redirect('/storemanager/store/'.$store_username.'/products/'.$product_id.'/edit');
    } // End of Controller Update Method.


    public function updateProductShipping(Request $request,$store_username, $product_id)
    {

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

           $has_shipping = DB::table('product_shippings')->where('product_id', '=', $product_id)->get();
           if($has_shipping->isEmpty()){
             DB::table('products')->where('id', '=', $product_id)->update(['is_publish' => 0]);
           }



         Session::flash('edit_successful','สินค้านี้ได้ถูกแก้ไขการจัดส่งเป็นที่เรียบร้อยแล้ว');
         return redirect('/storemanager/store/'.$store_username.'/products/'.$product_id.'/set-shipping');
    } // End of Controller Update Method.



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

    public function deleteProduct($store_username,$product_id){

      $product = Products::find($product_id);
      foreach($product->product_photos as $photo)
      {
        $product_photo = Product_photos::where('name',$photo->name);
        $product_photo->delete();
        File::delete("images/".$photo->name);
      }
      $product->delete();
      return "success";

    }

    public function setProductPublish(Request $request,$store_username){
      $product_shippings = Product_shippings::where('product_id',$_GET['product_id'])->get();
      $product = Products::find($_GET['product_id']);
      if(count($product_shippings)>0){
        $product->is_publish = "1";
        $product->save();
        return json_encode(TRUE);
      }else{
        return json_encode(FALSE);
      }

    }

    public function setProductUnPublish(Request $request,$store_username){
      $product = Products::find($_GET['product_id']);
      $product->is_publish = "0";
      $product->save();
      return json_encode(TRUE);
    }

    public static function checkProductStock($product_id){
      $product = Products::where('id',$product_id)->first();

      if($product['product_type']=='variable'){
        //variation product
        $product_variations = Product_variations::where('product_id',$product_id)->get();
        $product_stock = 0;
        foreach($product_variations as $product_variation){
          $product_stock += $product_variation['stock'];
        }
        return $product_stock;
      }
      else{
        //single product
        $product = Products::where('id',$product_id)->first();
        $product_stock = $product['stock'];
        return $product_stock;
      }
    }

    public function updateSingleProductDiscountPrice($store_username,$product_id,$discount_price){
      $product = Products::where('id',$product_id)->first();
      $product->discount_price = $discount_price;
      $product->update();
      return $discount_price;
    }



}
