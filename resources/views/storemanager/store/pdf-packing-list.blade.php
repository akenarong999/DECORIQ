
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" media="all"  type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" media="all" type="text/css" href="{{ asset('css/custom.css') }}">
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
  </head>
  <body class="pdf m-5 p-5">
    <?php use \App\Http\Controllers\StoreManager\OrdersController; ?>
    <div class="mb-2" style="position:relative">

        <img src="<?php echo public_path('images/'.$store->photo->file); ?>" width="100">&nbsp;<img src="<?php echo public_path('images/x_decoriq_logo.png'); ?>" width="140">
        <div class="float-right">
          <div class="pdf" style="font-size: 22px;  line-height: 120%"> <?php echo 'ร้าน '.$store->name; ?><br>
           <?php echo $store->main_address->address1; ?><br>
           <?php if(isset($store->main_address->address2)){ echo $store->main_address->address2.'<br>'; } ?>
           <?php echo $store->main_address->thai_city.' '.$store->main_address->postal_code;  ?><br>
           <?php echo 'โทร '.$store->main_address->tel_number; ?>
         </div>
        </div>
    </div>
    <h1>
     <strong> ใบรายการสั่งซื้อ</strong>
    </h1>


    <div style="margin-top:30px;">
       <div style="width:33%; display: inline-block; line-height:94%">
         <h4 style="text-decoration:underline;">ผู้สั่งซื้อ</h4>
         <?php echo $order->billing_address->firstname.' '.$order->billing_address->lastname; ?><br>
         <?php echo $order->billing_address->address1; ?>
         <?php if(!empty($order->billing_address->address2)) {echo '<br>'.$order->billing_address->address2; } ?><br>
         <?php echo $order->billing_address->thai_city; ?> <br>
         <?php echo $order->billing_address->postal_code; ?>

       </div>
        <div style="width:33%; display: inline-block; line-height:94%">
         <h4 style="text-decoration:underline;">จัดส่งไปยัง</h4>
         <?php echo $order->shipping_address->firstname.' '.$order->shipping_address->lastname; ?><br>
         <?php echo $order->shipping_address->address1; ?>
         <?php if(!empty($order->shipping_address->address2)) {echo '<br>'.$order->shipping_address->address2; } ?><br>
         <?php echo $order->shipping_address->thai_city; ?> <br>
         <?php echo $order->shipping_address->postal_code; ?>
       </div>
        <div style="width:33%; display: inline-block;  line-height:94%">
         <h4 style="text-decoration:underline; ">รายละเอียดการสั่งซื้อ</h4>
           <span>- เลขที่การสั่งซื้อ: <?php echo $order->id; ?></span><br>
           <span>- วันที่สั่งซื้อ: <?php echo $order->created_at; ?></span><br>
           <span>- วิธีการชำระเงิน: <?php echo $order->id; ?></span><br>
           <span>- วันที่ชำระเงิน: <?php echo $order->id; ?></span><br>
       </div>
    </div>

    <br>

    <div class="table">
      <?php $products = $order->products; ?>
      <div class="table-row" style="background-color:light-gray;">
        <div class="table-cell"></div>
        <div class="table-cell">รายการสินค้า</div>
        <div class="table-cell">จำนวน</div>
        <div class="table-cell">ราคา</div>
      </div>
      <div class="table-row">
        <?php foreach ($products as $product): ?>
          <div class="table-cell text-center"><img src="<?php echo public_path('/images/'.OrdersController::getProductPhoto($product->product_id));  ?>" width="48"></div>
          <div class="table-cell"><?php echo $product->name; ?>  <span class="text-muted">(<?php echo $product->product_id; ?>)</span></div>
          <div class="table-cell">x<?php echo $product->qty; ?></div>
          <div class="table-cell"><?php echo $product->price; ?> ฿</div>
        <?php endforeach; ?>

      </div>
      <div class="table-row">
        <div class="table-cell border-0"></div>
        <div class="table-cell border-0"></div>
        <div class="table-cell">ค่าจัดส่ง</div>
        <div class="table-cell">0 ฿</div>
      </div>
      <div class="table-row">
        <div class="table-cell border-0"></div>
        <div class="table-cell border-0"></div>
        <div class="table-cell">ส่วนลด</div>
        <div class="table-cell">0 ฿</div>
      </div>
      <div class="table-row">
        <div class="table-cell border-0"></div>
        <div class="table-cell border-0"></div>
        <div class="table-cell" style="border-bottom:double 3px black;">ยอดรวม</div>
        <div class="table-cell" style="border-bottom:double 3px black;">0 ฿</div>
      </div>
    </div>








  </body>
</html>
