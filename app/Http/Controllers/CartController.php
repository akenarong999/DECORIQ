<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
Use Redirect;
use Session;
use App\Cart;
use App\Store;
use App\Products;
use App\Photo;
use App\Product_photos;
use App\Product_variations;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      if(!Session::has('cart')){
        return view('cart',['products'=>null]);
      }

      $oldCart = Session::get('cart');
      $cart = New Cart($oldCart);
      return view('cart',['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice]);

    }

    public static function getFirstProductPhoto($product_id){
      $first_product_photo = Product_photos::where('product_id',$product_id)->where('photo_order','0')->first();
      return $first_product_photo->name;
    }

    public static function getVariationPhoto($variation_id){
      $variation = Product_variations::where('id',$variation_id)->first();
      if(!is_null($variation->photo_id)){
        $photo = Photo::where('id',$variation->photo_id)->first();
        return $photo->file;
      }else{
        $product = Products::where('id',$variation->product_id)->first();
        return $product->product_photos[0]->name;
      }
    }


    public static function getStorebyid($store_id){
      $store = Store::where('stores.id',$store_id)->leftjoin('photos','photos.id','=','stores.photo_id')->select('stores.id as storeId','photos.id as photoId','photos.*','stores.*')->first();
      return $store;
    }

    public static function getCartTotal(){
      if(Session::has('cart')){
        $products = array_values(Session::get('cart')->items);
        $total = 0;
        for($i=0;$i<count($products);$i++){
          $total = $total+$products[$i]['qty'];
        }
        return $total;
      }else{
        return "0";
      }
    }

    public function RemoveFromCart(Request $request,$id){
      if(Session::has('cart')){
        $cart = Session::get('cart');
      	foreach (Session::get('cart')->items as $key => $value) {
          if($value['id'] == $id){
            unset($cart->items[$id]);
            session()->put('cart', $cart);
      		}
      	}
      }

      return redirect()->back();
    }

    public static function getProductShippingMethod($product_id){
      $product_shippings = DB::table('product_shippings')->leftjoin('shippings', 'shippings.id', '=', 'product_shippings.shipping_id')->where('product_id', $product_id)->get()->toArray();
      return $product_shippings;
    }

    public function shippingcostcalculate(){
       $product_shipping_datas = $_GET['product_shipping_data'];

       $shipping_ids = array();
       foreach($product_shipping_datas as $product_shipping_data){
         array_push($shipping_ids,$product_shipping_data['shipping_id']);
       }

       $shipping_array = array();
       foreach($shipping_ids as $shipping_id){
         $products_weight = 0;
         foreach($product_shipping_datas as $product_shipping_data){
           if($product_shipping_data['shipping_id']==$shipping_id){
             $shipping_detail = CartController::getShippingDetail($shipping_id);
             $shipping_name = $shipping_detail[0]->name;
             $shipping_type = $shipping_detail[0]->type;
             if($shipping_type=="free"){
               if(empty($shipping_array[$shipping_id])){
                 $shipping_array[$shipping_id]['id']= $shipping_id;
                 $shipping_array[$shipping_id]['name']= $shipping_detail[0]->name;
                 $shipping_array[$shipping_id]['cost'] = 0;
                 $shipping_array[$shipping_id]['store_id'] = $shipping_detail[0]->store_id;
               }
             }
             elseif($shipping_type=="flat"){
               if(empty($shipping_array[$shipping_id])){
               $shipping_array[$shipping_id]['id']= $shipping_id;
               $shipping_array[$shipping_id]['name'] = $shipping_detail[0]->name;
               $shipping_array[$shipping_id]['cost'] = $shipping_detail[0]->cost;
               $shipping_array[$shipping_id]['store_id'] = $shipping_detail[0]->store_id;

               }
             }
             elseif($shipping_type=="weight"){

              if(strpos($product_shipping_data['product_id'], '-') !== false) {
                //variable product
                $product_ids = explode('-', $product_shipping_data['product_id']);
                $product_id = $product_ids[0];
                $variation_id = $product_ids[1];
                $product = CartController::getProductVariationDetail($product_id,$variation_id);
                $products_weight+=$product[0]->weight*$product_shipping_data['product_amount'];

              }else{
                $product = CartController::getProductDetail($product_shipping_data['product_id']);
                $products_weight+=$product[0]->weight*$product_shipping_data['product_amount'];
              }

              $shippingbyweight = CartController::getShippingWeightCost($shipping_id,$products_weight);

              if( !isset($shippingbyweight[0]) ){
                $shipping_array[$shipping_id]['id']= $shipping_id;
                $shipping_array[$shipping_id]['name'] = $shipping_detail[0]->name;
                $shipping_array[$shipping_id]['cost'] = "ไม่สามารถจัดส่งได้ (น้ำหนักเกิน)";
                $shipping_array[$shipping_id]['store_id'] = $shipping_detail[0]->store_id;
              }
              else{
                $shipping_array[$shipping_id]['id']= $shipping_id;
                $shipping_array[$shipping_id]['name'] = $shipping_detail[0]->name;
                $shipping_array[$shipping_id]['cost'] = $shippingbyweight[0]->cost;
                $shipping_array[$shipping_id]['store_id'] = $shipping_detail[0]->store_id;
              }

             }
           }
         }
       }
       session()->put(['cart_shipping'=>$shipping_array]);

      return $shipping_array;

    }

    public function getProductVariationPrice(){
      $variation_id = $_GET['product_variation_id'];
      $product_variation_price = DB::table('product_variations')->where('id',$variation_id)->get();
      return $product_variation_price;
    }

    public function getEachProductVariationStock(){
      $variation_id = $_GET['product_variation_id'];
      $product_variation = Product_variations::find($variation_id);
      $product_variation_stock = $product_variation['stock'];
      return $product_variation_stock;
    }

    public static function getProductDetail($product_id){
      $product_detail = Products::where('id',$product_id)->get();
      return $product_detail;
    }

    public static function getProductVariationDetail($product_id,$variation_id){
       $product_variation_detail = DB::table('product_variations')->where('product_id',$product_id)->where('id',$variation_id)->get();
       return $product_variation_detail;
    }


    public function getShippingDetail($shipping_id){
      $shipping_detail = DB::table('shippings')->where('id', $shipping_id)->get();
      return $shipping_detail;
    }

    public function getShippingWeightCost($shipping_id,$products_weight){
      $shippingbyweight = DB::table('shippings')->join('shipping_weightbases', 'shippings.id', '=', 'shipping_weightbases.shipping_id')->where('shippings.id', $shipping_id)->where('minweight', '<', $products_weight)->where('maxweight', '>=', $products_weight)->get();
      return $shippingbyweight;
    }

    public function getsubdistrictdistrictprovince($postal_code){
      $thai_city = DB::table('thai_city')->where('postal_code', $postal_code)->pluck('name','id')->all();
      return $thai_city;
    }

    public function setguestaddresssession(Request $request){
      $thai_city = DB::table('thai_city')->where('id', $request->thai_city_id)->pluck('name')->first();
      $address['firstname'] = $request->firstname;
      $address['lastname'] = $request->lastname;
      $address['address1'] = $request->address1;
      $address['address2'] = $request->address2;
      $address['postal_code'] = $request->postal_code;
      $address['thai_city_id'] = $request->thai_city_id;
      $address['thai_city'] = $thai_city;
      $address['tel_number'] = $request->tel_number;
      session()->put(['shipping_address'=>$address]);
      return redirect()->back();
    }

    public static function getloggedincustomeraddresses($user_id){
      $addresses = DB::table('shipping_addresses')->where('user_id', $user_id)->get();
      return $addresses;
    }


    public function addnewloggedincustomeraddresses(Request $request){
      $input = $request->all();
      $firstname = $request->input('firstname');
      $lastname = $request->input('lastname');
      $address1 = $request->input('address1');
      $address2 = $request->input('address2');
      $thai_city_id = $request->input('thai_city_id');
      $postal_code = $request->input('postal_code');
      $tel_number = $request->input('tel_number');
      $thai_city = DB::table('thai_city')->where('id', $thai_city_id)->pluck('name')->first();
      DB::table('shipping_addresses')->insert(
      [
        'user_id' => Auth::id(),
        'firstname' => $firstname,
        'lastname' => $lastname,
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

    public function deleteloggedincustomeraddresssession($address_id){
      DB::table('shipping_addresses')->where('id', '=', $address_id)->delete();
      return $address_id;
    }


    public function setloggedincustomeraddresssession(){
      session()->put(['shipping_address.firstname'=>$_GET['selected_address']['firstname'],'shipping_address.lastname'=>$_GET['selected_address']['lastname'],'shipping_address.address1'=>$_GET['selected_address']['address1'],'shipping_address.address2'=>$_GET['selected_address']['address2'],'shipping_address.postal_code'=>$_GET['selected_address']['postal_code'],'shipping_address.thai_city_id'=>$_GET['selected_address']['thai_city_id'],'shipping_address.thai_city'=>$_GET['selected_address']['thai_city'],'shipping_address.tel_number'=>$_GET['selected_address']['tel_number']]);

      $product_shipping = array();

      if(isset($_GET['product_id_array'])){

      for($i=0;$i<count($_GET['product_id_array']);$i++){

        if(strpos($_GET['product_id_array'][$i], '-') !== false) {
          $product_id = explode('-', $_GET['product_id_array'][$i]);
          $product_id = $product_id[0];
        }else{
          $product_id = $_GET['product_id_array'][$i];
        }

        $product = CartController::getProductDetail($product_id);
        $shippings = CartController::getProductShippingMethod($product_id);

        if(strpos($_GET['product_id_array'][$i], '-') !== false) {
          $product_id = $_GET['product_id_array'][$i];
        }

           foreach($shippings as $shipping){
               $allow_locations =  explode(',',$shipping->allowlocations);
               $notallow_locations =  explode(',',$shipping->notallowlocations);

                if($shipping->allowlocations==NULL && $shipping->notallowlocations==NULL){

                  $product_shipping[$product_id][$shipping->id]["name"] = $shipping->name;
                  $product_shipping[$product_id][$shipping->id]["allow"] = "1";
                  $product_shipping[$product_id][$shipping->id]["store_id"] = $product[0]->store_id;

                }elseif($shipping->allowlocations!=NULL && $shipping->notallowlocations==NULL){
                  /* มีเมืองที่อนุญาติ */
                    foreach($allow_locations as $allowlocation){
                      if($allowlocation==Session::get('thai_city_id')){

                        $product_shipping[$product_id][$shipping->id]["name"] = $shipping->name;
                        $product_shipping[$product_id][$shipping->id]["allow"] = "1";
                        $product_shipping[$product_id][$shipping->id]["store_id"] = $product[0]->store_id;

                      }
                    }

                 }
                 elseif($shipping->allowlocations==NULL && $shipping->notallowlocations!=NULL){
                   /* มีเมืองที่ไม่อนุญาติ */
                     foreach($notallow_locations as $notallowlocation){
                       if($notallowlocation==Session::get('thai_city_id')){

                         $product_shipping[$product_id][$shipping->id]["name"] = $shipping->name;
                         $product_shipping[$product_id][$shipping->id]["allow"] = "0";
                         $product_shipping[$product_id][$shipping->id]["store_id"] = $product[0]->store_id;

                       }
                     }
                  }
                  else{
                    /* มีทั้งเมืองที่อนุญาติและไม่อนุญาติ */
                    foreach($allow_locations as $allowlocation){
                      foreach($notallow_locations as $notallowlocation){
                        if($allowlocation==Session::get('thai_city_id')&&$notallowlocation!=Session::get('thai_city_id')){

                          $product_shipping[$product_id][$shipping->id]["name"] = $shipping->name;
                          $product_shipping[$product_id][$shipping->id]["allow"] = "1";
                          $product_shipping[$product_id][$shipping->id]["store_id"] = $product[0]->store_id;
                          break 2;
                        }
                        else{

                          $product_shipping[$product_id][$shipping->id]["name"] = $shipping->name;
                          $product_shipping[$product_id][$shipping->id]["allow"] = "0";
                          $product_shipping[$product_id][$shipping->id]["store_id"] = $product[0]->store_id;
                        }
                      }
                    }
                  }
             }

           }
         }
          return $product_shipping;
    }

    public function checkloggedinuseraddressavailable($user_id){
      $addresses = DB::table('shipping_addresses')->where('user_id', $user_id)->pluck('firstname')->first();
      return $addresses;
    }


    public function changeStoreSubtotal(Request $request){
       $store_id = $_GET['store_id'];
       $cart_products = $request->session()->get('cart')->items;
       if(!isset($store_subtotal)){
         $store_subtotal=0;
        }
       foreach($cart_products as $cart_product){

           if($cart_product["item"]["store_id"]==$store_id){
             return $cart_product;
             if($cart_product["item"]["product_type"]=="single"){
               $product_subtotal = intval($cart_product["item"]["price"])*intval($cart_product["qty"]);
               $store_subtotal+=$product_subtotal;
             }
             else{
               $product_subtotal = intval($cart_product["price"])*intval($cart_product["qty"]);
               $store_subtotal+=$product_subtotal;
             }
           }
       }
         if(isset($store_subtotal)){
           return $store_subtotal;
         }
    }




    public function getStoreIdbyProductId(){

    }


    public function editcustomeraddresses(Request $request){
      $id=Crypt::decrypt($request->input('id'));
      $firstname = $request->input('firstname');
      $lastname = $request->input('lastname');
      $address1 = $request->input('address1');
      $address2 = $request->input('address2');
      $thai_city_id = $request->input('thai_city_idEdit');
      $postal_code = $request->input('postal_code');
      $thai_city = DB::table('thai_city')->where('id', $thai_city_id)->pluck('name')->first();
      $tel_number = $request->input('tel_number');
      DB::table('shipping_addresses')->where('id', $id)->update(
      [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'address1' => $address1 ,
        'address2' => $address2 ,
        'thai_city_id' => $thai_city_id,
        'thai_city' => $thai_city,
        'postal_code' =>  $postal_code,
        'tel_number' =>  $tel_number
      ]
      );

      return Redirect::back();
    }


        public function tocheckout(Request $request){
          $new_cart_json = $_GET['new_cart_json'];
          for($i=0;$i<count($new_cart_json);$i++){
            $request->session()->get('cart')->items[$new_cart_json[$i]["id"]]["qty"]=$new_cart_json[$i]["qty"];
            $request->session()->save();

            if($new_cart_json[$i]["type"]=="single"){
              $discount_price = DB::table("products")->where('id', $new_cart_json[$i]["id"])->pluck('discount_price')->first();
              if(is_null($discount_price)||$discount_price<=0){
                $price = DB::table("products")->where('id', $new_cart_json[$i]["id"])->pluck('price')->first();
              }else{
                $price = $discount_price;
              }
              $request->session()->get('cart')->items[$new_cart_json[$i]["id"]]["price"]=(int)$new_cart_json[$i]["qty"]*(int)$price;
              $request->session()->save();
            }
            else{
              $product = explode("-", $new_cart_json[$i]["id"]);
              $discount_price = DB::table("product_variations")->where('id', $product[1])->pluck('discount_price')->first();
              if(is_null($discount_price)||$discount_price<=0){
                $price = DB::table("product_variations")->where('id', $product[1])->pluck('price')->first();
              }else{
                $price = $discount_price;
              }
              $request->session()->get('cart')->items[$new_cart_json[$i]["id"]]["price"]=(int)$new_cart_json[$i]["qty"]*(int)$price;
              $request->session()->save();


            }
          }
          $request->session()->put(['selected_store_id'=>$_GET['store_id']]);
          return "1";
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
