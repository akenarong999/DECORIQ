<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Product_photos;
use App\Products;
use App\Product_questions;
use App\Http\Requests\AddProductQuestionRequest;
use App\Http\Requests\AddProductQuestionAnswerRequest;
use App\Category;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product_variations;
use App\Product_question_answers;
use Illuminate\Support\Facades\Crypt;
use App\Cart;
use Session;
use Carbon\Carbon;
use App\User;
use App\Order_reviews;
use App\Shipping_weightbase;
use App\Order_product_review_answers;
use App\Webelement_homepage_slider_photos;

class ProductFrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
      $product = Products::where('slug',$slug)->first();
      if($product){
      $parent_categories = Category::where('category_id',0)->pluck('name','id')->all();
      $product_variations = Product_variations::where('product_id',$product->id)->get();
      $product_photos = Product_photos::where('product_id',$product->id)->orderBy('photo_order','asc')->get();
      $first_product_photo = Product_photos::where('product_id',$product->id)->orderBy('photo_order','asc')->pluck("name")[0];

      $store = Store::where('stores.id',$product->store_id)->leftjoin('photos', 'photos.id', '=', 'stores.photo_id')->select('photos.file as photoFile','stores.*','photos.*')->first();
      $product_questions = Product_questions::where('product_id',$product->id)->leftjoin('users','users.id','=','product_questions.user_id')->leftjoin('photos','photos.id','=','users.photo_id')->select('product_questions.id as questionId','product_questions.created_at as questionPostdate','users.id as usersId','product_questions.*','photos.*','users.*')->get();
      $order_reviews = Order_reviews::where('product_id',$product->id)->get();
      return view('product',compact('product','store','parent_categories','product_variations','product_photos','store','product_questions','order_reviews','first_product_photo'));
      }else{
         return abort(404);
      }
    }

    public static function getVariationDetail($product_id){
      $product_variations = Product_variations::where('product_id',$product_id)->leftjoin('photos','photos.id','=','product_variations.photo_id')->select('product_variations.id as product_variationsId','photos.id as photosId','photos.*','product_variations.*')->get();
      return $product_variations;
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

    public static function getVariationHighestDiscountPrice($product_id)
    {
     $highestprice = Product_variations::where('product_id',$product_id)->select('discount_price')->orderBy('discount_price', 'desc')->first();
     return $highestprice->discount_price;
    }

    public static function getVariationLowestDiscountPrice($product_id)
    {
      $lowestprice = Product_variations::where('product_id',$product_id)->select('discount_price')->orderBy('discount_price', 'asc')->first();
      return $lowestprice->discount_price;
    }

    public static function getWeightbaseHighestCost($shipping_id)
    {
     $highestcost = Shipping_weightbase::where('shipping_id',$shipping_id)->select('cost')->orderBy('cost', 'desc')->first();
     return $highestcost->cost;
    }

    public static function getWeightbaseLowestCost($shipping_id)
    {
      $lowestcost = Shipping_weightbase::where('shipping_id',$shipping_id)->select('cost')->orderBy('cost', 'asc')->first();
      return $lowestcost->cost;
    }

    public static function getLocationbyid($thai_city_id){
      $location = DB::table('thai_city')->where('id', $thai_city_id)->first();
      return $location;
    }

    public function storeProductQuestion(AddProductQuestionRequest $request)
    {
      $input = $request->all();
      $input['product_id']=Crypt::decrypt($request->input('product_id'));;
      $input['user_id']=Crypt::decrypt($request->input('user_id'));
      $input['is_approve']=0;
      Product_questions::create($input);
      return redirect()->back();
    }

    public function storeProductQuestionAnswer(AddProductQuestionAnswerRequest $request)
    {
      $input = $request->all();
      $input['product_question_id']=Crypt::decrypt($request->input('product_question_id'));
      $input['store_id']=Crypt::decrypt($request->input('store_id'));
      $input['user_id']=Crypt::decrypt($request->input('user_id'));
      Product_question_answers::create($input);
      return redirect()->back();
    }

    public function storeOrderProductReviewAnswer(Request $request)
    {
      $input = $request->all();
      $input['order_review_id']=Crypt::decrypt($request->input('order_review_id'));
      $input['user_id']=Auth::user()->id;
      $input['message']=$request->input('message');
      Order_product_review_answers::create($input);
      return redirect()->back();
    }

    public static function getProductQuestionAnswers($product_question_id){
      $answers = Product_question_answers::where('product_question_id',$product_question_id)->leftjoin('users','users.id','=','product_question_answers.user_id')->leftjoin('photos','photos.id','=','users.photo_id')->select('product_question_answers.id as productquestionanswersId','product_question_answers.created_at as answerPostdate','product_question_answers.*','photos.*','users.*')->get();
      return $answers;
    }

    public static function getOrderProductReviewAnswers($order_review_id){
      $review_answer = Order_product_review_answers::where('order_review_id',$order_review_id)->get();
      return $review_answer;
    }

    public static function countProductQuestionAnswersByProductId($product_id){
      $answers = Product_question_answers::leftjoin('product_questions','product_questions.id','=','product_question_answers.product_question_id')->where('product_questions.product_id',$product_id)->get();
      return count($answers);
    }

    public static function checkIfUserOwnProductorOwnQuestion($user_id,$product_question_id){
      $product_question = Product_questions::find($product_question_id);
      $store_id = Products::find($product_question->product_id)->store_id;
      $userOwnProduct = DB::table('store_user')->where('store_id', $store_id)->where('user_id', $user_id)->first();
      if($user_id==$product_question->user_id || $userOwnProduct){
        return "TRUE";
      }
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



    public function AddToCart(Request $request){
      $product_detail = Products::find($request->product_id);
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $product_stock = ProductFrontendController::checkProductStock($request->product_id);
      if(is_int((int)$request->quantity) && (int)$request->quantity >= 1){

          if($product_stock>=$request->quantity){
              $products = Session::has('cart') ? Session::get('cart')->items : null;
              $j=0;
              if (is_array($products) || is_object($products)){

                foreach($products as $product){
                        if($product['id']==$request->product_id){
                          $new_amount_after_add = $cart->items[$request->product_id]['qty']+$request->quantity;
                          if($new_amount_after_add<=$product_stock){
                            $cart->add($product_detail, $request->product_id,$request->quantity, Carbon::now(),"0");
                            $request->session()->put('cart',$cart);
                            Session::flash('added-to-cart','คุณได้เพิ่มสินค้านี้ลงสู่ตะกร้าเรียบร้อยแล้ว');
                          }else{
                            $limit_amount = $product_stock-$cart->items[$request->product_id]['qty'];
                            Session::flash('not-enough-stock','คุณได้เพิ่มจำนวนสินค้านี้ในตะกร้าเกินกว่าจำนวนที่มีในสต็อก (จำนวนในตะกร้า: '.$cart->items[$request->product_id]['qty'].' ชิ้น คุณหยิบเพิ่มได้อีก ' .$limit_amount. ' ชิ้น)');
                          }
                          $j+=1;
                        }
                  }
                }
                if($j==0){
                  $cart->add($product_detail, $request->product_id,$request->quantity, Carbon::now(),"0");
                  $request->session()->put('cart',$cart);
                  Session::flash('added-to-cart','คุณได้เพิ่มสินค้านี้ลงสู่ตะกร้าเรียบร้อยแล้ว');
                }
          }
          else{
             Session::flash('not-enough-stock','สินค้าที่คุณหยิบใส่ตะกร้ามีจำนวนไม่พอที่คุณต้องการ');
          }
          return redirect()->back();
      }else{
        Session::flash('not-numeric','คุณใส่จำนวนสินค้าไม่ถูกต้อง, ต้องใส่เป็นจำนวนเลขเท่านั้น');
        return redirect()->back();
      }
    }



    public function AddVariationProductToCart(Request $request){
      $product_detail = Products::find($request->product_id);
      $product_variation = Product_variations::where('id',$request->product_variation_id)->get();
      $product_variation_price = $product_variation[0]["price"];
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);

      $product_stock = ProductFrontendController::checkProductStock($request->product_id);
      $product_with_variation_id = $request->product_id."-".$request->product_variation_id;
      if(is_int((int)$request->quantity) && (int)$request->quantity >= 1){
          if($product_variation[0]->stock>=$request->quantity){
              $products = Session::has('cart') ? Session::get('cart')->items : null;
              $j=0;
              if (is_array($products) || is_object($products)){
                  foreach($products as $product){
                          if($product['id']==$product_with_variation_id){
                            $new_amount_after_add = $cart->items[$product_with_variation_id]['qty']+$request->quantity;
                            if($new_amount_after_add<=$product_stock){
                              $cart->add($product_detail, $product_with_variation_id,$request->quantity, Carbon::now(),$product_variation_price);
                              $request->session()->put('cart',$cart);
                              Session::flash('added-to-cart','คุณได้เพิ่มสินค้านี้ลงสู่ตะกร้าเรียบร้อยแล้ว');
                            }else{
                              $limit_amount = $product_stock-$cart->items[$product_with_variation_id]['qty'];
                              Session::flash('not-enough-stock','คุณได้เพิ่มจำนวนสินค้านี้ในตะกร้าเกินกว่าจำนวนที่มีในสต็อก (จำนวนในตะกร้า: '.$cart->items[$product_with_variation_id]['qty'].' ชิ้น คุณหยิบเพิ่มได้อีก ' .$limit_amount. ' ชิ้น)');
                            }
                            $j+=1;
                          }
                    }
                }
                if($j==0){
                  $cart->add($product_detail, $product_with_variation_id,$request->quantity, Carbon::now(),$product_variation_price);
                  $request->session()->put('cart',$cart);
                  Session::flash('added-to-cart','คุณได้เพิ่มสินค้านี้ลงสู่ตะกร้าเรียบร้อยแล้ว');
                }
          }
          else{
             Session::flash('not-enough-stock','สินค้าที่คุณหยิบใส่ตะกร้ามีจำนวนไม่พอที่คุณต้องการ');
          }
          return redirect()->back();
        }else{
          Session::flash('not-numeric','คุณใส่จำนวนสินค้าไม่ถูกต้อง, ต้องใส่เป็นจำนวนเลขเท่านั้น');
          return redirect()->back();
        }
    }


    public function showProductMainPage(){
      $slide_photos = Webelement_homepage_slider_photos::all();
      $new_products = Products::orderBy('id','desc')->where('product_status_id','2')->where('is_publish','1')->limit(20)->get();
      return view('product-main-page',compact('slide_photos','new_products'));
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
