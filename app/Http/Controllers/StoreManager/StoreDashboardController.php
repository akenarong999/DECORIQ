<?php

namespace App\Http\Controllers\StoreManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\Photo;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Orders;
use DB;


class StoreDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store_username)
    {

        $store = Store::where('username',$store_username)->firstOrFail();
        $photo = Photo::where('id',$store->photo_id)->firstOrFail();
        $latest_orders = Orders::where('order_store_id',$store->id)->orderBy('id','desc')->limit(6)->get();

        $currentMonth = date('m');
        $orders = Orders::where('order_store_id',$store->id)->whereRaw('MONTH(created_at) = ?',[$currentMonth]) ->get();

        $days['Mon'] = 0;
        $days['Tue'] = 0;
        $days['Wed'] = 0;
        $days['Thu'] = 0;
        $days['Fri'] = 0;
        $days['Sat'] = 0;
        $days['Sun'] = 0;


        foreach($orders as $order){
          if($order->created_at->format('D') === 'Mon'){
            $days['Mon'] += 1;
          }elseif($order->created_at->format('D') === 'Tue'){
            $days['Tue'] += 1;
          }elseif($order->created_at->format('D') === 'Wed'){
            $days['Wed'] += 1;
          }elseif($order->created_at->format('D') === 'Thu'){
            $days['Thu'] += 1;
          }elseif($order->created_at->format('D') === 'Fri'){
            $days['Fri'] += 1;
          }elseif($order->created_at->format('D') === 'Sat'){
            $days['Sat'] += 1;
          }elseif($order->created_at->format('D') === 'Sun'){
            $days['Sun'] += 1;
          }
        }

        return view('storemanager.store.dashboard',compact('store','photo','latest_orders','days'));
    }

    public static function countFollower($store_id){
      $store_follower =  DB::table('store_follow')->where('store_id',$store_id)->get();
      return count($store_follower);
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
