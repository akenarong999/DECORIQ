<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Home Section */
Route::get('/', 'HomeController@index');

/* Become Seller Section */
Route::get('/partner/become', 'PartnerController@index');
Route::post('/partner/apply', 'PartnerController@storeRegisterApplication');

/* Product Frontend Section */
Route::get('/product/{slug}', 'ProductFrontendController@index');
Route::post('/product/storeproductquestion',['uses'=> 'ProductFrontendController@storeProductQuestion', 'as' => 'storeproductquestion']);
Route::post('/product/storeproductquestionanswer',['uses'=> 'ProductFrontendController@storeProductQuestionAnswer', 'as' => 'storeproductquestionanswer']);
Route::post('/product/storeorderproductreviewanswer',['uses'=> 'ProductFrontendController@storeOrderProductReviewAnswer', 'as' => 'storeorderproductreviewanswer']);

Route::get('/products', 'ProductFrontendController@showProductMainPage');
Route::get('/services', 'ServiceFrontendController@showServiceMainPage');


/* Service Frontend Section */

Route::get('/service/{slug}', 'ServiceFrontendController@index');

/* Admin Route Section */

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::prefix('login')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.provider.callback');
});





Route::group(['middleware'=>'admin'], function(){
  Route::get('/admin', function(){
    return view('admin.index');
  });
  Route::resource('admin/users','Admin\AdminUsersController');
  Route::resource('admin/roles','Admin\AdminRolesController');
  Route::resource('admin/categories','Admin\AdminCategoriesController');
  Route::resource('admin/products','Admin\AdminProductsController');

  Route::get('admin/product-categories','Admin\AdminProductsController@showProductCategoryList');
  Route::get('admin/product-categories/create','Admin\AdminProductsController@createProductCategory');
  Route::post('admin/product-categories/storenewproductcategory','Admin\AdminProductsController@storeNewProductCategory');
  Route::get('admin/product-categories/{category_id}/edit','Admin\AdminProductsController@editProductCategory');
  Route::patch('admin/product-categories/{category_id}/updateproductcategory','Admin\AdminProductsController@updateProductCategory');

  Route::get('admin/service-categories','Admin\AdminServicesController@showServiceCategoryList');
  Route::get('admin/service-categories/create','Admin\AdminServicesController@createServiceCategory');
  Route::post('admin/service-categories/storenewservicecategory','Admin\AdminServicesController@storeNewServiceCategory');
  Route::get('admin/service-categories/{category_id}/edit','Admin\AdminServicesController@editServiceCategory');
  Route::patch('admin/service-categories/{category_id}/updateservicecategory','Admin\AdminServicesController@updateServiceCategory');



  Route::resource('admin/services','Admin\AdminServicesController');
  Route::resource('admin/orders','Admin\AdminOrdersController');
  Route::get('admin/orders/{order_id}/delete','Admin\AdminOrdersController@deleteOrder');
  Route::resource('admin/stores','Admin\AdminStoresController');
  Route::get('admin/orders/status/{order_status_id}','Admin\AdminOrdersController@orderbyStatusid');
  Route::post('admin/orders/{order_id}/addnewproofofpayment','Admin\AdminOrdersController@addNewProofofPayment');

  Route::get('admin/product/edit/{product_id}','Admin\AdminProductsController@edit');
  Route::patch('admin/product/update/{product_id}','Admin\AdminProductsController@update');

  Route::get('admin/service/edit/{service_id}','Admin\AdminServicesController@edit');
  Route::patch('admin/service/update/{service_id}','Admin\AdminServicesController@update');

  Route::get('admin/product/setactive','Admin\AdminProductsController@setActive');
  Route::get('admin/product/setinactive','Admin\AdminProductsController@setInactive');

  Route::get('admin/service/setactive','Admin\AdminServicesController@setActive');
  Route::get('admin/service/setinactive','Admin\AdminServicesController@setInactive');

  Route::get('admin/store/setapprove','Admin\AdminStoresController@setApprove');
  Route::get('admin/store/setnotapprove','Admin\AdminStoresController@setNotApprove');

  Route::get('admin/webelement','Admin\AdminWebElementController@index');
  Route::get('admin/webelement/homepage/editor','Admin\AdminWebElementController@HomepageEditor');
  Route::patch('admin/webelement/homepage/edithomepageslideshow','Admin\AdminWebElementController@EditHomepageSlideshow');
  Route::patch('admin/webelement/homepage/edithomepagefeaturedproductcategories','Admin\AdminWebElementController@EditHomepageFeaturedProductCategories');
  Route::patch('admin/webelement/homepage/edithomepagefeaturedproducts','Admin\AdminWebElementController@EditHomepageFeaturedProducts');
  Route::patch('admin/webelement/homepage/edithomepagefeaturedservices','Admin\AdminWebElementController@EditHomepageFeaturedServices');

  Route::get('admin/pages','Admin\AdminPagesController@index');
  Route::get('admin/pages/edit/{page_id}','Admin\AdminPagesController@edit');
  Route::patch('admin/pages/update/{page_id}','Admin\AdminPagesController@update');




});


