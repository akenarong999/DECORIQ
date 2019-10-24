<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Orders;
use App\Photo;
use App\Order_statuses;
use App\Order_addresses;
use App\Order_products;
use App\Order_shippings;
use App\Order_timelines;
use App\Payment_methods;
use App\Product_variations;
use DB;
use App\Order_proof_of_payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Mail;
use App\Order_tracks;


class AdminOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $orders = Orders::orderBy('id', 'desc')->get();
         $count_all_orders = count($orders);
         $statuses = NULL;
         $i = 0;

         foreach($orders as $all_order){
           $statuses[$i] = $all_order->order_status_id;
           $i++;
         }
         if($statuses!=NULL){
         $statuses = array_count_values($statuses);
         }
         return view('admin.orders.index', compact('orders','statuses','count_all_orders'));
    }

    public function orderbyStatusid($order_status_id){
      if($order_status_id!='all'){
        $orders = Orders::where('order_status_id', $order_status_id)->orderBy('id', 'desc')->get();
      }else{
        $orders = Orders::orderBy('id', 'desc')->get();
      }
      $all_orders = Orders::orderBy('id', 'desc')->get();
      $count_all_orders = count($all_orders);
      $statuses = NULL;
      $i = 0;
      foreach($all_orders as $all_order){
        $statuses[$i] = $all_order->order_status_id;
        $i++;
      }
      if($statuses!=NULL){
      $statuses = array_count_values($statuses);
      }
      return view('admin.orders.index', compact('orders','statuses','count_all_orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUsersRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $order = Orders::where('id',$id)->first();
      $payment_methods = Payment_methods::All();
      return view('admin.orders.detail', compact('order','payment_methods'));
    }

    public function addNewProofofPayment(Request $request,$order_id){

      $validatedData = $request->validate([
        'payment_method_id' => 'required',
        'amount' => 'required|numeric',
        'payment_datetime' => 'required',
        'key'=>'',
     ]);
     $order_proof_of_payment = new Order_proof_of_payments();
     $order_proof_of_payment->payment_method_id = $validatedData['payment_method_id'];
     $order_proof_of_payment->order_id = $order_id;
     $order_proof_of_payment->user_id = Auth::id();
     $order_proof_of_payment->key = $validatedData['key'];
     $order_proof_of_payment->amount = $validatedData['amount'];
     $order_proof_of_payment->payment_datetime = $validatedData['payment_datetime'];
     if ($request->hasFile('proof_of_payment_photo')) {
       $rand_filename = $order_id.'_'.$validatedData['payment_method_id'].'_'.rand(1000, 9999).'.'.$request->file('proof_of_payment_photo')->extension();
       $file = $request->file('proof_of_payment_photo')->storeAs('',$rand_filename, 'public_image_upload');
       $photo = new Photo();
       $photo->file = $file;
       $photo->save();
      }
     $order_proof_of_payment->photo_id = $photo->id;
     $saved = $order_proof_of_payment->save();

     $order = Orders::where('id',$order_id)->first();

     $data = [
       "order"=>$order,
       "store"=>$order->store,
       "customer_email"=>$order->order_email
     ];

     if(!$saved){
       return redirect()->back()->with('error', 'มีปัญหาในการเพิ่มการชำระเงิน กรุณาลองใหม่อีกครั้ง');
     }else{
       $order = Orders::find($order_id);
       if($order->order_status_id==1)
       {
         $order->order_status_id=2;
         $order->save();
       }

       //send mail to customer
       Mail::send('email.payment-confirm-email-customer', $data,
       function ($message) use ($data) {
             $message->subject('ยืนยันการชำระเงินรายการสั่งซื้อ #'.$data['order']['id']);
             $message->to($data['customer_email']);
       });

       return redirect()->back();
     }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $order = Orders::where('id',$id)->first();
      return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUsersEditRequest $request, $id)
    {




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function deleteOrder($id){
       $order = Orders::where('id',$id)->firstOrFail();
       Order_addresses::where('id',$order->order_shipping_address_id)->delete();
       Order_addresses::where('id',$order->order_billing_address_id)->delete();
       Order_products::where('order_id',$order->id)->delete();
       Order_shippings::where('order_id',$order->id)->delete();
       Order_timelines::where('order_id',$order->id)->delete();
       $order->delete();
       return redirect('/admin/orders')->with('delete_success', 'รายการสั่งซื้อถูกลบเรียบร้อยแล้ว');

    }

    public static function countOrderbystatus($status_id){
      $orders = Orders::where('order_status_id',$status_id)->get();
      return count($orders);
    }

    public static function getOrderstatusnamebyid($status_id){
      $status_name = Order_statuses::find($status_id)->name;
      return $status_name;
    }

    public static function getVariationPhoto($order_product_id){
      $order_product_id = explode("-", $order_product_id);
      $product_variation = Product_variations::where('id',$order_product_id[1])->where('product_id',$order_product_id[0])->firstOrFail();
      if($product_variation->photo){
        return $product_variation->photo->file;
      }else{
        return "no_product_photo.png";
      }
    }

    public static function getOrderTrackNo($order_id){
        $order_tracks = Order_tracks::where('order_id',$order_id)->first();
        return $order_tracks;
    }


}
