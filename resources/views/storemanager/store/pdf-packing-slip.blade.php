
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
  </head>
  <body class="pdf">
    <div class="m-4 pt-3 pb-3 pl-5 pr-5" style="border:1px gray dashed;">
       <p style="font-size:25px; text-decoration:underline;" class="pdf">ผู้ส่ง</p><br>
       <img src="<?php echo public_path('images/'.$store->photo->file); ?>" width="100">&nbsp;<img src="<?php echo public_path('images/x_decoriq_logo.png'); ?>" width="140">
     <div class="pdf" style="font-size: 20px;"> <?php echo 'ร้าน '.$store->name.'    โทร '.$store->main_address->tel_number; ?><br>
      <?php echo $store->main_address->address1.' '.$store->main_address->address2; ?><br>
      <?php echo $store->main_address->thai_city; ?></div>
      <div class="pdf" style="margin-left: 160px; font-size:32px;"><strong><?php echo $store->main_address->postal_code; ?></strong></div>


      <div style="margin-left:450px;">
        <p style="font-size:30px; text-decoration:underline;" class="pdf">ผู้รับ</p>
      <div class="pdf" style="font-size: 26px;"> <?php echo 'คุณ '.$order->shipping_address->firstname.' '.$order->shipping_address->lastname.'    โทร '.$order->shipping_address->tel_number; ?><br>
       <?php echo $order->shipping_address->address1.' '.$order->shipping_address->address2; ?><br>
       <?php echo $order->shipping_address->thai_city; ?></div><br>
       <div class="pdf" style="margin-left: 170px; font-size:42px;"><strong><?php echo $order->shipping_address->postal_code; ?></strong></div>
      </div>
    </div>

  </body>
</html>