/* Store Manager Route Section */

Route::group(['middleware'=>'storemanager'], function(){
  Route::resource('/storemanager','StoreManager\StoresListController');
});

Route::group(['middleware'=>'storemanagercheckownstore'], function(){
  Route::resource('/storemanager/store/{store_username}/dashboard','StoreManager\StoreDashboardController');
  Route::get('/storemanager/store/{store_username}/orders/{order_status_id}','StoreManager\OrdersController@index');
  Route::get('/storemanager/store/{store_username}/order/{order_id}','StoreManager\OrdersController@showOrderDetail');
  Route::get('/storemanager/store/{store_username}/order/{order_id}/print-packing-list','StoreManager\OrdersController@printPackinglist');
  Route::get('/storemanager/store/{store_username}/order/{order_id}/print-packing-slip','StoreManager\OrdersController@printPackingslip');
  Route::resource('/storemanager/store/{store_username}/shippings','StoreManager\ShippingsController');
  Route::get('/storemanager/store/{store_username}/settings','StoreManager\SettingsController@index');
  Route::get('/storemanager/store/{store_username}/settings/editstoreprofile','StoreManager\SettingsController@editStoreProfile');
  Route::get('/storemanager/store/{store_username}/settings/address','StoreManager\SettingsController@settingaddress');
  Route::get('/storemanager/store/{store_username}/settings/add-store-address','StoreManager\SettingsController@addStoreaddress');
  Route::get('/storemanager/store/{store_username}/settings/save-store-address','StoreManager\SettingsController@saveStoreaddress');
  Route::get('/storemanager/store/{store_username}/gettrackurl','StoreManager\OrdersController@getTrackurl');
  Route::get('/storemanager/store/{store_username}/setordertrackno','StoreManager\OrdersController@setOrderTrackNo');
  Route::get('/storemanager/store/{store_username}/settings/storephoto','StoreManager\SettingsController@StorePhoto');
  Route::post('/storemanager/store/{store_username}/settings/storephoto/update','StoreManager\SettingsController@updateStorePhoto');

  Route::resource('/storemanager/store/{store_username}/services','StoreManager\ServicesController');

  Route::get('/storemanager/store/{store_username}/services/{service_id}/delete','StoreManager\ServicesController@deleteService');

  //StoreManager: Service Message Section
  Route::get('/storemanager/store/{store_username}/service/messages/','StoreManager\ServiceMessageController@index');
  Route::get('/storemanager/store/{store_username}/service/messages/{service_conversations_id}','StoreManager\ServiceMessageController@show');
  Route::get('/storemanager/store/{store_username}/service/messages/{service_conversations_id}/sendmessage', 'StoreManager\ServiceMessageController@sendMessage');
  Route::get('/storemanager/store/{store_username}/service/messages/{service_conversations_id}/getnewchatmessage','StoreManager\ServiceMessageController@getNewChatMessage');


  //StoreManager: Service Order Section
  Route::post('/storemanager/store/{store_username}/service/{service_id}/createservicequote','StoreManager\ServiceOrdersController@CreateServiceQuote');
  Route::get('/storemanager/store/{store_username}/service-orders/{order_status_id}','StoreManager\ServiceOrdersController@index');
  Route::get('/storemanager/store/{store_username}/service-order/{service_order_id}','StoreManager\ServiceOrdersController@showOrderDetail');
  Route::get('/storemanager/store/{store_username}/service-order/{service_order_id}/cancelservicequote','StoreManager\ServiceOrdersController@cancelServiceQuote');
  Route::post('/storemanager/store/{store_username}/service-order/{service_order_id}/updateserviceorderprogress','StoreManager\ServiceOrdersController@updateServiceOrderProgress');

  Route::get('/storemanager/store/{store_username}/service-order/{service_order_id}/acceptcustomereditrequest','StoreManager\ServiceOrdersController@acceptCustomerEditRequest');
  Route::get('/storemanager/store/{store_username}/service-order/{service_order_id}/rejectcustomereditrequest','StoreManager\ServiceOrdersController@rejectCustomerEditRequest');
  Route::post('/storemanager/store/{store_username}/service-order/{service_order_id}/responseserviceorderprogressforedit','StoreManager\ServiceOrdersController@responseServiceOrderProgressforEdit');


  Route::post('/store/{store_username}/addnewpost','Store\StorePageController@addNewPost');
  Route::get('/store/{store_username}/addnewpostcomment','Store\StorePageController@addNewPostComment');


Route::group(['middleware'=>'web'], function(){
  Route::resource('/storemanager/store/{store_username}/products','StoreManager\ProductsController');
  Route::get('/storemanager/store/{store_username}/products/{product_id}/set-shipping','StoreManager\ProductsController@setProductShipping');
  Route::patch('/storemanager/store/{store_username}/products/{product_id}/update-shipping','StoreManager\ProductsController@updateProductShipping');
  Route::get('/storemanager/store/{store_username}/products/{product_id}/delete','StoreManager\ProductsController@deleteProduct');
  Route::get('/storemanager/store/{store_username}/products/{product_id}/setpublish','StoreManager\ProductsController@setProductPublish');
  Route::get('/storemanager/store/{store_username}/products/{product_id}/setunpublish','StoreManager\ProductsController@setProductUnPublish');
  Route::get('/storemanager/store/{store_username}/products/updatesingleproductdiscountprice/{product_id}/{discount_price}','StoreManager\ProductsController@updateSingleProductDiscountPrice');

  Route::get('/storemanager/store/{store_username}/services/{service_id}/setpublish','StoreManager\ServicesController@setServicePublish');
  Route::get('/storemanager/store/{store_username}/services/{service_id}/setunpublish','StoreManager\ServicesController@setServiceUnPublish');
  });

  Route::resource('/storemanager/store/{store_username}/articles','StoreManager\ArticlesController');

});

