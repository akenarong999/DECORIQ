<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Orders;
use App\Order_shippings;
use App\Order_products;
use App\Order_addresses;
use App\Order_timelines;
use App\Shipping;
use App\Products;
use App\Product_variations;
use Mail;
use Illuminate\Support\Str;


class CheckoutController extends Controller
{

  public function index()
  {

    if(Session::has('cart')){
      $selected_store_id = Session::get('selected_store_id');
      $products = array_values(Session::get('cart')->items);
      for($i=0;$i<count($products);$i++){
        if($products[$i]['store_id']==$selected_store_id){
          if(strpos($products[$i]['id'], '-') !== false){
            $product_id = explode('-', $products[$i]['id']);
            $variation_id = $product_id[1];
            $product_variation = Product_variations::find($variation_id);
            $product_stock = $product_variation['stock'];
            $product_name = CheckoutController::getProductNamebyId($products[$i]['id']);
            if($product_stock<$products[$i]['qty']){
              Session::flash('empty-cart','จำนวนสินค้าในสต็อกของ '.$product_name.' ไม่พอที่คุณต้องการ (ในสต็อกมีเพียง '.$product_stock.' ชิ้น)');
              return redirect()->back();
            }
          }
          else{
            $product_name = CheckoutController::getProductNamebyId($products[$i]['id']);
            $product_stock = CheckoutController::checkProductStock($products[$i]['id']);
            if($product_stock<$products[$i]['qty']){
              Session::flash('empty-cart','จำนวนสินค้าในสต็อกของ '.$product_name.' ไม่พอที่คุณต้องการ (ในสต็อกมีเพียง '.$product_stock.' ชิ้น)');
              return redirect()->back();
            }
          }
        }
      }
      return view('checkout');

    }
    else{
      Session::flash('empty-cart','ตะกร้าสินค้าของคุณว่าง กรุณาหยิบสินค้าใส่ตะกร้าก่อน');
      return redirect()->back();
    }
  }


  public static function getCartSubTotal($selected_store_id){
    if(Session::has('cart')){
      $products = array_values(Session::get('cart')->items);
      $subtotal = 0;
      for($i=0;$i<count($products);$i++){
        if($products[$i]['store_id']==$selected_store_id){
          $subtotal = $subtotal+$products[$i]['price'];
        }
      }
      return $subtotal;
    }else{
      return "0";
    }
  }

  public static function getProductNamebyId($product_id){
    if(strpos($product_id, '-') !== false){
      //variation product
      $product_id = explode('-', $product_id);
      $product = Products::find($product_id[0]);
      $product_variation = Product_variations::find($product_id[1]);
      $product_name = $product->name.' - '.$product_variation->name;
      return $product_name;
    }
    else{
      //single product
      $product = Products::find($product_id);
      return $product->name;
    }
  }

  public static function setBillingaddressSession(){
    session()->put(['billing_address'=>$_GET['billing_address']]);
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


  public static function reduceProductStock($product_id,$product_qty){

    if(strpos($product_id, '-') !== false){
      //variation product
      $product_id = explode('-', $product_id);
      $product_variation = Product_variations::find($product_id[1]);
      $new_product_variation_stock = $product_variation->stock-$product_qty;
      $product_variation->stock = $new_product_variation_stock;
      $product_variation->save();
    }else{
      //single product
      $product = Products::find($product_id);
      $new_product_stock =  $product->stock-$product_qty;
      $product->stock = $new_product_stock;
      $product->save();
    }


  }




 public static function placeOrder(Request $request){
    if(Session::has('cart')){

      if(Auth::Check()){
        $order_input['user_id']=Auth::user()->id;
      }else{
        $order_input['user_id']="-";
      }
      $total = CheckoutController::getCartSubTotal(Session::get('selected_store_id'));
      $shippings = session('cart_shipping');
      foreach($shippings as $shipping){
        $total += $shipping['cost'];
      }

        $order_input['order_email']=$_GET['order_email'];

        if($_GET['has_billing']==1){
          $billing_address = Order_addresses::create($_GET['billing_address']);
          $order_input['order_billing_address_id'] = $billing_address->id;
          $shipping_address = Order_addresses::create(Session::get('shipping_address'));
          $order_input['order_shipping_address_id'] = $shipping_address->id;
        }else{
          $shipping_address = Order_addresses::create(Session::get('shipping_address'));
          $order_input['order_billing_address_id'] = $shipping_address->id;
          $order_input['order_shipping_address_id'] = $shipping_address->id;
        }

        $order_input['order_status_id']="1";
        $order_input['order_store_id']=Session::get('selected_store_id');
        $order_input['order_discount']="0";
        $order_input['order_fee']="0";
        $order_input['order_total']=$total;
        $order_input['order_hash']=substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 6);
        $order_input['order_note']=$request->input('order_note');
        $order = Orders::create($order_input);

        $order_timeline['order_id']=$order->id;;
        $order_timeline['message']='ได้ถูกเพิ่มเข้ามาในระบบ';
        Order_timelines::create($order_timeline);

        $order_timeline['order_id']=$order->id;;
        $order_timeline['message']='สถานะรอการชำระเงิน';
        Order_timelines::create($order_timeline);

        foreach($shippings as $shipping){
          $order_shipping['order_id'] = $order->id;
          $order_shipping['name'] = $shipping['name'];
          $order_shipping['cost'] = $shipping['cost'];
          Order_shippings::create($order_shipping);
        }


        $products = array_values(Session::get('cart')->items);
        $cart_session = Session::get('cart');
        $order_products = [];
        for($i=0;$i<count($products);$i++)
        {
          if($products[$i]['store_id']==Session::get('selected_store_id'))
          {
              $order_product['name'] = CheckoutController::getProductNamebyId($products[$i]['id']);
              $order_product['price'] = $products[$i]['price'];
              $order_product['qty'] = $products[$i]['qty'];
              $order_product['product_id'] = $products[$i]['id'];
              $order_product['order_id'] = $order->id;
              Order_products::create($order_product);

              //Reduce each product stock
              CheckoutController::reduceProductStock($products[$i]['id'],$order_product['qty']);

               //remove cart
              	foreach (Session::get('cart')->items as $key => $value) {
                  if($value['id'] == $products[$i]['id']){
                    unset($cart_session->items[$products[$i]['id']]);
                    session()->put('cart', $cart_session);
              		}
              	}
          }
        }

        $data = [
          "order"=>$order,
          "store"=>$order->store,
          "customer_email"=>$order_input['order_email']
        ];


       //send mail to admin
       Mail::send('email.checkout-email-admin', $data,
       function ($message) use ($data) {
             $message->subject('รายการสั่งซื้อสินค้าใหม่ #'.$data['order']['id']);
             $message->to("decoriq@gmail.com");
       });

       //send mail to customer
       Mail::send('email.checkout-email-customer', $data,
       function ($message) use ($data) {
             $message->subject('รายการสั่งซื้อใหม่ของคุณ #'.$data['order']['id']);
             $message->to($data['customer_email']);
       });




        if(Session::get('cart')->items==[]){
            Session::forget('cart');
        }


      return json_encode($order);

    }
  }


}
