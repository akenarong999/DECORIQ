<?php

namespace App\Http\Controllers\StoreManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\Orders;
use App\Order_statuses;
use App\Order_tracks;
use App\Order_timelines;
use App\Products;
use App\Product_variations;
use App\Shipping_companies;
use Illuminate\Support\Facades\Input;
use PDF;
use Mail;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store_username,$order_status_id)
    {
      $store_id = Store::where('username',$store_username)->first()->id;
      $store = Store::where('id',$store_id)->firstOrFail();
      if($order_status_id!='all'){
        $orders = Orders::where('order_store_id',$store->id)->where('order_status_id', $order_status_id)->orderBy('id', 'desc')->get();
      }else{
        $orders = Orders::where('order_store_id',$store->id)->orderBy('id', 'desc')->get();
      }
      $all_orders = Orders::where('order_store_id',$store->id)->orderBy('id', 'desc')->get();

      $i = 0;
      foreach($all_orders as $all_order){
        $statuses[$i] = $all_order->order_status_id;
        $i++;
      }
      if(isset($statuses)){
        $statuses = array_count_values($statuses);
      }
      return view('storemanager.store.orders',compact('store','orders','statuses'));
    }

    public static function getOrderstatusnamebyid($status_id){
      $status_name = Order_statuses::find($status_id)->name;
      return $status_name;
    }

    public static function countOrderbystatus($status_id,$store_id){
      $orders = Orders::where('order_status_id',$status_id)->where('order_store_id', $store_id)->get();
      return count($orders);
    }

    public static function countAllordersbystoreid($store_id){
      $orders = Orders::where('order_store_id',$store_id)->orderBy('id', 'desc')->get();
      return count($orders);
    }


    public function showOrderDetail($store_username,$order_id)
    {
          $order = Orders::where('id',$order_id)->first();
          $store_id = Store::where('username',$store_username)->first()->id;
          $store = Store::where('id',$store_id)->firstOrFail();
          $shipping_companies = Shipping_companies::all();
          return view('storemanager.store.order_detail', compact('store','order','shipping_companies'));
    }

    public function getTrackurl($store_username){
        $shipping_company_id = $_GET['id'];
        $shipping_company = Shipping_companies::find($shipping_company_id);
        return json_encode($shipping_company->track_url);
    }

    public function setOrderTrackNo($store_username){
        $order_id = $_GET['order_id'];
        $shipping_name = $_GET['shipping_name'];
        $shipping_track_url = $_GET['shipping_track_url'];
        $tracking_no = $_GET['tracking_no'];
        $input['order_id']= $order_id;
        $input['shipping_name']= $shipping_name;
        $input['shipping_track_url']= $shipping_track_url;
        $input['tracking_no']= $tracking_no;
        if(Order_tracks::where('order_id',$order_id)->count() > 0){
          Order_tracks::where('order_id',$order_id)->update($input);
          $order_timeline['order_id']=$order_id;;
          $order_timeline['message']='เปลี่ยนแปลงข้อมูลการจัดส่งแล้ว';
          Order_timelines::create($order_timeline);
        }else{
          Order_tracks::create($input);
          $order_timeline['order_id']=$order_id;;
          $order_timeline['message']='ร้านค้าจัดส่งสินค้าแล้ว';
          Order_timelines::create($order_timeline);
        }


        $order = Orders::where('id',$order_id)->first();

        $data = [
          "order"=>$order,
          "store"=>$order->store,
          "customer_email"=>$order->order_email,
          "tracking_no"=> $input['tracking_no'],
          "shipping_name"=>$input['shipping_name'],
          "shipping_track_url"=>$input['shipping_track_url']
        ];

        //send mail to customer
        Mail::send('email.set-order-track-no-email-customer', $data,
        function ($message) use ($data) {
              $message->subject('แจ้งเลขพัสดุรายการสั่งซื้อ #'.$data['order']['id']);
              $message->to($data['customer_email']);
        });


        $order->update(['order_status_id' => 3]);
        return json_encode("success");
    }

    public static function getOrderTrackNo($order_id){
        $order_tracks = Order_tracks::where('order_id',$order_id)->first();
        return $order_tracks;
    }

    public static function getProductPhoto($product_id){
      if(strpos($product_id, '-') !== false){
        //variation product
        $product_id = explode('-', $product_id);
        $product_variation_id = $product_id[1];
        $product_variation = Product_variations::where('id',$product_variation_id)->first();
        if($product_variation->photo){
          return $product_variation->photo->file;
        }else{
          return "no_product_photo.png";
        }
      }
      else{
        //single product
        $product = Products::where('id',$product_id)->first();
        if($product){
          return $product->Product_photos[0]->name;
        }else{
          return "no_product_photo.png";
        }
      }
    }

    public function printPackinglist($store_username, $order_id){
      $order = Orders::find($order_id);
      $store_id = Store::where('username',$store_username)->first()->id;
      $store = Store::where('id',$store_id)->firstOrFail();
      $pdf = PDF::loadView('storemanager.store.pdf-packing-list',compact('order','store'));
      return $pdf->stream();
    }

    public function printPackingslip($store_username, $order_id){
      $order = Orders::find($order_id);
      $store_id = Store::where('username',$store_username)->first()->id;
      $store = Store::where('id',$store_id)->firstOrFail();
      $pdf = PDF::loadView('storemanager.store.pdf-packing-slip',compact('order','store'))->setPaper('a4', 'landscape');
      return $pdf->stream();

    }



    }