Route::get('/storemanager/store/{name}/products/getsubcategoriesajax/{id}',array('as'=>'create.ajax','uses'=>'StoreManager\ProductsController@GetSubCategoriesAjax'));
Route::get('/storemanager/store/{name}/products/getparentcategoryajax/{id}',array('as'=>'create.ajax','uses'=>'StoreManager\ProductsController@GetParentCategoryAjax'));
Route::get('/storemanager/store/{name}/products/getselectedsubcategoryajax/{id}/{product_id}',array('as'=>'create.ajax','uses'=>'StoreManager\ProductsController@GetSelectedSubCategoryAjax'));
Route::get('/storemanager/store/{store_username}/services/getsubcategoriesajax/{id}',array('as'=>'create.ajax','uses'=>'StoreManager\ServicesController@GetSubCategoriesAjax'));
Route::get('/storemanager/store/{store_username}/services/getparentcategoryajax/{id}',array('as'=>'create.ajax','uses'=>'StoreManager\ServicesController@GetParentCategoryAjax'));
Route::get('/storemanager/store/{store_username}/services/getselectedsubcategoryajax/{id}/{service_id}',array('as'=>'create.ajax','uses'=>'StoreManager\ServicesController@GetSelectedSubCategoryAjax'));

Route::group(['prefix'=>'api','middleware' => 'auth'], function(){
    Route::get('find', function(Illuminate\Http\Request $request){
        $keyword = $request->input('keyword');
        Log::info($keyword);
        $provinces = DB::table('thai_city')
                  ->where('name','like','%'.$keyword.'%')
                  ->select('thai_city.id','thai_city.name')
                  ->get();
        return json_encode($provinces);
    })->name('api.allowlocations');
});



