
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
  </head>
  <body class="pdf m-5">
    <?php foreach($orders as $order){
      echo $order->name;
    } ?>
  </body>
</html>
