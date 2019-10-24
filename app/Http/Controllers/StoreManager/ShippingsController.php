<?php

namespace App\Http\Controllers\StoreManager;

use App\Store;
use App\Shipping;
use App\Photo;
use App\Shipping_weightbase;
use Illuminate\Http\Request;
use App\Http\Requests\AddShippingRequest;
use App\Http\Requests\EditShippingRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use DB;
use Session;

class ShippingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store_username)
    {
        $store_id = Store::where('username',$store_username)->first()->id;
        $store = Store::where('id',$store_id)->firstOrFail();
        $shippings = Shipping::where('store_id',$store->id)
        ->leftjoin('photos','photos.id','=','shippings.photo_id')
        ->select('shippings.id as shippingsId','shippings.name as shippingName','photos.file as photoName','shippings.*','photos.*')
        ->get();
        return view('storemanager.store.shippings',compact('store','shippings'));
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
    public function store(AddShippingRequest $request)
    {
        $input = $request->all();
        $input['store_id']=Crypt::decrypt($request->input('store_id'));
        $shipping = Shipping::create($input);
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
    public function edit($store_username,$id)
    {
      $shipping = Shipping::findOrFail($id);
      $store_id = Store::where('username',$store_username)->first()->id;
      $store = Store::where('id',$store_id)->firstOrFail();

      $allowlocations = $shipping->allowlocations;
      $notallowlocations = $shipping->notallowlocations;
      $allowlocations = explode(",", $allowlocations);
      $notallowlocations = explode(",", $notallowlocations);
      $allowlocation = [];
      $notallowlocation = [];
      if(!empty($allowlocations)){
        foreach ($allowlocations as $allowlocation_id) {

         $data = DB::table('thai_city')
                       ->where('id', '=', $allowlocation_id)
                       ->select('id','name')
                       ->first();
                       array_push($allowlocation,$data);

        }
      }
      if(!empty($notallowlocations)){
        foreach ($notallowlocations as $notallowlocation_id) {

         $data = DB::table('thai_city')
                       ->where('id', '=', $notallowlocation_id)
                       ->select('id','name')
                       ->first();
                       array_push($notallowlocation,$data);

        }
      }
      $allowlocation = json_encode($allowlocation);
      $notallowlocation = json_encode($notallowlocation);


      if($shipping->type=="weight"){
        $shipping_weightbases = Shipping_weightbase::where('shipping_id',$id)->get();
      }

      return view('storemanager.store.edit-shipping',compact('store','shipping','allowlocation','notallowlocation','shipping_weightbases'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditShippingRequest $request, $store_username, $shipping_id)
    {
      $input = $request->all();
      $shipping = Shipping::findOrFail($shipping_id);

        if($file = $request->file('photo_id')){
            $name = time(). $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;
        }

        if($request->input('shipping_type')=="weight"){
        // Update Product variation
        $shipping_weightbase_ids = $request->input('weightbaseid');
        if(empty($shipping_weightbase_ids)){
          $shipping_weightbase_ids = array();
        }
        $shipping_weightbase_minweights = $request->input('weightbaseminweight');
        $shipping_weightbase_maxweights = $request->input('weightbasemaxweight');

        /* check shipping weight overlap */
        if($this->checkIfWeightOverlapped($shipping_weightbase_minweights,$shipping_weightbase_maxweights)==true){
          Session::flash('overlap', 'น้ำหนักพัสดุที่คุณใส่มีน้ำหนักซ้อนทับกัน');
          return redirect()->back();
        }


        $shipping_weightbase_costs = $request->input('weightbasecost');
          for ($i = 0; $i < count($shipping_weightbase_costs); $i++) {
            if(empty($shipping_weightbase_ids[$i])){
              $new_shipping_weightbase = Shipping_weightbase::create();
              $shipping_weightbase_id = $new_shipping_weightbase->id;
              array_push($shipping_weightbase_ids,$shipping_weightbase_id);
            }
            else{
              $shipping_weightbase_id = $shipping_weightbase_ids[$i];
            }
            $shipping_weightbase_minweight = $shipping_weightbase_minweights[$i];
            $shipping_weightbase_maxweight = $shipping_weightbase_maxweights[$i];
            $shipping_weightbase_cost = $shipping_weightbase_costs[$i];

            $shipping_weightbase = Shipping_weightbase::findOrFail($shipping_weightbase_id);
            $shipping_weightbase->minweight = $shipping_weightbase_minweight;
            $shipping_weightbase->maxweight = $shipping_weightbase_maxweight;
            $shipping_weightbase->cost = $shipping_weightbase_cost;
            $shipping_weightbase->shipping_id = $shipping_id;

            $shipping_weightbase->update();
         }



         // Remove Product Variation
         $shipping_weightbase_dbs = Shipping_weightbase::where('shipping_id',$shipping_id)->get();
         foreach ($shipping_weightbase_dbs as $shipping_weightbase_db) {
           if(!(in_array($shipping_weightbase_db->id,$shipping_weightbase_ids))){
             $shipping_weightbase = Shipping_weightbase::findOrFail($shipping_weightbase_db->id);
             $shipping_weightbase->delete();
           }
         }
       }



        $shipping->update($input);
        return redirect('/storemanager/store/'.$store_username.'/shippings')->with('message', 'การจัดส่งได้ถูกบันทึกข้อมูลแล้ว');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($store_username,$shipping_id)
    {
      Shipping::findOrFail($shipping_id)->delete();
      $product_ids = DB::table('product_shippings')->where('shipping_id', $shipping_id)->pluck('product_id');
      DB::table('product_shippings')->where('shipping_id', $shipping_id)->delete();

      foreach($product_ids as $product_id){
        $has_shipping = DB::table('product_shippings')->where('product_id', '=', $product_id)->get();
        if($has_shipping->isEmpty()){
          DB::table('products')->where('id', '=', $product_id)->update(['is_publish' => 0]);
        }
      }

      return redirect()->back();
    }

    public function checkIfWeightOverlapped($shipping_weightbase_minweights, $shipping_weightbase_maxweights){
      $arr3 = array();
      foreach ($shipping_weightbase_minweights as $key => $val1) {
        $val2 = $shipping_weightbase_maxweights[$key];
        $arr3[$key] = $val1 . "," . $val2;
      }
        sort($arr3);
        $arr4 = array();
        for($i=0;$i<count($arr3);$i++){
          $arr4[$i] = explode(",",$arr3[$i]);
        }


        for($i=1;$i<count($arr4);$i++){
          if($arr4[$i-1][1]>$arr4[$i][0]){
            return true;
          }
        }
        return false;


    }




}