/* Cart Section */

Route::post('/add-to-cart',[
  'uses' =>'ProductFrontendController@AddToCart',
  'as' => 'product.addToCart'
]);

Route::post('/add-variation-to-cart',[
  'uses' =>'ProductFrontendController@AddVariationProductToCart',
  'as' => 'product.AddVariationProductToCart'
]);

Route::get('/remove-from-cart/{id}',[
  'uses' =>'CartController@removeFromCart',
  'as' => 'cart.removeFromCart'
]);

Route::get('/cart',[
  'uses' =>'CartController@index',
  'as' => 'product.Cart'
]);

Route::get('/cart/getthaicity/{postal_code}','CartController@getsubdistrictdistrictprovince');

Route::get('/set-guest-address-session','CartController@setguestaddresssession');

Route::get('/add-new-address','CartController@addnewloggedincustomeraddresses');
Route::get('/edit-address','CartController@editcustomeraddresses');
Route::get('/cart/deleteaddress/{address_id}','CartController@deleteloggedincustomeraddresssession');
Route::get('/cart/set-logged-in-customer-address-session/','CartController@setloggedincustomeraddresssession');
Route::get('/cart/check-logged-in-user-address-available/{user_id}','CartController@checkloggedinuseraddressavailable');
Route::get('/cart/shippingcostcalculate/','CartController@shippingcostcalculate');
Route::get('/cart/getproductvariationprice/','CartController@getProductVariationPrice');
Route::get('/cart/geteachproductvariationstock/','CartController@getEachProductVariationStock');
Route::get('/cart/changeproductamount/','CartController@changeProductAmount');
Route::get('/cart/changestoresubtotal/','CartController@changeStoreSubtotal');
Route::get('/cart/to-checkout/','CartController@tocheckout');

/* end Cart Section */

/* Checkout Section */

Route::get('/checkout','CheckoutController@index');
Route::get('/checkout/to-payment/','CheckoutController@placeOrder');
Route::get('/checkout/setbillingaddresssession/','CheckoutController@setBillingaddressSession');
Route::get('/checkout/removebillingaddresssession/','CheckoutController@removeBillingaddressSession');


/* end Checkout Section */

/* Guest order Section */

Route::get('/guest-order/{order_id}/{order_hash}/','Guest\GuestOrderController@index');
Route::post('/guest-order/{order_id}/{order_hash}/detail/','Guest\GuestOrderController@showOrderDetail');
Route::get('/guest-order/{order_id}/{order_hash}/review/','Guest\GuestOrderController@OrderReview');



/* End Guest order detail Section */


/* Payment Section */

Route::get('/order-payment/{order_id}/{order_hash}/','PaymentController@index');
Route::post('/order-payment/{order_id}/{order_hash}/payment-inform/', 'PaymentController@orderPaymentInform');


/* end Payment Section */




/* User dashboard Section */
Route::get('/dashboard/','User\DashboardController@index');
Route::get('/dashboard/updatestatusmessage','User\DashboardController@updateStatusMessage');
Route::get('/dashboard/address/','User\DashboardController@address');
Route::get('/dashboard/orders/product/status/{order_status_id}','User\DashboardController@ProductOrders');
Route::get('/dashboard/orders/service/status/{service_order_status_id}','User\DashboardController@ServiceOrders');
Route::get('/dashboard/order/{order_id}','User\DashboardController@showOrderDetail');
Route::get('/dashboard/service-order/{order_id}','User\DashboardController@showServiceOrderDetail');
Route::get('/dashboard/order/cancel/{order_id}/{order_hash}/','User\DashboardController@cancelOrder');
Route::get('/dashboard/order/setorderreceived/{order_id}//','User\DashboardController@setOrderreceived');
Route::get('/dashboard/review/','User\DashboardController@reviews');
Route::get('/dashboard/review/order/{order_id}','User\DashboardController@showOrderReview');
Route::post('/dashboard/review/order/{order_id}/add','User\DashboardController@addOrderReview');

Route::get('/dashboard/service-review/','User\DashboardController@ServiceReviews');
Route::get('/dashboard/service-review/order/{order_id}','User\DashboardController@showServiceOrderReview');
Route::post('/dashboard/service-review/order/{order_id}/add','User\DashboardController@addServiceOrderReview');

Route::get('/dashboard/settings/profile/','User\DashboardController@SettingsProfile');
Route::get('/dashboard/settings/profile/update','User\DashboardController@updateProfile');
Route::get('/dashboard/settings/profilephoto/','User\DashboardController@SettingsProfilePhoto');
Route::post('/dashboard/settings/profilephoto/update',['uses'=> 'User\DashboardController@updateProfilePhoto', 'as' => 'dashboard.settings.profilephoto.update']);
Route::get('/dashboard/settings/privacy/','User\DashboardController@SettingsProfilePrivacy');
Route::post('/dashboard/settings/privacy/changepassword',['uses'=> 'User\DashboardController@changePassword', 'as' => 'dashboard.settings.privacy.changepassword']);


/* Public User page Section */
Route::get('/user/{user_name}','User\UserPageController@index');
Route::get('/user/{user_name}/dofollow','User\UserPageController@doFollow');
Route::get('/user/{user_name}/dounfollow','User\UserPageController@doUnFollow');
Route::post('/user/{user_name}/addnewpost','User\UserPageController@addNewPost');
Route::get('/user/{user_name}/addnewpostcomment','User\UserPageController@addNewPostComment');

Route::get('/user/{user_name}/sendmessage','User\UserPageController@sendMessage');



/* Public Store page Section */
Route::get('/store/{store_username}','Store\StorePageController@index');
Route::get('/store/{store_username}/articles/{article_id}','Store\StorePageController@article');
Route::get('/store/{store_username}/dofollow','Store\StorePageController@doFollow');
Route::get('/store/{store_username}/dounfollow','Store\StorePageController@doUnFollow');

Route::get('/store/{store_username}/sendmessage','Store\StorePageController@sendMessage');



/* Service Order (User) */
Route::get('/order/service/{service_order_id}/declineservicequote','User\ServiceOrdersController@declineServiceQuote');
Route::get('/order/service/accept-payment/{service_order_id}/{service_order_hash}','User\ServiceOrdersController@acceptServiceQuoteGotoPayment');
Route::get('/order/service/make-service-order-payment/{service_order_id}/{service_order_hash}','User\ServiceOrdersController@makeServiceOrderPayment');
Route::post('/order/service/{service_order_id}/requestserviceorderprogressforedit','User\ServiceOrdersController@requestServiceOrderProgressforEdit');
Route::get('/order/service/{service_order_id}/acceptserviceorderfinalresult','User\ServiceOrdersController@acceptServiceOrderFinalResult');



/* Service Message */
Route::get('/service/messages/{service_conversations_id}','User\ServiceMessageController@show');
Route::get('/service/messages/{service_conversations_id}/sendmessage','User\ServiceMessageController@sendMessage');
Route::get('/service/messages/{service_conversations_id}/getnewchatmessage','User\ServiceMessageController@getNewChatMessage');



/* Categories Page  */
Route::get('/category/product/{product_category_name}','ProductCategoryFrontendController@index');

Route::get('/category/service/{service_category_name}','ServiceCategoryFrontendController@index');



Route::get('/page/{page_slug}','PageFrontendController@showPage');




Route::get('/messenger/','MessengerController@index');
Route::get('/messenger/getchatmessage','MessengerController@getChatMessage');
Route::post('/messenger/sendmessage','MessengerController@sendMessage');

Route::get('/messenger/getnewchatmessage','MessengerController@getNewChatMessage');


/* PDF Creator Section */

Route::get('pdf','PDFController@pdf');

/* End PDF Creator Section */
