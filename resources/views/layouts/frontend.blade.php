<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="@yield('description')" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="/images/decoriq_favicon.png">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themify.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fade-down.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ekko-lightbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/webslidemenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/white-gry.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

</head>
<body style="overflow-y: scroll; -webkit-overflow-scrolling: touch;">
  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        xfbml            : true,
        version          : 'v3.3'
      });
    };

    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <!-- Your customer chat code -->
  <div class="fb-customerchat"
    attribution=setup_tool
    page_id="705484372889640"
    theme_color="#0084ff"
    logged_in_greeting="สวัสดีครับ, ถ้าหากมีอะไรให้เราช่วยเหลือ สามารถพิมพ์บอกเราได้เลย :)"
    logged_out_greeting="สวัสดีครับ, ถ้าหากมีอะไรให้เราช่วยเหลือ สามารถพิมพ์บอกเราได้เลย :)">
  </div>

  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&autoLogAppEvents=1&version=v3.2&appId=2141789109461147"></script>
  <?php use \App\Http\Controllers\CartController; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container">
  <a class="navbar-brand border-right pr-4" href="{{ url('/') }}"><img width="128" src="/images/decoriq_logo.png"></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="md-input form-inline my-2 my-lg-0 w-100 border-right pr-3">

      <form class="search-form w-100">
         <input class="md-form-control" type="text" name="q" >
       </form>
         <span class="highlight"></span>
         <span class="bar"></span>
         <label>ค้นหา</label>
    </div>
    <ul class="navbar-nav w-50">
      <li class="nav-item active">
        <a class="nav-link" href="/">หน้าหลัก</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="#">วิธีการสั่งซื้อ</a>
      </li>
      <li class="nav-item">
        <a href="/partner/become/" class="btn btn-outline-dark">ลงขายสินค้า/บริการ</a>
      </li>
    </ul>
  </div>
</div>

</nav>

    <div id="app">
       <!-- Mobile Header -->
                <div class="wsmobileheader clearfix">
                  <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>

                  <span class="smllogo"><a href="{{ url('/') }}"><img width="128"  src="/images/decoriq_logo.png"></span>
                  <div class="wssearch clearfix">
                    <i class="fa fa-search"></i>
                    <i class="fa fa-times"></i>
                    <div class="wssearchform clearfix">
                      <form>
                        <input type="text" placeholder="Search Here">
                      </form>
                    </div>
                  </div>
                </div>
       <!-- Mobile Header -->
        <div class="wsmain clearfix border-bottom">
          <div class="container">

            <nav class="wsmenu clearfix">
              <ul class="wsmenu-list">

                <li><a href="#" class="navtext"><span><i class="themify ti ti-menu-alt font-weight-bold mt-1"></i> หมวดหมู่</span></a>
                  <div class="wsshoptabing wtsdepartmentmenu clearfix">
                    <div class="wsshopwp clearfix">
                      <ul class="wstabitem clearfix">

                        <li class="wsshoplink-active"><a href="#"><i class="themify ti ti-home"></i> ของแต่งบ้าน</a>
                          <div class="wstitemright clearfix wstitemrightactive">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/ตุ๊กตา-โมเดล" class="text-black">ตุ๊กตา/โมเดล</a></li>
                                    <li><a href="/category/product/ตุ๊กตา-โมเดลรูปสัตว์">ตุ๊กตา/โมเดลรูปสัตว์</a> </li>
                                    <li><a href="/category/product/ตุ๊กตา-โมเดลรูปคน">ตุ๊กตา/โมเดลรูปคน</a> </li>
                                    <li><a href="/category/product/ตุ๊กตา-โมเดลสถานที่สำคัญ">ตุ๊กตา/โมเดลสถานที่สำคัญ</a> </li>
                                    <li><a href="/category/product/ตุ๊กตา-โมเดลรูปสิ่งของ">ตุ๊กตา/โมเดลรูปสิ่งของ</a> </li>
                                    <li><a href="/category/product/ตุ๊กตา-โมเดลอื่นๆ">ตุ๊กตา/โมเดลอื่นๆ</a> </li>
                                    <li><a href="/category/product/ตุ๊กตา-โมเดล">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>

                                <div class="col-lg-2 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/ผ้าปูโต๊ะ" class="text-black">ผ้าปูโต๊ะ</a></li>
                                    <li><a href="/category/product/ผ้าปูโต๊ะผ้า">ผ้าปูโต๊ะผ้า</a></li>
                                    <li><a href="/category/product/ผ้าปูโต๊ะยาง">ผ้าปูโต๊ะยาง</a></li>
                                    <li><a href="/category/product/ผ้าคาดโต๊ะ">ผ้าคาดโต๊ะ</a></li>
                                    <li><a href="/category/product/ชุดผ้าปูโต๊ะ">ชุดผ้าปูโต๊ะ</a></li>
                                    <li><a href="/category/product/เบาะรองเก้าอี้">เบาะรองเก้าอี้</a></li>
                                    <li><a href="/category/product/ผ้าปูโต๊ะอื่นๆ">ผ้าปูโต๊ะอื่นๆ</a></li>
                                    <li><a href="/category/product/ผ้าปูโต๊ะ">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>

                                <div class="col-lg-2 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/แจกัน" class="text-black">แจกัน</a></li>
                                    <li><a href="/category/product/แจกันทรงสูง">แจกันทรงสูง</a> </li>
                                    <li><a href="/category/product/แจกันทรงเตี้ย">แจกันทรงเตี้ย</a> </li>
                                    <li><a href="/category/product/แจกันทรงยาว">แจกันทรงยาว</a></li>
                                    <li><a href="/category/product/แจกันทรงขวดโหล">แจกันทรงขวดโหล</a> </li>
                                    <li><a href="/category/product/แจกันอื่นๆ">แจกันอื่นๆ</a> </li>
                                    <li><a href="/category/product/แจกัน">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>
                                <div class="col-lg-2 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/กระถาง" class="text-black">กระถาง</a></li>
                                    <li><a href="/category/product/กระถางทรงปกติ">กระถางทรงปกติ</a> </li>
                                    <li><a href="/category/product/กระถางทรงสูง">กระถางทรงสูง</a> </li>
                                    <li><a href="/category/product/กระถางทรงเตี้ย">กระถางทรงเตี้ย</a> </li>
                                    <li><a href="/category/product/กระถางติดผนัง">กระถางติดผนัง</a> </li>
                                    <li><a href="/category/product/กระถางอื่นๆ">กระถางอื่นๆ</a></li>
                                    <li><a href="/category/product/กระถาง">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>
                                <div class="col-lg-2 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/กรอบรูป-ตั้งโต๊ะ" class="text-black">กรอบรูป (ตั้งโต๊ะ)</a></li>
                                    <li><a href="/category/product/กรอบไม้">กรอบไม้</a></li>
                                    <li><a href="/category/product/กรอบหลุยส์">กรอบหลุยส์</a></li>
                                    <li><a href="/category/product/กรอบกระดาษ">กรอบกระดาษ</li>
                                    <li><a href="/category/product/กรอบอคริลิค">กรอบอคริลิค</a></li>
                                    <li><a href="/category/product/กรอบรูปอื่นๆ">กรอบรูปอื่นๆ</a></li>
                                    <li><a href="/category/product/กรอบรูป-ตั้งโต๊ะ">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>

                              </div>
                              <div class="row">
                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/เทียน-เชิงเทียน" class="text-black">เทียน/เชิงเทียน</a></li>
                                    <li><a href="/category/product/เทียน">เทียน</a></li>
                                    <li><a href="/category/product/เทียนหอม">เทียนหอม</a></li>
                                    <li><a href="/category/product/เทียนไฟฟ้า-led">เทียนไฟฟ้า LED</a></li>
                                    <li><a href="/category/product/เชิงเทียนแบบแขวน">เชิงเทียนแบบแขวน</a></li>
                                    <li><a href="/category/product/ที่วางเทียน">ที่วางเทียน</a></li>
                                    <li><a href="/category/product/เชิงเทียนแบบแขวน">เชิงเทียนแบบแขวน</a></li>
                                    <li><a href="/category/product/เชิงเทียนตะเกียง">เชิงเทียนตะเกียง</a></li>
                                    <li><a href="/category/product/เทียน-เชิงเทียน">- ดูทั้งหมด -</a></li>


                                  </ul>
                                </div>
                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">

                                    <li class="wstheading clearfix"><a href="/category/product/ดอกไม้" class="text-black">ดอกไม้</a></li>
                                    <li><a href="/category/product/ดอกไม้จริง">ดอกไม้จริง</a></li>
                                    <li><a href="/category/product/ดอกไม้ประดิษฐ์">ดอกไม้ประดิษฐ์</a></li>
                                    <li><a href="/category/product/ช่อดอกไม้จริง">ช่อดอกไม้จริง</a></li>
                                    <li><a href="/category/product/ช่อดอกไม้ประดิษฐ์">ช่อดอกไม้ประดิษฐ์</a></li>
                                    <li><a href="/category/product/ดอกไม้ประดิษฐ์ในแจกัน">ดอกไม้ประดิษฐ์ในแจกัน</a></li>
                                    <li><a href="/category/product/ดอกไม้อื่นๆ">ดอกไม้อื่นๆ</a></li>
                                    <li><a href="/category/product/ดอกไม้">- ดูทั้งหมด -</a></li>

                                  </ul>
                                </div>

                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">

                                    <li class="wstheading clearfix mt-2"><a href="/category/product/ต้นไม้" class="text-black">ต้นไม้</a></li>
                                    <li><a href="/category/product/ต้นไม้จริง">ต้นไม้จริง</a></li>
                                    <li><a href="/category/product/ต้นไม้ประดิษฐ์">ต้นไม้ประดิษฐ์</a></li>
                                    <li><a href="/category/product/ต้นไม้จริงในกระถาง">ต้นไม้จริงในกระถาง</a></li>
                                    <li><a href="/category/product/ต้นไม้ประดิษฐ์ในกระถาง">ต้นไม้ประดิษฐ์ในกระถาง</a></li>
                                    <li><a href="/category/product/หญ้าเทียม">หญ้าเทียม</a></li>
                                    <li><a href="/category/product/ต้นไม้อื่น">ต้นไม้อื่น</a></li>

                                    <li><a href="#">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>

                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/หมอน" class="text-black">หมอน</a></li>
                                    <li><a href="/category/product/ปลอกหมอน">ปลอกหมอน</a></li>
                                    <li><a href="/category/product/ไส้หมอน">ไส้หมอน</a></li>
                                    <li><a href="/category/product/หมอนอิง-พร้อมไส้หมอน">หมอนอิงพร้อมไส้</a></li>
                                    <li><a href="/category/product/ปลอกหมอนอิง">ปลอกหมอนอิง</a></li>
                                    <li><a href="/category/product/หมอนอื่นๆ">หมอนอื่นๆ</a></li>
                                    <li><a href="/category/product/หมอน">- ดูทั้งหมด -</a></li>

                                    <li class="wstheading clearfix">ของแต่งบ้านอื่นๆ</li>
                                    <li><a href="/category/product/โมบาย-กระดิ่งลม">โมบาย/กระดิ่งลม</a> </li>
                                  </ul>
                                </div>
                                <div class="col-lg-6 wstadsize01 clearfix"><a href="#"><img src="images/ad-size01.jpg" alt="" ></a></div>
                                <div class="col-lg-6 wstadsize02 clearfix"><a href="#"><img src="images/ad-size02.jpg" alt="" ></a></div>
                              </div>

                          </div>
                        </li>


                        <li><a href="#"><i class="themify ti ti-image font-weight-bold"></i> ของแต่งผนัง</a>
                          <div class="wstitemright clearfix">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/สติ๊กเกอร์ติดผนัง" class="text-black">สติ๊กเกอร์ติดผนัง</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์ติดผนังแผนที่">สติ๊กเกอร์ติดผนังแผนที่</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์-wifi">สติ๊กเกอร์รูป WIFI</li>
                                    <li><a href="/category/product/สติ๊กเกอร์รูปข้อความ">สติ๊กเกอร์รูปข้อความ</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์รูปร้านกาแฟ-ร้านอาหาร">สติ๊กเกอร์ร้านกาแฟ/ร้านอาหาร</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์ติดสวิตช์ไฟ">สติ๊กเกอร์ติดสวิตช์ไฟ</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์เสริมฮวงจุ้ย">สติ๊กเกอร์เสริมฮวงจุ้ย</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์รูปคน">สติ๊กเกอร์รูปคน</li>
                                    <li><a href="/category/product/สติ๊กเกอร์รูปสัตว์">สติ๊กเกอร์รูปสัตว์</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์รูปสิ่งของ">สติ๊กเกอร์รูปสิ่งของ</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์รูปสถานที่ท่องเที่ยว">สติ๊กเกอร์รูปสถานที่ท่องเที่ยว</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์รูปทิวทัศน์">สติ๊กเกอร์รูปทิวทัศน์</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์รูปต้นไม้ดอกไม้">สติ๊กเกอร์รูปต้นไม้ดอกไม้</li>
                                    <li><a href="/category/product/สติ๊กเกอร์สำหรับเด็ก">สติ๊กเกอร์สำหรับเด็ก</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์เทศกาลคริสต์มาส">สติ๊กเกอร์เทศกาลคริสต์มาส</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์อื่นๆ">สติ๊กเกอร์อื่นๆ</a></li>
                                    <li><a href="/category/product/สติ๊กเกอร์ติดผนัง">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>
                                <div class="col-lg-2 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/กรอบรูป-ติดผนัง" class="text-black">กรอบรูป (ติดผนัง)</a></li>
                                    <li><a href="/category/product/กรอบไม้-ติดผนัง">กรอบไม้</a></li>
                                    <li><a href="/category/product/กรอบหลุยส์-ติดผนัง">กรอบหลุยส์</li>
                                    <li><a href="/category/product/กรอบกระดาษ-ติดผนัง">กรอบกระดาษ</a></li>
                                    <li><a href="/category/product/กรอบอคริลิค-ติดผนัง">กรอบอคริลิค</a></li>
                                    <li><a href="/category/product/กรอบรูปอื่นๆ-ติดผนัง">กรอบรูปอื่นๆ</a></li>
                                    <li><a href="/category/product/กรอบรูป-ติดผนัง">- ดูทั้งหมด -</a></li>
                                  </ul>
                                  <ul class="wstliststy02 clearfix mt-2">
                                    <li class="wstheading clearfix"><a href="/category/product/ภาพตกแต่ง" class="text-black">ภาพตกแต่ง</a></li>
                                    <li><a href="#">ภาพวาด</li>
                                    <li><a href="#">ภาพพิมพ์</a></li>
                                    <li><a href="#">ภาพสามมิติ</li>
                                    <li><a href="#">ภาพพิมพ์อื่นๆ	</li>
                                    <li><a href="#">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>

                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix">วอลเปเปอร์</li>
                                    <li><a href="#">วอลล์เปเปอร์ดูเพล็กซ์</a></li>
                                    <li><a href="#">วอลล์เปเปอร์ไวนิล</li>
                                    <li><a href="#">วอลล์เปเปอร์โฟม</li>
                                    <li><a href="#">วอลล์เปเปอร์เท็กซ์ไทล์</li>
                                    <li><a href="#">วอลล์เปเปอร์รูปภาพ</li>
                                    <li><a href="#">วอลล์เปเปอร์ไฟเบอร์</li>
                                    <li><a href="#">วอลล์เปเปอร์ผิวไม้</li>
                                    <li><a href="#">วอลล์เปเปอร์ผิวไม้</li>
                                    <li><a href="#">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>

                                <div class="col-lg-2 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix">ของแต่งผนังอื่นๆ</li>
                                    <li><a href="#">โปสเตอร์</a></li>
                                    <li><a href="#">นาฬิกาติดผนัง</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>


                        <li class="wsmenutextbg" ><a href="#"><i class="themify ti ti-map font-weight-bold"></i> ของแต่งพื้นห้อง</a>
                          <div class="wstitemright clearfix floordecormenuimg">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/พรมปูพื้น" class="text-black">พรมปูพื้น</a></li>
                                    <li><a href="/category/product/พรมทอเรียบ" class="wsmenutextbg" >พรมทอเรียบ</a></li>
                                    <li><a href="/category/product/พรมขนสั้น" class="wsmenutextbg" >พรมขนสั้น</li>
                                    <li><a href="/category/product/พรมขนยาว" class="wsmenutextbg" >พรมขนยาว</a></li>
                                    <li><a href="/category/product/พรมเปอร์เซีย" class="wsmenutextbg" >พรมเปอร์เซีย</a></li>
                                    <li><a href="/category/product/พรมหนังขนสัตว์" class="wsmenutextbg" >พรมหนังขนสัตว์</a></li>
                                    <li><a href="/category/product/พรมเช็ดเท้าหน้าประตู" class="wsmenutextbg" >พรมเช็ดเท้าหน้าประตู</a></li>
                                    <li><a href="/category/product/พรมปูพื้นอื่นๆ" class="wsmenutextbg" >พรมปูพื้นอื่นๆ</a></li>
                                    <li><a href="/category/product/พรมปูพื้น" class="wsmenutextbg" >- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>
                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix" class="wsmenutextbg">ของแต่งพื้นห้องอื่นๆ</li>
                                    <li><a href="#" class="wsmenutextbg">หญ้าเทียม</a></li>
                                    <li><a href="#" class="wsmenutextbg">แผ่นกันลื่น</a></li>
                                    <li><a href="#" class="wsmenutextbg">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>

                              </div>
                            </div>
                          </div>
                        </li>



                        <li><a href="#"><i class="fas fa-couch"></i> เฟอร์นิเจอร์</a>
                          <div class="wstitemright clearfix furnituremenuimg">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/เฟอร์นิเจอร์" class="text-black">เฟอร์นิเจอร์</a></li>
                                    <li><a href="/category/product/โต๊ะ" class="wsmenutextbg">โต๊ะ</a></li>
                                    <li><a href="/category/product/เก้าอี้" class="wsmenutextbg">เก้าอี้</a></li>
                                    <li><a href="/category/product/ตู้" class="wsmenutextbg">ตู้</a></li>
                                    <li><a href="/category/product/เตียง-ฟูกที่นอน" class="wsmenutextbg">เตียง/ฟูกที่นอน</a></li>
                                    <li><a href="/category/product/โซฟา" class="wsmenutextbg">โซฟา</a></li>
                                    <li><a href="/category/product/เฟอร์นิเจอร์อื่นๆ" class="wsmenutextbg">เฟอร์นิเจอร์อื่นๆ</a></li>
                                    <li><a href="/category/product/เฟอร์นิเจอร์" class="wsmenutextbg">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>



                        <li><a href="#"><i class="far fa-lightbulb"></i> โคมไฟ/ไฟตกแต่ง</a>
                          <div class="wstitemright clearfix lightingmenuimg">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-3 col-md-12 clearfix">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/โคมไฟ-ไฟตกแต่ง" class="text-black">โคมไฟ/ไฟตกแต่ง</a></li>
                                    <li><a href="/category/product/โคมไฟตั้งโต๊ะ" class="wsmenutextbg">โคมไฟตั้งโต๊ะ</a></li>
                                    <li><a href="/category/product/โคมไฟตั้งพื้น" class="wsmenutextbg">โคมไฟตั้งพื้น</li>
                                    <li><a href="/category/product/โคมไฟติดเพดาน" class="wsmenutextbg">โคมไฟติดเพดาน</a></li>
                                    <li><a href="/category/product/โคมไฟติดผนัง" class="wsmenutextbg">โคมไฟติดผนัง</a></li>
                                    <li><a href="/category/product/ไฟประดับตกแต่ง" class="wsmenutextbg">ไฟประดับตกแต่ง</a></li>
                                    <li><a href="/category/product/หลอดไฟ" class="wsmenutextbg">หลอดไฟ</a></li>
                                    <li><a href="/category/product/โคมไฟใต้น้ำ" class="wsmenutextbg">โคมไฟใต้น้ำ</a></li>
                                    <li><a href="/category/product/โคมไฟ-ไฟตกแต่งอื่นๆ" class="wsmenutextbg">โคมไฟ/ไฟตกแต่งอื่นๆ</a></li>
                                    <li><a href="/category/product/โคมไฟ-ไฟตกแต่ง" class="wsmenutextbg">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>


                              </div>
                            </div>
                          </div>
                        </li>



                        <li><a href="#"><i class="fas fa-broom"></i></i> ของใช้ในบ้าน</a>
                          <div class="wstitemright clearfix householdstuffmenuimg">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-3 col-md-12">
                                  <ul class="wstliststy02 clearfix">
                                    <li class="wstheading clearfix"><a href="/category/product/ของใช้ในบ้าน" class="text-black">ของใช้ในบ้าน</a></li>
                                    <li><a href="/category/product/ตะขอ-ที่แขวน" class="wsmenutextbg">ตะขอ/ที่แขวน</a></li>
                                    <li><a href="/category/product/กล่องทิชชู่" class="wsmenutextbg">กล่องทิชชู่</a></li>
                                    <li><a href="/category/product/อุปกรณ์บนโต๊ะอาหาร" class="wsmenutextbg">อุปกรณ์บนโต๊ะอาหาร</a></li>
                                    <li><a href="/category/product/ที่วางจาน" class="wsmenutextbg">ที่วางจาน</a></li>
                                    <li><a href="/category/product/กล่องเก็บของ" class="wsmenutextbg">กล่องเก็บของ</a></li>
                                    <li><a href="/category/product/เครื่องใช้ในครัว" class="wsmenutextbg">เครื่องใช้ในครัว</a></li>
                                    <li><a href="/category/product/ตะกร้า" class="wsmenutextbg">ตะกร้า</a></li>
                                    <li><a href="/category/product/ของใช้ในบ้าน" class="wsmenutextbg">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>

                        <li><a href="#"><i class="themify ti ti-ruler-pencil text-bold"></i> บริการ</a>
                          <div class="wstitemright clearfix">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-3 col-md-12">
                                  <ul class="wstliststy02 clearfix">
                                    <li><img src="/images/service-menu-img01.jpg" alt=" "></li>
                                    <li class="wstheading clearfix"><a href="/category/service/ตกแต่งบ้าน" class="text-black">ตกแต่งบ้าน</a></li>
                                    <li><a href="/category/service/งานผ้าม่าน">ตกแต่งทั่วไป</a></li>
                                    <li><a href="/category/service/ตกแต่งภายในทั้งบ้าน">ตกแต่งภายในทั้งบ้าน</a></li>
                                    <li><a href="/category/service/ตกแต่งห้อง">ตกแต่งห้อง</a></li>
                                    <li><a href="ตกแต่งผนัง">ตกแต่งผนัง</a></li>
                                    <li><a href="/category/service/ตกแต่งพื้นห้อง">ตกแต่งพื้นห้อง</a></li>
                                    <li><a href="/category/service/ตกแต่งนอกบ้าน">ตกแต่งนอกบ้าน</a></li>
                                    <li><a href="/category/service/ตกแต่งสวน">ตกแต่งสวน</a></li>
                                    <li><a href="/category/service/ตกแต่งบ้าน">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                  <ul class="wstliststy02 clearfix">
                                    <li><img src="/images/service-menu-img02.jpg" alt=" "></li>
                                    <li class="wstheading clearfix"><a href="/category/service/ซ่อมแซม" class="text-black">ซ่อมแซม</a></li>
                                    <li><a href="/category/service/ซ่อมแซมทั่วไป">ซ่อมแซมทั่วไป</a></li>
                                    <li><a href="/category/service/ซ่อมแซมอุปกรณ์ไฟฟ้า">ซ่อมแซมอุปกรณ์ไฟฟ้า</a></li>
                                    <li><a href="/category/service/ซ่อมแซมเครื่องไช้ไฟฟ้า">ซ่อมแซมเครื่องไช้ไฟฟ้า</a></li>
                                    <li><a href="/category/service/ซ่อมแซมบ้าน">ซ่อมแซมบ้าน</a> </li>
                                    <li><a href="/category/service/ซ่อมแซมผนัง">ซ่อมแซมผนัง</a> </li>
                                    <li><a href="/category/service/ซ่อมแซมพื้นห้อง">ซ่อมแซมพื้นห้อง</a></li>
                                    <li><a href="/category/service/ซ่อมแซมเฟอร์นิเจอร์">ซ่อมแซมเฟอร์นิเจอร์</a></li>
                                    <li><a href="/category/service/ซ่อมแซมประตู-กุญแจ">ซ่อมแซมประตู/กุญแจ</a></li>
                                    <li><a href="/category/service/ซ่อมแซม">- ดูทั้งหมด -</a></li>

                                  </ul>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                  <ul class="wstliststy02 clearfix">
                                    <li><img src="/images/service-menu-img03.jpg" alt=" "></li>
                                    <li class="wstheading clearfix"><a href="/category/service/ประกอบ-ติดตั้ง" class="text-black">ประกอบ/ติดตั้ง</a></li>
                                    <li><a href="/category/service/ประกอบ-ติดตั้งทั่วไป">ประกอบ/ติดตั้งทั่วไป</a></li>
                                    <li><a href="/category/service/ติดตั้งอุปกรณ์ประปา">ติดตั้งอุปกรณ์ประปา</a></li>
                                    <li><a href="/category/service/ติดตั้งเครื่องใช้ไฟฟ้า">ติดตั้งเครื่องใช้ไฟฟ้า</a></li>
                                    <li><a href="/category/service/ติดตั้งงานไฟฟ้าและแสงสว่าง">ติดตั้งงานไฟฟ้าและแสงสว่าง</a></li>
                                    <li><a href="/category/service/ติดตั้งผ้าม่าน">ติดตั้งผ้าม่าน</a></li>
                                    <li><a href="/category/service/ประกอบ-ติดตั้ง">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                  <ul class="wstliststy02 clearfix">
                                    <li><img src="/images/service-menu-img04.jpg" alt=" "></li>
                                    <li class="wstheading clearfix"><a href="/category/service/ทำความสะอาด" class="text-black">ทำความสะอาด</a></li>
                                    <li><a href="/category/service/ทำความสะอาดทั่วไป">ทำความสะอาดทั่วไป</a></li>
                                    <li><a href="/category/service/ทำความสะอาดห้อง">ทำความสะอาดห้อง</a></li>
                                    <li><a href="/category/service/งานซัก-อบ-รีดเสื้อผ้า">งานซัก-อบ-รีดเสื้อผ้า</a></li>
                                    <li><a href="/category/service/ทำความสะอาด" class="text-black">- ดูทั้งหมด -</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>


                      </ul>
                    </div>
                  </div>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/products">
                      <span><i class="themify ti ti-package" ></i> สินค้า</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/services">
                      <span><i class="themify ti ti-ruler-pencil" ></i> บริการ</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="{{ url('/') }}">
                      <span><i class="themify ti ti-layout-accordion-list" ></i> คอมมูนิตี้</span>
                  </a>
                </li>


                <li class="nav-item" style="float:right !important;">
                  <a class="navtext" id="cart" href="{{ route('product.Cart') }}">
                      <span><i class="themify ti ti-shopping-cart" ></i> ตะกร้าสินค้า <span class="badge badge-secondary">@php echo CartController::getCartTotal(); @endphp</span></span>
                  </a>
                </li>

                  @if (!Auth::check())
                    <li class="nav-item" style="float:right !important;">
                      <a class="navtext" href="{{ route('login') }}">
                          <span><i class="themify ti ti-user"></i> เข้าสู่ระบบ/สมัครสมาชิก</span>
                      </a>
                    </li>
                @else
                <li class="nav-item" style="float:right !important;">
                  <a class="navtext text-black" href="/messenger/">
                    <span><i class='far fa-comments'></i> ข้อความ <span class="badge badge-danger">1</span></span>
                  </a>
                </li>
                    <li class="nav-item" style="float:right !important;">
                    <a class="navtext" href="/dashboard/">
                      <img class="rounded-circle d-inline"  style="display: block; width: 18px; height: 18px; object-fit: cover;" src="/images/{{Auth::user()->photo ? Auth::user()->photo->file : 'no_avatar.png'}}"> <span class="d-inline font-weight-bold"><?php if(empty(Auth::user()->firstname)){ echo Auth::user()->name; }else{ echo Auth::user()->firstname.' '.Auth::user()->lastname; } ?></span>
                    </a>

                    </li>

                    @endif


              </ul>

            </nav>
          </div>
        </div>
        <main>
            @yield('content')
        </main>
  </div>
</div>

    <!--footer starts from here-->
    <footer class="footer">
    <div class="container bottom_border">
    <div class="row">
    <div class=" col-sm-4 col-md col-sm-4  col-12 col">
    <h5 class="headin5_amrc col_white_amrc pt2"><img width="200" class="img-fluid" src="/images/decoriq_footer.png" alt=""></h5>
    <!--headin5_amrc-->
    <p class="mb10">คือแพลตฟอร์มมาร์เก็ตเพลสที่รวบรวมสินค้าและบริการเกี่ยวกับบ้านจากร้านค้าที่หลากหลาย สำหรับผู้ที่ต้องการเนรมิตตกแต่งบ้าน คอนโด ที่อยู่อาศัยของคุณให้เป็นไปตามสไตล์ที่ต้องการในราคาที่ใครก็เป็นเจ้าของได้</p>
    <p><i class="fa fa-phone"></i>  02-157-3733</p>
    <p><i class="fab fa-line"></i>  @DECORIQ</p>
    <p><i class="fa fa-location-arrow"></i> กรุงเทพ, ประเทศไทย.</p>
    <p><i class="fa fa fa-envelope"></i> contact@decoriq.com</p>


    </div>


    <div class=" col-sm-4 col-md  col-6 col">
    <h5 class="headin5_amrc col_white_amrc pt2">เกี่ยวกับเดคคอริค</h5>
    <!--headin5_amrc-->
    <ul class="footer_ul_amrc">
    <li><a href="/page/about-us">เกี่ยวกับเรา</a></li>
    <li><a href="#">ข่าวสารของเรา</a></li>
    <li><a href="#">ร่วมงานกับเรา</a></li>
    <li><a href="/partner/become">ลงขายกับเรา</a></li>
    <li><a href="#">สนใจเป็นตัวแทนขาย</a></li>
    </ul>
    <!--footer_ul_amrc ends here-->
    </div>


    <div class=" col-sm-4 col-md  col-6 col">
    <h5 class="headin5_amrc col_white_amrc pt2">ความช่วยเหลือ</h5>
    <!--headin5_amrc-->
    <ul class="footer_ul_amrc">
    <li><a href="#">ติดต่อสอบถาม</a></li>
    <li><a href="/page/faq">คำถามที่ถูกถามบ่อย</a></li>
    <li><a href="#">คู่มือการเรียนรู้ผู้ซื้อ/ผู้ขาย</a></li>
    <li><a href="#">ข้อมูลการจัดส่งสินค้า</a></li>
    <li><a href="#">ปัญหาและการคืนสินค้า</a></li>
    <li><a href="/page/privacy-policy">นโยบายความเป็นส่วนตัว</a></li>
    </ul>
    <!--footer_ul_amrc ends here-->
    </div>


    <div class=" col-sm-4 col-md  col-12 col">
    <h5 class="headin5_amrc col_white_amrc pt2">แฟนเพจ</h5>
    <div class="fb-page" data-href="https://www.facebook.com/decoriq" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/decoriq" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/decoriq">DECORIQ</a></blockquote></div>
    <!--headin5_amrc ends here-->

    <select class="selectpicker">
        <option data-content='<span class="flag-icon flag-icon-us"></span> English'>English</option>
        <option data-content='<span class="flag-icon flag-icon-mx"></span> Español'>Español</option>
    </select>
    <!--footer_ul2_amrc ends here-->
    </div>
    </div>
    </div>


    <div class="container">
    <ul class="foote_bottom_ul_amrc">
    <li><a href="{{ url('/') }}">หน้าหลัก</a></li>
    <li><a href="/products">สินค้า</a></li>
    <li><a href="/services">บริการ</a></li>
    <li><a href="#">คอมมูนิตี้</a></li>
    <li><a href="#">ติดต่อเรา</a></li>
    </ul>
    <!--foote_bottom_ul_amrc ends here-->
    <p class="text-center">Copyright 2019 DECORIQ</p>


    <ul class="social_footer_ul">
    <li><a href="https://www.facebook.com/decoriq"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="https://twitter.com/decoriq"><i class="fab fa-twitter"></i></a></li>
    <li><a href="http://instagram.com/decoriq/"><i class="fab fa-instagram"></i></a></li>
    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
    </ul>
    <!--social_footer_ul ends here-->
    </div>

    </footer>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/webslidemenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ekko-lightbox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fileuploader.min.js') }}"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.3"></script>

    <script type="text/javascript">

      $(document).ready(function(){
        $('.product-list').slick({
          arrows: true,
          dots: true,
          infinite: false,
          speed: 300,
          slidesToShow: 4,
          slidesToScroll: 4,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
      });
    </script>

    @if(Request::is('cart'))

    <script type="text/javascript">
    /* start js for cart page */

        $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
        });


      /*  quantity input field in cart apge   */
      $(document).ready(function(){
      (function() {

          window.inputNumber = function(el) {

            var min = el.attr('min') || false;
            var max = el.attr('max') || false;

            var els = {};

            els.dec = el.prev();
            els.inc = el.next();

            el.each(function() {
              init($(this));
            });

            function init(el) {

              els.dec.on('click', decrement);
              els.inc.on('click', increment);

              function decrement() {
                var value = el[0].value;
                value--;
                if(!min || value >= min) {
                  el[0].value = value;
                }
              }

              function increment() {
                var value = el[0].value;
                value++;
                if(!max || value <= max) {
                  el[0].value = value++;
                }
              }
            }
          }
        })();

        $('.input-number').each(function(){
            inputNumber($(this));
        })
       });

      $(document).ready(function(){
        //Ajax for post code input to get province and district
              $('#ShippingAddressPostalcode').keyup(function ()  {
                  if($("#ShippingAddressPostalcode").val().length >= 5) {
                    $("select[name='thai_city_id']").find('option').remove();
                    var postal_code = $(this).val();
                    if(postal_code){
                      $.ajax({
                          type: "GET",
                          url: "/cart/getthaicity/"+postal_code,
                          datatype: "json",
                          success: function(data) {
                            if(data){
                              $.each(data, function(key, value) {
                                  $('select[name="thai_city_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                              });
                            }
                          }
                      }); //END $.ajax
                    }else{
                      $('select[name="thai_city_id"]').append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>');
                    }
                  }
                  else{
                    $("select[name='thai_city_id']").find('option').remove().end().append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>').val('');
                  }

              })}); //END province dropdown change event


              @auth
              $(document).ready(function(){
                // set selected address as session
                  $('.shipping-address-success').click(function ()  {

                      // clear shipping
                      $('table[id="shippingdetailtable"]').empty();

                      var firstname = $(this).find("span.firstname").html();
                      var lastname = $(this).find("span.lastname").html();
                      var address1 = $(this).find("span.address1").html();
                      var address2 = $(this).find("span.address2").html();
                      var thai_city_id = $(this).find("input.thai-city-id").val();
                      var thai_city = $(this).find("span.thai-city").html();
                      var postal_code = $(this).find("span.postal-code").html();
                      var tel_number = $(this).find("span.tel_number").html();

                      <?php sort($product_id_array); ?>
                      var product_id_array = <?php echo json_encode($product_id_array); ?>;

                     var selected_address =
                     {
                         "firstname":firstname,
                         "lastname":lastname,
                         "address1":address1,
                         "address2":address2,
                         "thai_city_id":thai_city_id,
                         "thai_city":thai_city,
                         "postal_code":postal_code,
                         "tel_number":tel_number
                     }

                        $.ajax({
                           type: "GET",
                           url: '/cart/set-logged-in-customer-address-session/',
                           datatype: "json",
                           data: {product_id_array:product_id_array,selected_address:selected_address},
                           success: function(result){

                             for (var product_id in result) {
                               $('.shipping-list-'+product_id+'').html("");
                               for(var shipping_id in result[product_id])
                                  if (result.hasOwnProperty(product_id)) {
                                    if(result[product_id][shipping_id]['allow']==1){
                                      var shipping = '<div class="input-container shippingradiogroup"> <input class="radio-button shipping-radio-button" data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" type="radio" name="shipping-of-'+product_id+'" value="'+shipping_id+'" required> <div class="radio-tile"> <label for="'+result[product_id][shipping_id]['name']+'" class="radio-tile-label"  data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" >'+result[product_id][shipping_id]['name']+'</label> </div> </div> ';
                                      $('.shipping-list-'+product_id+'').append(shipping);
                                    }else{
                                      var shipping = '<div class="input-container shippingradiogroup"> <input class="radio-button shipping-radio-button" data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" type="radio" name="shipping-of-'+product_id+'" value="'+shipping_id+'" disabled/> <div class="radio-tile" style="color:gray !important; background-color:lightgray !important; border:0 !important;" > <label for="'+result[product_id][shipping_id]['name']+'" class="radio-tile-label" data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" >'+result[product_id][shipping_id]['name']+'</label> </div> </div> ';
                                      $('.shipping-list-'+product_id+'').append(shipping);
                                    }
                                  }

                              }

                           }//END $.success
                         });//END $.ajax
                      });
                    });



            $(document).ready(function(){

              var address_radios = document.getElementsByName("address");
              var address_val = localStorage.getItem('address');
              for(var i=0;i<address_radios.length;i++){
                if(address_radios[i].value == address_val){
                  address_radios[i].checked = true;
                }
              }

              $('input[name="address"]').on('change', function(){
                localStorage.setItem('address', $(this).val());
              });

              var firstname = $("input[name='address']:checked").parent().find("span.firstname").html();
              var lastname = $("input[name='address']:checked").parent().find("span.lastname").html();
              var address1 = $("input[name='address']:checked").parent().find("span.address1").html();
              var address2 = $("input[name='address']:checked").parent().find("span.address2").html();
              var thai_city_id = $("input[name='address']:checked").parent().find("input.thai-city-id").val();
              var thai_city = $("input[name='address']:checked").parent().find("span.thai-city").html();
              var postal_code = $("input[name='address']:checked").parent().find("span.postal-code").html();
              var tel_number = $("input[name='address']:checked").parent().find("span.tel_number").html();


              <?php sort($product_id_array); ?>
              var product_id_array = <?php echo json_encode($product_id_array);  ?>;
              var selected_address =
                 {
                     "firstname":firstname,
                     "lastname":lastname,
                     "address1":address1,
                     "address2":address2,
                     "thai_city_id":thai_city_id,
                     "thai_city":thai_city,
                     "postal_code":postal_code,
                     "tel_number":tel_number
                 }

                 // set address session for logged in customer
                $.ajax({
                   type: "GET",
                   url: '/cart/set-logged-in-customer-address-session/',
                   datatype: "json",
                   data: {product_id_array:product_id_array,selected_address:selected_address},
                   success: function(result){

                     // get shipping from logged in customer's adddress
                     for (var product_id in result) {
                       $('.shipping-list-'+product_id+'').html("");
                       for(var shipping_id in result[product_id])
                          if (result.hasOwnProperty(product_id)) {
                            if(result[product_id][shipping_id]['allow']==1){
                              var shipping = '<div class="input-container shippingradiogroup"> <input class="radio-button shipping-radio-button" data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" type="radio" name="shipping-of-'+product_id+'" value="'+shipping_id+'" required> <div class="radio-tile"> <label for="'+result[product_id][shipping_id]['name']+'" class="radio-tile-label"  data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" >'+result[product_id][shipping_id]['name']+'</label> </div> </div> ';
                              $('.shipping-list-'+product_id+'').append(shipping);
                            }else{
                              var shipping = '<div class="input-container shippingradiogroup"> <input class="radio-button shipping-radio-button" type="radio" data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" name="shipping-of-'+product_id+'" value="'+shipping_id+'" disabled/> <div class="radio-tile" style="color:gray !important; background-color:lightgray !important; border:0 !important;" > <label for="'+result[product_id][shipping_id]['name']+'" class="radio-tile-label"  data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" >'+result[product_id][shipping_id]['name']+'</label> </div> </div> ';
                              $('.shipping-list-'+product_id+'').append(shipping);
                            }
                          }
                      }

                   }//END $.success
                 });//END $.ajax

                 // show modal if no address in database for logged in customer
                 var user_id = <?php echo Auth::user()->id; ?>;
                $.ajax({

                   type: "GET",
                   url: '/cart/check-logged-in-user-address-available/'+user_id,
                   datatype: "text",
                   success: function(result){
                     if(result==""){
                       $("#AddShippingModal").modal();
                     }
                   }//END $.success
                 });//END $.ajax


            });
            @endauth

    </script>

    <script type="text/javascript">
    // click shipping list then check parent store radio button and calculate shipping cost
       $(document).on('click', '.shipping-radio-button', function () {
           $('[data-smth="' + $(this).attr('data-parent') + '"]').prop("checked", true);
           $('table[id="shippingdetailtable"]').empty();
           var totalshippingcost=0;
           <?php if(isset($arrproducts)){  ?>
           var productsincartlist = <?php echo json_encode($arrproducts) ?>;
           <?php } ?>
           var store_id = $(this).attr('data-parent').substring(7);

           var string1 = "";
           var string2 = "";
           var js_array = [];
           var count = 0;

           var product_shipping_data =
             {
             }
           for(var k1 in productsincartlist[store_id]) {
               var product_id = productsincartlist[store_id][k1]["id"];
               var product_amount = $('body').find('#amount-'+product_id).val();
               var shipping_id = $("input[name='shipping-of-"+product_id+"']:checked").val();
               product_shipping_data[k1] = {"shipping_id":shipping_id,"product_id":product_id,"product_amount":product_amount};
             }

             // show subtotal
             inputs = $('.product-subtotal-of-store-'+store_id);
             var store_subtotal = 0;
             for(var i = 0; i < inputs.length; i++){
                   store_subtotal += parseInt($(inputs[i]).html().slice(0,-2));
             }
             $("#subtotal").text(store_subtotal);

             if(shipping_id) {
                 $.ajax({
                     url: '/cart/shippingcostcalculate/',
                     type: "GET",
                     dataType: "json",
                     data: {product_shipping_data},
                      success: function(result){
                        if(result){
                            $.each(result, function(index, value) {
                              $('table[id="shippingdetailtable"]').append('<tr><td class="shipping-name pl-3 pr-9 pt-1 pb-0"> - '+ value["name"] +'</td> <td class="shipping-cost p-1 text-right shipping-cost-'+value["store_id"]+'">'+ value["cost"] +' ฿</td></tr><input type="hidden" class="shipping-cost-input-'+value["store_id"]+'" value="'+ value["name"]+','+value["cost"] +'">');
                          });

                        }
                      }

                  })
             }


             // show cart total
             setTimeout(function(){
               inputs2 = $('body').find('.shipping-cost-'+store_id);
               var store_shipping_total = 0;
               for(var i = 0; i < inputs2.length; i++){
                     store_shipping_total += parseInt($(inputs2[i]).html().slice(0,-2));
               }
               store_carttotal = store_shipping_total+store_subtotal;
               $("#total").text(store_carttotal);
             }, 600);

       })
    </script>

    <!-- delete address -->
    <script type="text/javascript">
          function deleteAddress(i,address_id){
            if (confirm("คุณต้องการจะลบที่อยู่ "+i+" นี้ ใช้หรือไม่?")) {
              $.ajax({
                  type: "GET",
                  url: "/cart/deleteaddress/"+address_id,
                  datatype: "text",
                  success: function(data) {
                    alert("เราได้ทำการลบที่อยู่นี้เรียบร้อยแล้ว");
                    location.reload();
                    }
                   //END success fn
              }); //END $.ajax
            }
          };
     </script>

     <script type="text/javascript">
     /* edit address modal */
         $(document).on("click", ".openeditshippingmodal", function () {
               var address_id = $(this).data('address-id')
               var firstname = $(this).data('firstname');
               var lastname = $(this).data('lastname');
               var address1 = $(this).data('address1');
               var address2 = $(this).data('address2');
               var postal_code = $(this).data('postal_code');
               var thai_city_id  = $(this).data('thai_city_id');
               var tel_number  = $(this).data('tel_number');


               $(".modal-body #ShippingAddressAddressIdEdit").val( address_id );
               $(".modal-body #ShippingAddressFirstnameEdit").val( firstname );
               $(".modal-body #ShippingAddressLastnameEdit").val( lastname );
               $(".modal-body #ShippingAddressAddress1Edit").val( address1 );
               $(".modal-body #ShippingAddressAddress2Edit").val( address2 );
               $(".modal-body #ShippingAddressPostalcodeEdit").val( postal_code );
               $(".modal-body #ShippingAddressTelNumberEdit").val( tel_number );

               /* get thai city province on edit modal */
                   if($("#ShippingAddressPostalcodeEdit").val().length >= 5) {
                     $("select[name='thai_city_idEdit']").find('option').remove();
                     if(postal_code){
                       $.ajax({
                           type: "GET",
                           url: "/cart/getthaicity/"+postal_code,
                           datatype: "json",
                           success: function(data) {
                             if(data){
                               $.each(data, function(key, value) {
                                   $('select[name="thai_city_idEdit"]').append('<option value="'+ key +'">'+ value +'</option>');
                               });
                             }
                           } //END success fn
                       }); //END $.ajax
                     }else{
                       $('select[name="thai_city_idEdit"]').append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>');
                     }
                   }
                   else{
                     $("select[name='thai_city_idEdit']").find('option').remove().end().append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>').val('');
                   }

                   setTimeout('$(".modal-body #thai_cityEdit").val( '+thai_city_id+' )',300)

                 });

            $(document).ready(function(){
                $('#ShippingAddressPostalcodeEdit').keyup(function ()  {
                    if($("#ShippingAddressPostalcodeEdit").val().length >= 5) {
                      $("select[name='thai_city_idEdit']").find('option').remove();
                      var postal_code = $(this).val();
                      if(postal_code){
                        $.ajax({
                            type: "GET",
                            url: "/cart/getthaicity/"+postal_code,
                            datatype: "json",
                            success: function(data) {
                              if(data){
                                $.each(data, function(key, value) {
                                    $('select[name="thai_city_idEdit"]').append('<option value="'+ key +'">'+ value +'</option>');
                                });
                              }
                            } //END success fn
                        }); //END $.ajax
                      }else{
                        $('select[name="thai_city_idEdit"]').append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>');
                      }
                    }
                    else{
                      $("select[name='thai_city_idEdit']").find('option').remove().end().append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>').val('');
                    }
                })});

       </script>

     @guest
        <script type="text/javascript">
             $(document).ready(function(){

               // set selected address as session on guest customer
                 var thai_city_id = $("input.thai-city-id").val();

                     var firstname = $("span.firstname").text();
                     var lastname = $("span.lastname").text();
                     var address1 = $("span.address1").text();
                     var address2 = $("span.address2").text();
                     var thai_city = $("span.thai-city").text();
                     var postal_code = $("span.postal-code").text();
                     var tel_number = $("span.tel_number").text();


                     <?php sort($product_id_array); ?>
                     var product_id_array = <?php echo json_encode($product_id_array); ?>;

                   var selected_address =
                    {
                        "firstname":firstname,
                        "lastname":lastname,
                        "address1":address1,
                        "address2":address2,
                        "thai_city_id":thai_city_id,
                        "thai_city":thai_city,
                        "postal_code":postal_code,
                        "tel_number":tel_number
                    }

                    // get shipping list for guest customer
                    if(selected_address["thai_city_id"]!=""){
                       $.ajax({
                          type: "GET",
                          url: '/cart/set-logged-in-customer-address-session/',
                          datatype: "json",
                          data: {product_id_array:product_id_array,selected_address:selected_address},
                          success: function(result){
                            for (var product_id in result) {
                              $('.shipping-list-'+product_id+'').html("");
                              for(var shipping_id in result[product_id])
                                 if (result.hasOwnProperty(product_id)) {
                                   if(result[product_id][shipping_id]['allow']==1){
                                       var shipping = '<div class="input-container shippingradiogroup"> <input class="radio-button shipping-radio-button" data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" type="radio" name="shipping-of-'+product_id+'" value="'+shipping_id+'" data-parent="parent_2" required> <div class="radio-tile"> <label for="'+result[product_id][shipping_id]['name']+'" class="radio-tile-label"  data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" >'+result[product_id][shipping_id]['name']+'</label> </div> </div> ';
                                       $('.shipping-list-'+product_id+'').append(shipping);
                                   }else{
                                       var shipping = '<div class="input-container shippingradiogroup"> <input class="radio-button shipping-radio-button" data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" type="radio" name="shipping-of-'+product_id+'" value="'+shipping_id+'" disabled/> <div class="radio-tile" style="color:gray !important; background-color:lightgray !important; border:0 !important;" > <label for="'+result[product_id][shipping_id]['name']+'" class="radio-tile-label"  data-parent="parent_'+result[product_id][shipping_id]['store_id']+'" >'+result[product_id][shipping_id]['name']+'</label> </div> </div> ';
                                       $('.shipping-list-'+product_id+'').append(shipping);
                                   }
                                 }

                             }
                          }//END $.success
                        });//END $.ajax
                      }else
                       {
                          // Open Modal if address not selected
                          $("#AddShippingModal").modal();
                        }

                 });
             </script>

     @endguest



     <script type="text/javascript">
       $(document).ready(function(){

         /* calculate shipping cost after click store radio button or name */

         $(".store_id").on("click",function(){
           $('table[id="shippingdetailtable"]').empty();
           var totalshippingcost=0;
           <?php if(isset($arrproducts)){  ?>
           var productsincartlist = <?php echo json_encode($arrproducts) ?>;
           <?php } ?>
           var store_id = $(this).val();

           var string1 = "";
           var string2 = "";
           var js_array = [];
           var count = 0;

           var product_shipping_data =
             {
             }
           for(var k1 in productsincartlist[store_id]) {
               var product_id = productsincartlist[store_id][k1]["id"];
               var product_amount = $('body').find('#amount-'+product_id).val();
               var shipping_id = $("input[name='shipping-of-"+product_id+"']:checked").val();
               product_shipping_data[k1] = {"shipping_id":shipping_id,"product_id":product_id,"product_amount":product_amount};
             }

             // show subtotal
             var store_id = $(this).val();
             inputs = $('.product-subtotal-of-store-'+store_id);
             var store_subtotal = 0;
             for(var i = 0; i < inputs.length; i++){
                   store_subtotal += parseInt($(inputs[i]).html().slice(0,-2));
             }
             $("#subtotal").text(store_subtotal);

             if(shipping_id) {
                 $.ajax({
                     url: '/cart/shippingcostcalculate/',
                     type: "GET",
                     dataType: "json",
                     data: {product_shipping_data},
                      success: function(result){
                        if(result){
                            $.each(result, function(index, value) {
                              $('table[id="shippingdetailtable"]').append('<tr><td class="shipping-name pl-3 pr-9 pt-1 pb-0"> - '+ value["name"] +'</td> <td class="shipping-cost p-1 text-right shipping-cost-'+value["store_id"]+'">'+ value["cost"] +' ฿</td></tr><input type="hidden" class="shipping-cost-input-'+value["store_id"]+'" value="'+ value["name"]+','+value["cost"] +'">');
                          });
                       //   console.log(result);
                        }
                      }

                  })
             }




             // show cart total
             setTimeout(function(){
               inputs2 = $('body').find('.shipping-cost-'+store_id);
               var store_shipping_total = 0;
               for(var i = 0; i < inputs2.length; i++){
                     store_shipping_total += parseInt($(inputs2[i]).html().slice(0,-2));
               }
               store_carttotal = store_shipping_total+store_subtotal;
               $("#total").text(store_carttotal);
             }, 600);

         });

     });
     </script>


     <script type="text/javascript">
         $(document).ready(function(){

           /* make cart page still selected shipping item even user refresh */
           setTimeout(function(){
                <?php if(isset($arrproducts)){  ?>
                var productsincartlist = <?php echo json_encode($arrproducts) ?>;
                    for(var key in productsincartlist) {
                      for(var key2 in productsincartlist[key]) {
                        var product_id = productsincartlist[key][key2]["id"];
                        var shipping_radios = document.getElementsByName("shipping-of-"+product_id);
                        var shipping_val = localStorage.getItem("shipping-of-"+product_id);
                        for(var i=0;i<shipping_radios.length;i++){
                          if(shipping_radios[i].value == shipping_val){
                            shipping_radios[i].checked = true;
                          }
                        }
                      }
                    }
                <?php } ?>
                $('input.radio-button').click(function(){
                  localStorage.setItem($(this).attr('name'), $(this).val());
                });
              },500);


           });
       </script>

       <script type="text/javascript">
       $(document).ready(function(){
          $('.input-number').bind('keyup mouseup', function () {
          });
        });

       </script>


       <script type="text/javascript">
         // set cart detail after click input
         $(document).on('click', '.input-number-decrement, .input-number-increment', function () {
           $('[data-smth="' + $(this).attr('data-parent') + '"]').prop("checked", true);
           var product_id = $(this).attr('id').substring(23);
           var product_price = $(this).closest('td').prev('td').find('span').text();
           console.log(product_price);
           var product_amount = $('body').find('#amount-'+product_id).val();
           $("#cart-price-of-"+product_id).html(product_price*product_amount+" ฿");

           var store_id = $(this).attr('data-parent').substring(7);

           // show subtotal
           inputs = $('body').find('.product-subtotal-of-store-'+store_id);
           var store_subtotal = 0;
           for(var i = 0; i < inputs.length; i++){
                 store_subtotal += parseInt($(inputs[i]).html().slice(0,-2));
           }
           $("#subtotal").text(store_subtotal);


            // show shipping in cart table
            $('table[id="shippingdetailtable"]').empty();
            var totalshippingcost=0;
            <?php if(isset($arrproducts)){  ?>
            var productsincartlist = <?php echo json_encode($arrproducts) ?>;
            <?php } ?>
            var store_id = $(this).attr('data-parent').substring(7);

            var string1 = "";
            var string2 = "";
            var js_array = [];
            var count = 0;

            var product_shipping_data =
              {
              }
            for(var k1 in productsincartlist[store_id]) {
                var product_id = productsincartlist[store_id][k1]["id"];
                var product_amount = $('body').find('#amount-'+product_id).val();
                var shipping_id = $("input[name='shipping-of-"+product_id+"']:checked").val();
                product_shipping_data[k1] = {"shipping_id":shipping_id,"product_id":product_id,"product_amount":product_amount};

              }


              if(shipping_id) {
                 $.ajax({
                        url: '/cart/shippingcostcalculate/',
                        type: "GET",
                        dataType: "json",
                        data: {product_shipping_data},
                        success: function(result){
                          if(result){
                            $.each(result, function(index, value) {
                              $('table[id="shippingdetailtable"]').append('<tr><td class="shipping-name pl-3 pr-9 pt-1 pb-0"> - '+ value["name"] +'</td> <td class="shipping-cost p-1 text-right shipping-cost-'+value["store_id"]+'">'+ value["cost"] +' ฿</td></tr><input type="hidden" class="shipping-cost-input-'+value["store_id"]+'" value="'+ value["name"]+','+value["cost"] +'">');
                            });
                          //  console.log(result);
                         }
                       }

                    })
               }
               //end of show shipping list in cart table


             setTimeout(function(){
               inputs2 = $('body').find('.shipping-cost-'+store_id);
               var store_shipping_total = 0;
               for(var i = 0; i < inputs2.length; i++){
                     store_shipping_total += parseInt($(inputs2[i]).html().slice(0,-2));
               }
               store_carttotal = store_shipping_total+store_subtotal;
               $("#total").text(store_carttotal);
             }, 600);

          });


        </script>

        <script type="text/javascript">
        $(document).ready(function(){

          // set value in loaded document page
           $('.input-number').bind('keyup mouseup', function () {
             $('[data-smth="' + $(this).attr('data-parent') + '"]').prop("checked", true);
             var product_price =  $(this).closest('td').prev('td').text().split(' ');
             product_price = product_price[0];
             var product_amount = $(this).val();
             var product_id = $(this).attr('id').substring(7);
             $("#cart-price-of-"+product_id).html(product_price*product_amount+" ฿");
             var store_id = $(this).attr('data-parent').substring(7);

             inputs = $('.product-subtotal-of-store-'+store_id);
             var store_subtotal = 0;
             for(var i = 0; i < inputs.length; i++){
                   store_subtotal += parseInt($(inputs[i]).html().slice(0,-2));
             }
             $("#subtotal").text(store_subtotal);

             // show cart total
             setTimeout(function(){
               inputs2 = $('body').find('.shipping-cost-'+store_id);
               var store_shipping_total = 0;
               for(var i = 0; i < inputs2.length; i++){
                     store_shipping_total += parseInt($(inputs2[i]).html().slice(0,-2));
               }
               store_carttotal = store_shipping_total+store_subtotal;
               $("#total").text(store_carttotal);
             }, 800);

             // show shipping in cart table
             $('table[id="shippingdetailtable"]').empty();
             var totalshippingcost=0;
             <?php if(isset($arrproducts)){  ?>
             var productsincartlist = <?php echo json_encode($arrproducts) ?>;
             <?php } ?>
             var store_id = $(this).attr('data-parent').substring(7);

             var string1 = "";
             var string2 = "";
             var js_array = [];
             var count = 0;

             var product_shipping_data =
               {
               }
             for(var k1 in productsincartlist[store_id]) {
                 var product_id = productsincartlist[store_id][k1]["id"];
                 var product_amount = $(this).val();
                 var shipping_id = $("input[name='shipping-of-"+product_id+"']:checked").val();
                 product_shipping_data[k1] = {"shipping_id":shipping_id,"product_id":product_id,"product_amount":product_amount};
               }

               if(shipping_id) {
                  $.ajax({
                         url: '/cart/shippingcostcalculate/',
                         type: "GET",
                         dataType: "json",
                         data: {product_shipping_data},
                         success: function(result){
                                  if(result){
                                     $.each(result, function(index, value) {
                                     $('table[id="shippingdetailtable"]').append('<tr><td class="shipping-name pl-3 pr-9 pt-1 pb-0"> - '+ value["name"] +'</td> <td class="shipping-cost p-1 text-right shipping-cost-'+value["store_id"]+'">'+ value["cost"] +' ฿</td></tr>');
                                   });
                               }
                            }

                     })
                }
                //end of show shipping list in cart table

           });

         });

         </script>


        <script type="text/javascript">

        // force user to only put number in quantity input field
        function isNumber(evt) {

              evt = (evt) ? evt : window.event;
              var charCode = (evt.which) ? evt.which : evt.keyCode;
              if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                  return false;
              }
              return true;
          }
       </script>

       <script type="text/javascript">
         $(document).ready(function(){
           $('input[name=store_id]').prop('checked', false);
           /* when customer want to checkout   */
           $("#checkout-button").on("click",function(){
             if($('.store_id:checked').length){
             var store_id = $("input[name='store_id']:checked").val();
             var cart_json = <?php echo json_encode(session('cart')); ?>;
             var new_cart_json = [];
             for(var k in cart_json['items']) {
                 if(cart_json['items'][k]['store_id']==store_id){
                   new_cart_json.push(cart_json['items'][k]);
                   delete cart_json['items'][k]['item'];
                 }
              }

             for(var k in new_cart_json){
               var product_id = new_cart_json[k]['id'];
               new_cart_json[k]['qty'] = $('body').find('#amount-'+product_id).val();
             }

             if(isNaN($("#total").text())){
               alert("การจัดส่งของคุณไม่ถูกต้อง กรุณาเลือกการจัดส่งใหม่");
             }else if($('#shippingdetailtable').is(':empty') ){
               alert('คุณอาจมีสินค้าที่ไม่ได้เลือกการจัดส่ง กรุณาเลือกการจัดส่งให้ครบถ้วน');
             }
             else{
             $.ajax({
                 url: '/cart/to-checkout/',
                 type: "GET",
                 dataType: "json",
                 data: {new_cart_json,store_id},
                  success: function(result){

                    window.location = "/checkout"

                  }
              })
              }



          }
          else{
            alert("กรุณาเลือกร้านค้าที่ต้องการสั่งซื้อ");
          }
           }
         );
       });
       </script>

    @endif  <!-- End Cart page script  -->


   @if(Request::is('checkout'))
      <script type="text/javascript">
          $(document).ready(function (){

                $("input[name=billing-address-selection]").click(function() {
                    // show hide billing address base on customer choice
                    if ($(this).val() == "same") {
                        $(".billing-address-form").hide();
                        $(".shipping-billing-address").show();
                    }else{
                        $(".billing-address-form").show();
                        $(".shipping-billing-address").hide();

                    }
                });
            });
      </script>

      <script type="text/javascript">
      $(document).ready(function(){

        //Ajax for post code input to get province and district
              $('#BillingAddressPostalcode').keyup(function ()  {
                  if($("#BillingAddressPostalcode").val().length >= 5) {
                    $("select[name='thai_city_id']").find('option').remove();
                    var postal_code = $(this).val();
                    if(postal_code){
                      $.ajax({
                          type: "GET",
                          url: "/cart/getthaicity/"+postal_code,
                          datatype: "json",
                          success: function(data) {
                            if(data){
                              $.each(data, function(key, value) {
                                  $('select[name="thai_city_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                              });
                            }
                          }
                      }); //END $.ajax
                    }else{
                      $('select[name="thai_city_id"]').append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>');
                    }
                  }
                  else{
                    $("select[name='thai_city_id']").find('option').remove().end().append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>').val('');
                  }

              })}); //END province dropdown change event
      </script>

      <script type="text/javascript">
        $(document).ready(function(){

          /* when customer want to pay   */
          $("#place-order-button").on("click",function(){
            if($("input[name=billing-address-selection]:checked").val()=="notsame"){

              var firstname = $("input[name='firstname']").val();
              var lastname = $("input[name='lastname']").val();
              var address1 = $("input[name='address1']").val();
              var address2 = $("input[name='address2']").val();
              var thai_city_id = $("select[name='thai_city_id']").val();
              var thai_city = $("select[name='thai_city_id']").children("option").filter(":selected").text();
              var postal_code = $("input[name='postal_code']").val();
              var tel_number = $("input[name='tel_number']").val();

             var billing_address =
             {
                 "firstname":firstname,
                 "lastname":lastname,
                 "address1":address1,
                 "address2":address2,
                 "thai_city_id":thai_city_id,
                 "thai_city":thai_city,
                 "postal_code":postal_code,
                 "tel_number":tel_number
             }

             var has_billing = 1;


            }
            else{
              // clear billing address session (if dont have)
              var has_billing = 0;

            }

          @auth
          var order_email = "<?php echo Auth::user()->email; ?>";

          @endauth
          @guest
          function validateEmail(email) {
             var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
             return re.test(email);
            }

          var email = $("#guest-email").val();
          if (validateEmail(email)) {

            var order_email = email;

          } else {
            alert("กรุณากรอกอีเมลให้ถูกต้อง");
          }
          @endguest

          var order_note = $("textarea[name='order_note']").val();
          $.ajax({
              url: '/checkout/to-payment/',
              type: "GET",
              dataType: "json",
              data: {order_email,order_note, billing_address,has_billing},
               success: function(result){
                 if(result)
                 {
                       window.location = "/order-payment/"+result["id"]+"/"+result["order_hash"]+"/";
                  }

               }
           })

          })
      });
      </script>

    @endif

    @if(Request::is('messenger'))

    <script type="text/javascript">
      $(document).ready(function(){
        $('li.contact').click(function(){
          receiver_id = this.getAttribute("data-receiver-id");
          store_id = this.getAttribute("data-store-id");
           $('.chat-section').html("");
           $.ajax({
               url: '/messenger/getchatmessage/',
               type: "GET",
               dataType: "json",
               data: {receiver_id,store_id},
                success: function(result){

                   if(result.hasOwnProperty('receiver')){
                     $("#active-receiver-avatar").attr("src","images/"+result.receiver_photo);
                     $('#active-receiver-name').html(result.receiver_name);
                     $('#chat-icon').html('<a target="_blank" href="/user/'+result.receiver_username+'"><i class="fas fa-user"></i></a>');
                     $('#active-receiver-id').html(result.receiver_id);
                     $('#active-store-id').html('0');

                     $.each(result.messages, function(key, value) {
                          if (value.user_id==result.receiver_id) {
                            if(value.file){
                              $('.chat-section').append('<li class="sent chatmessage" data-message-id="'+value.messageID+'"><img src="images/'+result.receiver_photo+'" alt="" /><p>'+value.message+'<br><a href="/images/'+value.file+'" data-toggle="lightbox" data-gallery="product-gallery"><img style="display: block; width: 120px; height: 64px; object-fit: cover; border-radius: 0;" src="/images/'+value.file+'"></a></p></li>');
                            }else{
                              $('.chat-section').append('<li class="sent chatmessage" data-message-id="'+value.messageID+'"><img src="images/'+result.receiver_photo+'" alt="" /><p>'+value.message+'</p></li>');
                            }
                          }else{
                            if(value.file){
                              $('.chat-section').append('<li class="replies chatmessage" data-message-id="'+value.messageID+'"><img src="images/'+result.user_photo+'" alt="" /><p>'+value.message+'<br><a href="/images/'+value.file+'" data-toggle="lightbox" data-gallery="product-gallery"><img style="display: block; width: 120px; height: 64px; object-fit: cover; border-radius: 0;" src="/images/'+value.file+'"></a></p></li>');
                            }else{
                              $('.chat-section').append('<li class="replies chatmessage" data-message-id="'+value.messageID+'"><img src="images/'+result.user_photo+'" alt="" /><p>'+value.message+'</li>');
                            }
                          }
                      });
                   }
                   else{
                     // Chat with store
                     $("#active-receiver-avatar").attr("src","images/"+result.store_photo);
                     $('#active-receiver-name').html(result.store_name);
                     $('#chat-icon').html('<a target="_blank" href="/store/'+result.store_username+'"><i class="fas fa-store"></i></a>');
                     $('#active-receiver-id').html('0');
                     $('#active-store-id').html(result.store_id);

                     $.each(result.messages, function(key, value) {
                          if (value.user_id==result.store_id) {
                            if(value.file){
                              $('.chat-section').append('<li class="sent chatmessage" data-message-id="'+value.messageID+'"><img src="images/'+result.store_photo+'" alt="" /><p>'+value.message+'<br><a href="/images/'+value.file+'" data-toggle="lightbox" data-gallery="product-gallery"><img style="display: block; width: 120px; height: 64px; object-fit: cover; border-radius: 0;" src="/images/'+value.file+'"></a></p></li>');
                            }else{
                              $('.chat-section').append('<li class="sent chatmessage" data-message-id="'+value.messageID+'"><img src="images/'+result.store_photo+'" alt="" /><p>'+value.message+'</p></li>');
                            }
                          }else{
                            if(value.file){
                              $('.chat-section').append('<li class="replies chatmessage" data-message-id="'+value.messageID+'"><img src="images/'+result.user_photo+'" alt="" /><p>'+value.message+'<br><a href="/images/'+value.file+'" data-toggle="lightbox" data-gallery="product-gallery"><img style="display: block; width: 120px; height: 64px; object-fit: cover; border-radius: 0;" src="/images/'+value.file+'"></a></p></li>');
                            }else{
                              $('.chat-section').append('<li class="replies chatmessage" data-message-id="'+value.messageID+'"><img src="images/'+result.user_photo+'" alt="" /><p>'+value.message+'</p></li>');
                            }
                          }
                      });
                   }

                   $(".message-input-box").attr("data-conversation-id",result.conv_id);
                   $(".messages").scrollTop($(".messages")[0].scrollHeight);

                }
            })
        });



        $('.message-input-submit').click(function(e){
          e.preventDefault();
          conversation_id = $('body').find('input.message-input-box').attr("data-conversation-id");
          message = $('body').find('input.message-input-box').val();
          token = $('body').find('input[name="_token"]').val();
          var MessageFormData = new FormData();
          MessageFormData.append('_token', token);
          MessageFormData.append('_method', 'POST');
          MessageFormData.append('message', message);
          MessageFormData.append('conversation_id', conversation_id);
          MessageFormData.append('message_photos', $('body').find('input[type=file]')[0].files[0]);

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });



     if (xhr && xhr.readyState !== 400 && xhr.status !== 200) {
        xhr.abort();
    }

    var xhr = $.ajax({
        url: "/messenger/sendmessage",
        method: "POST",
        cache: false,
        data: MessageFormData,
        contentType: false,
        processData: false,

        success: function (data, textStatus, jqXHR) {
          $("#message-input").val("");
          $("#message-upload-photo-input").css("display", "none");
          var api = $.fileuploader.getInstance($('#message-photos'));
          api.reset();
          $(".fileuploader-thumbnails-input").css("display", "block");

        }

    });
          });
      });
    </script>



    <script type="text/javascript">
    $('document').ready(function () {
      setInterval(function () {getChatRealtimeData()}, 400);
      });

    function getChatRealtimeData() {
      last_message_id = $('body').find('li.chatmessage:last').attr("data-message-id");
      receiver_id = $('body').find('#active-receiver-id').text();
      store_id = $('body').find('#active-store-id').text();
      $.ajax({
             url: "/messenger/getnewchatmessage/",
             type: "GET",
             dataType: "json",
             data: {receiver_id,store_id,last_message_id},
             cache: false,
             success: function (result) {
               if(result.hasOwnProperty('receiver')){
                 $("#active-receiver-avatar").attr("src","images/"+result.receiver_photo);
                 $('#active-receiver-name').html(result.receiver_name);
                 $('#active-receiver-id').html(result.receiver_id);
                 $('#active-store-id').html('0');

                 $.each(result.messages, function(key, value) {
                      if (value.user_id==result.receiver_id) {
                        if(value.file){
                          $('.chat-section').append('<li class="sent chatmessage" id="message-'+value.messageID+'" data-message-id="'+value.messageID+'"><img src="images/'+result.receiver_photo+'" alt="" /><p>'+value.message+'<br><a href="/images/'+value.file+'" data-toggle="lightbox" data-gallery="product-gallery"><img style="display: block; width: 120px; height: 64px; object-fit: cover; border-radius: 0;" src="/images/'+value.file+'"></a></p></li>');
                        }else{
                          $('.chat-section').append('<li class="sent chatmessage" id="message-'+value.messageID+'" data-message-id="'+value.messageID+'"><img src="images/'+result.receiver_photo+'" alt="" /><p>'+value.message+'</p></li>');
                        }
                        $(".messages").scrollTop($(".messages")[0].scrollHeight);

                      }else{
                        if(value.file){
                          $('.chat-section').append('<li class="replies chatmessage" id="message-'+value.messageID+'" data-message-id="'+value.messageID+'"><img src="images/'+result.user_photo+'" alt="" /><p>'+value.message+'<br><a href="/images/'+value.file+'" data-toggle="lightbox" data-gallery="product-gallery"><img style="display: block; width: 120px; height: 64px; object-fit: cover; border-radius: 0;" src="/images/'+value.file+'"></a></p></li>');
                        }else{
                          $('.chat-section').append('<li class="replies chatmessage" id="message-'+value.messageID+'" data-message-id="'+value.messageID+'"><img src="images/'+result.user_photo+'" alt="" /><p>'+value.message+'</p></li>');
                        }
                        $(".messages").scrollTop($(".messages")[0].scrollHeight);
                      }
                  });
               }
               else{
                 $("#active-receiver-avatar").attr("src","images/"+result.store_photo);
                 $('#active-receiver-name').html(result.store_name);
                 $('#active-receiver-id').html('0');
                 $('#active-store-id').html(result.store_id);

                 $.each(result.messages, function(key, value) {
                      if (value.user_id==result.store_id) {
                        if(value.file){
                          $('.chat-section').append('<li class="sent chatmessage" id="message-'+value.messageID+'" data-message-id="'+value.messageID+'"><img src="images/'+result.store_photo+'" alt="" /><p>'+value.message+'<br><a href="/images/'+value.file+'" data-toggle="lightbox" data-gallery="product-gallery"><img style="display: block; width: 120px; height: 64px; object-fit: cover;border-radius: 0;" src="/images/'+value.file+'"></a></p></li>');
                        }else{
                          $('.chat-section').append('<li class="sent chatmessage" id="message-'+value.messageID+'" data-message-id="'+value.messageID+'"><img src="images/'+result.store_photo+'" alt="" /><p>'+value.message+'</p></li>');
                        }
                        $(".messages").scrollTop($(".messages")[0].scrollHeight);
                      }else{
                        if(value.file){
                          $('.chat-section').append('<li class="replies chatmessage" id="message-'+value.messageID+'"  data-message-id="'+value.messageID+'"><img src="images/'+result.user_photo+'" alt="" /><p>'+value.message+'<br><a href="/images/'+value.file+'" data-toggle="lightbox" data-gallery="product-gallery"><img style="display: block; width: 120px; height: 64px; object-fit: cover;border-radius: 0;" src="/images/'+value.file+'"></a></p></li>');
                        }else{
                          $('.chat-section').append('<li class="replies chatmessage" id="message-'+value.messageID+'"  data-message-id="'+value.messageID+'"><img src="images/'+result.user_photo+'" alt="" /><p>'+value.message+'</p></li>');
                        }
                        $(".messages").scrollTop($(".messages")[0].scrollHeight);
                      }
                  });

               }

             }
         })
      }
    </script>

    <script type="text/javascript">
      function showMessageUploadPhotoInput(){
        var message_upload_photo = document.getElementById("message-upload-photo-input");
        if (message_upload_photo.style.display === "none") {
          message_upload_photo.style.display = "block";
          $(".fileuploader-thumbnails-input").css("display", "block");
        } else {
          message_upload_photo.style.display = "none";
          var api = $.fileuploader.getInstance($('#message-photos'));
          api.reset();
        }
       }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name="message_photos"]').fileuploader({
                     extensions: null,
                changeInput: ' ',
                theme: 'thumbnails',
                     enableApi: true,
                limit:1,
                addMore: true,
                thumbnails: {
                  box: '<div class="fileuploader-items">' +
                                   '<ul class="fileuploader-items-list">' +
                            '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                                   '</ul>' +
                               '</div>',
                  item: '<li class="fileuploader-item file-has-popup">' +
                           '<div class="fileuploader-item-inner">' +
                                        '<div class="type-holder">${extension}</div>' +
                                        '<div class="actions-holder">' +
                               '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                        '</div>' +
                                        '<div class="thumbnail-holder">' +
                                            '${image}' +
                                            '<span class="fileuploader-action-popup"></span>' +
                                        '</div>' +
                                        '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                                         '<div class="progress-holder">${progressBar}</div>' +
                                    '</div>' +
                               '</li>',
                  item2: '<li class="fileuploader-item file-has-popup">' +
                           '<div class="fileuploader-item-inner">' +
                                        '<div class="type-holder">${extension}</div>' +
                                        '<div class="actions-holder">' +
                               '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
                               '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                        '</div>' +
                                        '<div class="thumbnail-holder">' +
                                            '${image}' +
                                            '<span class="fileuploader-action-popup"></span>' +
                                        '</div>' +
                                        '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                                         '<div class="progress-holder">${progressBar}</div>' +
                                    '</div>' +
                                '</li>',
                  startImageRenderer: true,
                         canvasImage: false,
                  _selectors: {
                    list: '.fileuploader-items-list',
                    item: '.fileuploader-item',
                    start: '.fileuploader-action-start',
                    retry: '.fileuploader-action-retry',
                    remove: '.fileuploader-action-remove'
                  },
                  onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                    var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                                 api = $.fileuploader.getInstance(inputEl.get(0));

                             plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();

                    if(item.format == 'image') {
                      item.html.find('.fileuploader-item-icon').hide();
                    }
                  },
                         onItemRemove: function(html, listEl, parentEl, newInputEl, inputEl) {
                             var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                        api = $.fileuploader.getInstance(inputEl.get(0));

                             html.children().animate({'opacity': 0}, 200, function() {
                                 html.remove();

                                 if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit)
                                     plusInput.show();
                             });
                         }
                },
                     dragDrop: {
                  container: '.fileuploader-thumbnails-input'
                },
                afterRender: function(listEl, parentEl, newInputEl, inputEl) {
                  var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                    api = $.fileuploader.getInstance(inputEl.get(0));

                  plusInput.on('click', function() {
                    api.open();
                  });
                },

            });
        });
    </script>

    @endif


    @if(Request::is('product/*'))
      <script type="text/javascript">
          $(document).ready(function(){

            $('.shippingradiogroup').click(function(){

              if($(this).find('input[name=variation_photo]').val()){
              //Show variation photo if available
               var variation_photo = "/images/"+$(this).find('input[name=variation_photo]').val();
               $('#img-product-photo').attr('src', variation_photo);
               }



               //Show product price
               var product_variation_id = $(this).find('input[name=product_variation_id]').val();
               $.ajax({
                   url: '/cart/getproductvariationprice/',
                   type: "GET",
                   dataType: "json",
                   data: {product_variation_id},
                    success: function(result){
                      console.log(result[0]['discount_price']);
                      if((result[0]['discount_price']=='NULL')||(result[0]['discount_price']=='')||(result[0]['discount_price']<='0')){
                        $('div.variation-product-price').html("<div class='h5 mt-3'>ราคาของรูปแบบนี้ : <span class='text-red'>"+result[0]['price']+" ฿</span>");
                      }
                      else{
                        $('div.variation-product-price').html("<div class='h5 mt-3'>ราคาของรูปแบบนี้ : <span class='text-red'>"+result[0]['discount_price']+" ฿</span> <small class='text-muted'><del>ปกติ "+result[0]['price']+" ฿</del></small>");
                      }
                    }
                })

                // Show variation product stock
                $.ajax({
                    url: '/cart/geteachproductvariationstock/',
                    type: "GET",
                    dataType: "json",
                    data: {product_variation_id},
                     success: function(result){
                       $('.stock').html("จำนวนในสต็อกของรูปแบบนี้ <strong>"+result+"</strong> ชิ้น");
                     }
                 })

            });
          });
      </script>
      <script type="text/javascript">
        rateStyleJQ(rating, 'product-rating');
        // jquery
        function rateStyleJQ(num, divID) {
        var ratingRounded = Math.floor(num);
        $("#"+divID+" .star-over").slice(0, ratingRounded).addClass('star-visible');
          var partialShade = Math.round((num-ratingRounded)*100);
          if (partialShade!= 0) {
          $($("#"+divID+" .star-over").get(ratingRounded)).addClass('star-visible').css("width", partialShade+"%");
        }
        }
      </script>

      <script type="text/javascript">
        $(document).ready(function(){
          $('#store-open').tooltip()
          $('#send-message-to-store').tooltip()
        });
      </script>
    @endif  <!-- End Product page script  -->


    @if(Request::is('service/*'))
      <script type="text/javascript">
          $(document).ready(function(){
            $('#show-seller-contact').click(function(){

              swal.fire({
                imageUrl: '/images/{{$service->store->photo->file}}',
                imageWidth: 100,
                imageHeight: 100,
                        html:
                          'คุณกำลังติดต่อกับร้าน {{$service->store->name}} ซึ่งเป็นเจ้าของบริการ <b>{{$service->name}}</b><br><br>สามารถติดต่อโดยตรงได้ที่...<br>' +
                          '<i class="fas fa-phone"></i> {{$service->store->tel_number}}<br>' +
                          '<i class="fab fa-facebook-square"></i> <a href="{{$service->store->facebook_page_link}}" target="_blank">{{$service->store->facebook_page_link}}</a><br>' +
                          '<i class="fas fa-globe"></i> <a href="{{$service->store->website}}" target="_blank">{{$service->store->website}}</a><br>' +
                          '<br><small>(นี่เป็นการติดต่อระหว่างผู้ซื้อ-ผู้ขายโดยตรง การโอนเงินให้กับทางร้านอาจมีความเสี่ยง ทาง DECORIQ ไม่มีความคุ้มครองในส่วนนี้ คำแนะนำของเราคือให้ผู้ซื้อนัดเจอกับร้านเพื่อป้องกันความเสี่ยงนี้)</small>',
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText:
                          'X ปิดป็อปอัพนี้!',
                        })


              });
            });
      </script>
    @endif  <!-- End Service page script  -->



    @if(Request::is('dashboard/*'))

    <script type="text/javascript">
    $(document).ready(function(){
      //Ajax for post code input to get province and district (Dashboard's edit modal)
            $('#ShippingAddressPostalcode').keyup(function ()  {
                if($("#ShippingAddressPostalcode").val().length >= 5) {
                  $("select[name='thai_city_id']").find('option').remove();
                  var postal_code = $(this).val();
                  if(postal_code){
                    $.ajax({
                        type: "GET",
                        url: "/cart/getthaicity/"+postal_code,
                        datatype: "json",
                        success: function(data) {
                          if(data){
                            $.each(data, function(key, value) {
                                $('select[name="thai_city_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                          }
                        }
                    }); //END $.ajax
                  }else{
                    $('select[name="thai_city_id"]').append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>');
                  }
                }
                else{
                  $("select[name='thai_city_id']").find('option').remove().end().append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>').val('');
                }

            })}); //END province dropdown change event
    </script>

    <script type="text/javascript">
    /* edit address modal */
        $(document).on("click", ".openeditshippingmodal", function () {
              var address_id = $(this).data('address-id')
              var firstname = $(this).data('firstname');
              var lastname = $(this).data('lastname');
              var address1 = $(this).data('address1');
              var address2 = $(this).data('address2');
              var postal_code = $(this).data('postal_code');
              var thai_city_id  = $(this).data('thai_city_id');
              var tel_number  = $(this).data('tel_number');


              $(".modal-body #ShippingAddressAddressIdEdit").val( address_id );
              $(".modal-body #ShippingAddressFirstnameEdit").val( firstname );
              $(".modal-body #ShippingAddressLastnameEdit").val( lastname );
              $(".modal-body #ShippingAddressAddress1Edit").val( address1 );
              $(".modal-body #ShippingAddressAddress2Edit").val( address2 );
              $(".modal-body #ShippingAddressPostalcodeEdit").val( postal_code );
              $(".modal-body #ShippingAddressTelNumberEdit").val( tel_number );

              /* get thai city province on edit modal */
                  if($("#ShippingAddressPostalcodeEdit").val().length >= 5) {
                    $("select[name='thai_city_idEdit']").find('option').remove();
                    if(postal_code){
                      $.ajax({
                          type: "GET",
                          url: "/cart/getthaicity/"+postal_code,
                          datatype: "json",
                          success: function(data) {
                            if(data){
                              $.each(data, function(key, value) {
                                  $('select[name="thai_city_idEdit"]').append('<option value="'+ key +'">'+ value +'</option>');
                              });
                            }
                          } //END success fn
                      }); //END $.ajax
                    }else{
                      $('select[name="thai_city_idEdit"]').append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>');
                    }
                  }
                  else{
                    $("select[name='thai_city_idEdit']").find('option').remove().end().append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>').val('');
                  }

                  setTimeout('$(".modal-body #thai_cityEdit").val( '+thai_city_id+' )',300)

                });

           $(document).ready(function(){
               $('#ShippingAddressPostalcodeEdit').keyup(function ()  {
                   if($("#ShippingAddressPostalcodeEdit").val().length >= 5) {
                     $("select[name='thai_city_idEdit']").find('option').remove();
                     var postal_code = $(this).val();
                     if(postal_code){
                       $.ajax({
                           type: "GET",
                           url: "/cart/getthaicity/"+postal_code,
                           datatype: "json",
                           success: function(data) {
                             if(data){
                               $.each(data, function(key, value) {
                                   $('select[name="thai_city_idEdit"]').append('<option value="'+ key +'">'+ value +'</option>');
                               });
                             }
                           } //END success fn
                       }); //END $.ajax
                     }else{
                       $('select[name="thai_city_idEdit"]').append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>');
                     }
                   }
                   else{
                     $("select[name='thai_city_idEdit']").find('option').remove().end().append('<option value="">กรุณาใส่รหัสไปรษณีย์</option>').val('');
                   }
               })});

      </script>


      <!-- delete address -->
      <script type="text/javascript">
            function deleteAddress(i,address_id){
              if (confirm("คุณต้องการจะลบที่อยู่ "+i+" นี้ ใช้หรือไม่?")) {
                $.ajax({
                    type: "GET",
                    url: "/cart/deleteaddress/"+address_id,
                    datatype: "text",
                    success: function(data) {
                      alert("เราได้ทำการลบที่อยู่นี้เรียบร้อยแล้ว");
                      location.reload();
                      }
                     //END success fn
                }); //END $.ajax
              }
            };
       </script>




    @endif

    @if(Request::is('dashboard'))
    <!-- show status message form and hide message -->
    <script type="text/javascript">
      function editStatusMessage(){
        $("#status_message").hide();
        $("#status_message_form").css("display", "block");

      };

      function hideEditStatusMessageForm(){
        $("#status_message").show();
        $("#status_message_form").css("display", "none");
      }
    </script>
    @endif


    @if(Request::is('dashboard/order/*') || Request::is('guest-order/*/*/detail'))

    <!--  Confirm receive product  -->

    <script type="text/javascript">
     $(document).ready(function(){
       $('#received-confirmation-button').click(function(){
         var order_id = <?php echo $order->id ?>;
         swal.fire({
             title: 'คุณได้รับสินค้านี้แล้วใช่ไหม?',
             text: "ถ้าคุณได้รับสินค้านี้แล้ว ทางเราจะโอนเงินไปยังผู้ขายสินค้า",
             type: 'question',
             showCancelButton: true,
             confirmButtonColor: '#4caf50',
             cancelButtonColor: '#d33',
             confirmButtonText: 'ใช่, ฉันได้รับแล้ว',
             cancelButtonText: 'ยังไม่ได้รับ',
           }).then((result) => {
             if (result.value) {
               swal.fire(
                 'คุณรับสินค้าเรียบร้อยแล้ว!',
                 'ขอบคุณที่ซื้อสินค้าจากเรา เรามีความยินดีที่จะให้บริการคุณในโอกาสต่อไป',
                 'success'
               )
               $.ajax({
               url: '/dashboard/order/setorderreceived/{{$order->id}}/',
               type: "GET",
               dataType: "json",
               success:function(data) {
                  setTimeout(function() {document.location.reload(true)}, 2000);
                    }
                    });
             }
           })
         });
       });
    </script>

    <script type="text/javascript">
     $(document).ready(function(){
       $('#extend-button').click(function(){
         swal.fire({
             title: 'คุณต้องการขยายเวลา?',
             text: "คุณยังไม่ได้รับสินค้าจากรายการสั่งซื้อนี้<br>และต้องการขยายเวลาใช่หรือไม่?",
             type: 'question',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'ใช่, ฉันต้องการขยายเวลา',
             cancelButtonText: 'ไม่ต้องการ',
           }).then((result) => {
             if (result.value) {
               swal.fire(
                 'ขยายเวลาสำเร็จแล้ว!',
                 'ระยะเวลาของรายการสั่งซื้อได้รับการขยายแล้ว',
                 'success'
               )
             }
           })
         });
       });
    </script>

    @endif

    @if(Request::is('dashboard/service-order/*'))

    <!--  Confirm receive product  -->

    <script type="text/javascript">
     $(document).ready(function(){
       $('#received-confirmation-button').click(function(){
         var order_id = <?php echo $service_order->id ?>;
         swal.fire({
             title: 'คุณได้รับสินค้านี้แล้วใช่ไหม?',
             text: "ถ้าคุณได้รับสินค้านี้แล้ว ทางเราจะโอนเงินไปยังผู้ขายสินค้า",
             type: 'question',
             showCancelButton: true,
             confirmButtonColor: '#4caf50',
             cancelButtonColor: '#d33',
             confirmButtonText: 'ใช่, ฉันได้รับแล้ว',
             cancelButtonText: 'ยังไม่ได้รับ',
           }).then((result) => {
             if (result.value) {
               swal.fire(
                 'คุณรับสินค้าเรียบร้อยแล้ว!',
                 'ขอบคุณที่ซื้อสินค้าจากเรา เรามีความยินดีที่จะให้บริการคุณในโอกาสต่อไป',
                 'success'
               )
               $.ajax({
               url: '/dashboard/order/setorderreceived/{{$service_order->id}}/',
               type: "GET",
               dataType: "json",
               success:function(data) {
                  setTimeout(function() {document.location.reload(true)}, 2000);
                    }
                    });
             }
           })
         });
       });
    </script>

    <script type="text/javascript">
     $(document).ready(function(){
       $('#extend-button').click(function(){
         swal.fire({
             title: 'คุณต้องการขยายเวลา?',
             text: "คุณยังไม่ได้รับสินค้าจากรายการสั่งซื้อนี้<br>และต้องการขยายเวลาใช่หรือไม่?",
             type: 'question',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'ใช่, ฉันต้องการขยายเวลา',
             cancelButtonText: 'ไม่ต้องการ',
           }).then((result) => {
             if (result.value) {
               swal.fire(
                 'ขยายเวลาสำเร็จแล้ว!',
                 'ระยะเวลาของรายการสั่งซื้อได้รับการขยายแล้ว',
                 'success'
               )
             }
           })
         });
       });
    </script>

    @endif

    @if(Request::is('dashboard/review/*') or Request::is('dashboard/service-review/*') or Request::is('guest-order/*/*/review'))

      <script type="text/javascript">
      // enable fileuploader plugin
      $('input[class="review-photos"]').fileuploader({
         extensions: null,
         changeInput: ' ',
         theme: 'thumbnails',
         limit: '3',
         enableApi: true,
         addMore: true,
         thumbnails: {
         box: '<div class="fileuploader-items">' +
                       '<ul class="fileuploader-items-list">' +
                 '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                       '</ul>' +
                   '</div>',
         item: '<li class="fileuploader-item file-has-popup">' +
                '<div class="fileuploader-item-inner">' +
                            '<div class="type-holder">${extension}</div>' +
                            '<div class="actions-holder">' +
                            '<a class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i></i></a>' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                            '</div>' +
                            '<div class="thumbnail-holder">' +
                                '${image}' +
                                '<span class="fileuploader-action-popup"></span>' +
                            '</div>' +
                            '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                            '<div class="progress-holder">${progressBar}</div>' +
                        '</div>' +
                   '</li>',
          item2: '<li class="fileuploader-item file-has-popup">' +
                '<div class="fileuploader-item-inner">' +
                            '<div class="type-holder">${extension}</div>' +
                            '<div class="actions-holder">' +
                    '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
                    '<a class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i></i></a>' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                            '</div>' +
                            '<div class="thumbnail-holder">' +
                                '${image}' +
                                '<span class="fileuploader-action-popup"></span>' +
                            '</div>' +
                            '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                            '<div class="progress-holder">${progressBar}</div>' +
                        '</div>' +
                    '</li>',
                   startImageRenderer: true,
             canvasImage: false,
       _selectors: {
         list: '.fileuploader-items-list',
         item: '.fileuploader-item',
         start: '.fileuploader-action-start',
         retry: '.fileuploader-action-retry',
         remove: '.fileuploader-action-remove'
       },
       onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
         var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                     api = $.fileuploader.getInstance(inputEl.get(0));

                 plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();

         if(item.format == 'image') {
           item.html.find('.fileuploader-item-icon').hide();
         }
       }
      },
         dragDrop: {
       container: '.fileuploader-thumbnails-input'
      },
      afterRender: function(listEl, parentEl, newInputEl, inputEl) {
       var plusInput = listEl.find('.fileuploader-thumbnails-input'),
         api = $.fileuploader.getInstance(inputEl.get(0));

       plusInput.on('click', function() {
         api.open();
       });
      },
         onRemove: function(item, listEl, parentEl, newInputEl, inputEl) {
             var plusInput = listEl.find('.fileuploader-thumbnails-input'),
         api = $.fileuploader.getInstance(inputEl.get(0));

       if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit)
                 plusInput.show();
         },
       sorter: {
       selectorExclude: null,
       placeholder: null,
       scrollContainer: window,
       onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                 var api = $.fileuploader.getInstance(inputEl.get(0)),
                     fileList = api.getFileList(),
                     _list = [];

                 $.each(fileList, function(i, item) {
                     _list.push({
                         name: item.name,
                         index: item.index
                     });
                 });

                 $.post('php/ajax_sort_files.php', {
                     _list: JSON.stringify(_list)
                 });
             }
           },
               onRemove: function(item) {
             $.post('php/ajax_remove_file.php', {
               file: item.name
             });
           }

            });
             </script>
    @endif



        @if(Request::is('dashboard/settings/*'))
          <script type="text/javascript">
          $(document).ready(function() {

          	// enable fileupload plugin
          	$('input[id="profilephoto"]').fileuploader({
          		limit: 1,
                  extensions: ['jpg', 'jpeg', 'png', 'gif'],
          		changeInput: ' ',
          		theme: 'thumbnails',
                  enableApi: true,
          		addMore: false,
          		thumbnails: {
          			box: '<div class="fileuploader-items">' +
                                '<ul class="fileuploader-items-list">' +
          					      '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                                '</ul>' +
                            '</div>',
          			item: '<li class="fileuploader-item file-has-popup">' +
          				       '<div class="fileuploader-item-inner">' +
                                     '<div class="type-holder">${extension}</div>' +
                                     '<div class="actions-holder">' +
          						   	   '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                     '</div>' +
                                     '<div class="thumbnail-holder">' +
                                         '${image}' +
                                         '<span class="fileuploader-action-popup"></span>' +
                                     '</div>' +
                                     '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                                 	   '<div class="progress-holder">${progressBar}</div>' +
                                 '</div>' +
                            '</li>',
          			item2: '<li class="fileuploader-item file-has-popup">' +
          				       '<div class="fileuploader-item-inner">' +
                                     '<div class="type-holder">${extension}</div>' +
                                     '<div class="actions-holder">' +
          						   	   '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
          						   	   '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                     '</div>' +
                                     '<div class="thumbnail-holder">' +
                                         '${image}' +
                                         '<span class="fileuploader-action-popup"></span>' +
                                     '</div>' +
                                     '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                                 	   '<div class="progress-holder">${progressBar}</div>' +
                                 '</div>' +
                             '</li>',
          			startImageRenderer: true,
                      canvasImage: true,
          			_selectors: {
          				list: '.fileuploader-items-list',
          				item: '.fileuploader-item',
          				start: '.fileuploader-action-start',
          				retry: '.fileuploader-action-retry',
          				remove: '.fileuploader-action-remove'
          			},
                removeConfirmation: false,





          			onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
          				var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                              api = $.fileuploader.getInstance(inputEl.get(0));

                          plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'hide']();

          				if(item.format == 'image') {
          					item.html.find('.fileuploader-item-icon').hide();

                              if (!item.html.find('.fileuploader-action-edit').length)
                                  item.html.find('.fileuploader-action-remove').before('<a class="fileuploader-action fileuploader-action-popup fileuploader-action-edit" title="Edit"><i></i></a>');
          				}
          			},
          			onItemRemove: function(html, listEl, parentEl, newInputEl, inputEl) {
          				var plusInput = listEl.find('.fileuploader-thumbnails-input'),
          					api = $.fileuploader.getInstance(inputEl.get(0));

                          html.children().animate({'opacity': 0}, 200, function() {
                              setTimeout(function() {
                                  html.remove();

          						if(api.getFiles().length - 1 < api.getOptions().limit) {
          							plusInput.show();
          						}
                              }, 100);
                          });

                      }
          		},
                  dragDrop: {
          			container: '.fileuploader-thumbnails-input'
          		},
                  editor: {
                      cropper: {
          				ratio: '1:1',
          				minWidth: 400,
          				minHeight: 400,
          				showGrid: true
          			}
                  },
          		afterRender: function(listEl, parentEl, newInputEl, inputEl) {
          			var plusInput = listEl.find('.fileuploader-thumbnails-input'),
          				api = $.fileuploader.getInstance(inputEl.get(0));

          			plusInput.on('click', function() {
          				api.open();
          			});
          		}
              });


          });
          </script>

          <script type="text/javascript">
          $(document).ready(function() {

            	// enable fileupload plugin
            	$('input[id=coverphoto]').fileuploader({
            		limit: 1,
                    extensions: ['jpg', 'jpeg', 'png', 'gif'],
            		changeInput: ' ',
            		theme: 'thumbnails',
                    enableApi: true,
            		addMore: false,
            		thumbnails: {
            			box: '<div class="fileuploader-items">' +
                                  '<ul class="fileuploader-items-list">' +
            					      '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                                  '</ul>' +
                              '</div>',
            			item: '<li class="fileuploader-item file-has-popup">' +
            				       '<div class="fileuploader-item-inner">' +
                                       '<div class="type-holder">${extension}</div>' +
                                       '<div class="actions-holder">' +
            						   	   '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                       '</div>' +
                                       '<div class="thumbnail-holder">' +
                                           '${image}' +
                                           '<span class="fileuploader-action-popup"></span>' +
                                       '</div>' +
                                       '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                                   	   '<div class="progress-holder">${progressBar}</div>' +
                                   '</div>' +
                              '</li>',
            			item2: '<li class="fileuploader-item file-has-popup">' +
            				       '<div class="fileuploader-item-inner">' +
                                       '<div class="type-holder">${extension}</div>' +
                                       '<div class="actions-holder">' +
            						   	   '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
            						   	   '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                       '</div>' +
                                       '<div class="thumbnail-holder">' +
                                           '${image}' +
                                           '<span class="fileuploader-action-popup"></span>' +
                                       '</div>' +
                                       '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                                   	   '<div class="progress-holder">${progressBar}</div>' +
                                   '</div>' +
                               '</li>',
            			startImageRenderer: true,
                        canvasImage: true,
            			_selectors: {
            				list: '.fileuploader-items-list',
            				item: '.fileuploader-item',
            				start: '.fileuploader-action-start',
            				retry: '.fileuploader-action-retry',
            				remove: '.fileuploader-action-remove'
            			},
                  removeConfirmation: false,


            			onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
            				var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                                api = $.fileuploader.getInstance(inputEl.get(0));

                            plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'hide']();

            				if(item.format == 'image') {
            					item.html.find('.fileuploader-item-icon').hide();

                                if (!item.html.find('.fileuploader-action-edit').length)
                                    item.html.find('.fileuploader-action-remove').before('<a class="fileuploader-action fileuploader-action-popup fileuploader-action-edit" title="Edit"><i></i></a>');
            				}
            			},
            			onItemRemove: function(html, listEl, parentEl, newInputEl, inputEl) {
            				var plusInput = listEl.find('.fileuploader-thumbnails-input'),
            					api = $.fileuploader.getInstance(inputEl.get(0));

                            html.children().animate({'opacity': 0}, 200, function() {
                                setTimeout(function() {
                                    html.remove();

            						if(api.getFiles().length - 1 < api.getOptions().limit) {
            							plusInput.show();
            						}
                                }, 100);
                            });

                        }
            		},
                    dragDrop: {
            			container: '.fileuploader-thumbnails-input'
            		},
                    editor: {
                        cropper: {
            				ratio: '3:1',
            				minWidth: 1024,
            				minHeight: 341,
            				showGrid: true
            			}
                    },
            		afterRender: function(listEl, parentEl, newInputEl, inputEl) {
            			var plusInput = listEl.find('.fileuploader-thumbnails-input'),
            				api = $.fileuploader.getInstance(inputEl.get(0));

            			plusInput.on('click', function() {
            				api.open();
            			});
            		}
                });


            });
          </script>

        @endif


       @if(Request::is('user/*'))
        <script type="text/javascript">

          function change_follow_btn(){
            $('.follow').removeClass("btn-success");
            $('.follow').addClass("btn-danger");
            $('.follow').html("<i class='fa fa-times' aria-hidden='true'></i> เลิกติดตาม");
          }

          function normal_follow_btn(){
            $('.follow').removeClass("btn-danger");
            $('.follow').addClass("btn-success");
            $('.follow').html("<i class='fa fa-check' aria-hidden='true'></i> ติดตามแล้ว");
          }

        </script>

        <script type="text/javascript">
          function showCommentform($post_id) {
            var x = document.getElementById("post-"+$post_id);
            if (x.style.display === "none") {
              x.style.display = "block";
            } else {
              x.style.display = "none";
            }
           }
        </script>

        <script type="text/javascript">
          function showPostUploadPhotoInput(){
            var x = document.getElementById("post-upload-photo-input");
            if (x.style.display === "none") {
              x.style.display = "block";
            } else {
              x.style.display = "none";
            }
           }
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('input[name="post_photos"]').fileuploader({
                         extensions: null,
                    changeInput: ' ',
                    theme: 'thumbnails',
                         enableApi: true,
                    limit:8,
                    addMore: true,
                    thumbnails: {
                      box: '<div class="fileuploader-items">' +
                                       '<ul class="fileuploader-items-list">' +
                                '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                                       '</ul>' +
                                   '</div>',
                      item: '<li class="fileuploader-item file-has-popup">' +
                               '<div class="fileuploader-item-inner">' +
                                            '<div class="type-holder">${extension}</div>' +
                                            '<div class="actions-holder">' +
                                   '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                            '</div>' +
                                            '<div class="thumbnail-holder">' +
                                                '${image}' +
                                                '<span class="fileuploader-action-popup"></span>' +
                                            '</div>' +
                                            '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                                             '<div class="progress-holder">${progressBar}</div>' +
                                        '</div>' +
                                   '</li>',
                      item2: '<li class="fileuploader-item file-has-popup">' +
                               '<div class="fileuploader-item-inner">' +
                                            '<div class="type-holder">${extension}</div>' +
                                            '<div class="actions-holder">' +
                                   '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
                                   '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                            '</div>' +
                                            '<div class="thumbnail-holder">' +
                                                '${image}' +
                                                '<span class="fileuploader-action-popup"></span>' +
                                            '</div>' +
                                            '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                                             '<div class="progress-holder">${progressBar}</div>' +
                                        '</div>' +
                                    '</li>',
                      startImageRenderer: true,
                             canvasImage: false,
                      _selectors: {
                        list: '.fileuploader-items-list',
                        item: '.fileuploader-item',
                        start: '.fileuploader-action-start',
                        retry: '.fileuploader-action-retry',
                        remove: '.fileuploader-action-remove'
                      },
                      onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                        var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                                     api = $.fileuploader.getInstance(inputEl.get(0));

                                 plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();

                        if(item.format == 'image') {
                          item.html.find('.fileuploader-item-icon').hide();
                        }
                      },
                             onItemRemove: function(html, listEl, parentEl, newInputEl, inputEl) {
                                 var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                            api = $.fileuploader.getInstance(inputEl.get(0));

                                 html.children().animate({'opacity': 0}, 200, function() {
                                     html.remove();

                                     if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit)
                                         plusInput.show();
                                 });
                             }
                    },
                         dragDrop: {
                      container: '.fileuploader-thumbnails-input'
                    },
                    afterRender: function(listEl, parentEl, newInputEl, inputEl) {
                      var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                        api = $.fileuploader.getInstance(inputEl.get(0));

                      plusInput.on('click', function() {
                        api.open();
                      });
                    },

                });
            });
        </script>

       @endif

       @if(Request::is('store/*'))
       <script type="text/javascript">
         function showCommentform($post_id) {
           var x = document.getElementById("post-"+$post_id);
           if (x.style.display === "none") {
             x.style.display = "block";
           } else {
             x.style.display = "none";
           }
          }
       </script>

       <script type="text/javascript">
         function showPostUploadPhotoInput(){
           var x = document.getElementById("post-upload-photo-input");
           if (x.style.display === "none") {
             x.style.display = "block";
           } else {
             x.style.display = "none";
           }
          }
       </script>

       <script type="text/javascript">
           $(document).ready(function() {
               $('input[name="post_photos"]').fileuploader({
                        extensions: null,
                   changeInput: ' ',
                   theme: 'thumbnails',
                        enableApi: true,
                   limit:8,
                   addMore: true,
                   thumbnails: {
                     box: '<div class="fileuploader-items">' +
                                      '<ul class="fileuploader-items-list">' +
                               '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                                      '</ul>' +
                                  '</div>',
                     item: '<li class="fileuploader-item file-has-popup">' +
                              '<div class="fileuploader-item-inner">' +
                                           '<div class="type-holder">${extension}</div>' +
                                           '<div class="actions-holder">' +
                                  '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                           '</div>' +
                                           '<div class="thumbnail-holder">' +
                                               '${image}' +
                                               '<span class="fileuploader-action-popup"></span>' +
                                           '</div>' +
                                           '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                                            '<div class="progress-holder">${progressBar}</div>' +
                                       '</div>' +
                                  '</li>',
                     item2: '<li class="fileuploader-item file-has-popup">' +
                              '<div class="fileuploader-item-inner">' +
                                           '<div class="type-holder">${extension}</div>' +
                                           '<div class="actions-holder">' +
                                  '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
                                  '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                           '</div>' +
                                           '<div class="thumbnail-holder">' +
                                               '${image}' +
                                               '<span class="fileuploader-action-popup"></span>' +
                                           '</div>' +
                                           '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                                            '<div class="progress-holder">${progressBar}</div>' +
                                       '</div>' +
                                   '</li>',
                     startImageRenderer: true,
                            canvasImage: false,
                     _selectors: {
                       list: '.fileuploader-items-list',
                       item: '.fileuploader-item',
                       start: '.fileuploader-action-start',
                       retry: '.fileuploader-action-retry',
                       remove: '.fileuploader-action-remove'
                     },
                     onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                       var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                                    api = $.fileuploader.getInstance(inputEl.get(0));

                                plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();

                       if(item.format == 'image') {
                         item.html.find('.fileuploader-item-icon').hide();
                       }
                     },
                            onItemRemove: function(html, listEl, parentEl, newInputEl, inputEl) {
                                var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                           api = $.fileuploader.getInstance(inputEl.get(0));

                                html.children().animate({'opacity': 0}, 200, function() {
                                    html.remove();

                                    if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit)
                                        plusInput.show();
                                });
                            }
                   },
                        dragDrop: {
                     container: '.fileuploader-thumbnails-input'
                   },
                   afterRender: function(listEl, parentEl, newInputEl, inputEl) {
                     var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                       api = $.fileuploader.getInstance(inputEl.get(0));

                     plusInput.on('click', function() {
                       api.open();
                     });
                   },

               });
           });
       </script>

       @endif

       @if(Request::is('service/messages/*'))
               <script type="text/javascript">
                 $(document).ready(function(){
                   var element = document.getElementById("message-conversation-div");
                    element.scrollTop = element.scrollHeight;
                 });
               </script>

               <script type="text/javascript">
                 $('.message-input-submit').click(function(){
                   service_id = $('body').find('input.service-id').val();
                   conversation_id = $('body').find('input.conversation-id').val();
                   store_username = $('body').find('input.store-username').val();
                   message = $('body').find('input.message-input-box').val();
                   if(message!=""){
                     $.ajax({
                         url: "/service/messages/"+conversation_id+"/sendmessage",
                         type: "GET",
                         dataType: "json",
                         data: {service_id,conversation_id,store_username,message},
                          success: function(result){
                            $('body').find('input.message-input-box').val('');
                          }
                     });
                   }
                   });
               </script>

               <script type="text/javascript">
               $('document').ready(function () {
                 setInterval(function () {getChatRealtimeData()}, 200);//request every x seconds
                 });

               function getChatRealtimeData() {
                 last_message_id = $('body').find('li.chatmessage:last').attr("data-message-id");
                 conversation_id = $('body').find('input.conversation-id').val();
                 store_username = $('body').find('input.store-username').val();

                 $.ajax({
                        url: "/service/messages/"+conversation_id+"/getnewchatmessage",
                        type: "GET",
                        dataType: "json",
                        data: {last_message_id,conversation_id},
                        cache: false,
                        success: function (result) {

                          $.each(result.messages, function(key, value) {
                            if(result['isstoreowner']==false){
                              if(result.firstname==''){
                                var name = result.name;
                              }else{
                                var name = result.firstname+' '+result.lastname;
                              }
                              $('.chat-section').append('<li class="chatmessage" data-message-id="'+value.id+'" data-user-id="'+value.user_id+'"> <div class="w-80 p-3"> <div class="row"> <div class="col-1 text-right"> <img class="rounded-circle d-inline" style="width: 30px; height: 30px; border:lightgray 1px solid; object-fit: cover;" src="/images/'+result.user_photo+'"> </div> <div class="col-11  bg-gray p-3"> <strong><span class="d-inline">'+name+'</span> </strong> <br> '+value.message+' </div> </div> </div> </li>');
                              var element = document.getElementById("message-conversation-div");
                               element.scrollTop = element.scrollHeight;
                            }else{
                              $('.chat-section').append('<li class="chatmessage" data-message-id="'+value.id+'" data-user-id="'+value.user_id+'"> <div class="w-80 p-2"> <div class="row"> <div class="col-1 text-right"> <img class="rounded-circle d-inline" style="width: 30px; height: 30px; border:lightgray 1px solid; object-fit: cover;" src="/images/'+result.store_photo+'"> </div> <div class="col-11  bg-light p-3"> <strong><span class="d-inline">'+result.store_name+'</span> </strong> <br> '+value.message+' </div> </div> </div> </li>');
                              var element = document.getElementById("message-conversation-div");
                               element.scrollTop = element.scrollHeight;
                            }

                        })
                      }

                    })
                  }
               </script>

               <script type="text/javascript">
                $(document).ready(function(){
                  $('#decline-service-quote').click(function(){
                    var order_id = $(this).attr("data-order-id");
                    var conversation_id = <?php echo $service_conversation->id; ?>;
                    swal.fire({
                        title: 'คุณต้องการปฎิเสธการเสนอราคานี้?',
                        text: "หากคุณไม่ถูกใจในข้อเสนอหรือเงื่อนไขของการบริการนี้ คุณสามารถปฏิเสธงานได้",
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#4caf50',
                        confirmButtonText: 'ใช่, ฉันต้องการปฏิเสธ',
                        cancelButtonText: 'ไม่',
                      }).then((result) => {
                        if (result.value) {
                          swal.fire(
                            'คุณได้ทำการปฏิเสธแล้ว!',
                            'ปฏิเสธข้อเสนอของบริการนี้แล้ว คุณสามารถพูดคุยสอบถามต่อรองใหม่กับผู้ขายได้',
                            'success'
                          )

                          $.ajax({
                          url: '/order/service/'+order_id+'/declineservicequote',
                          type: "GET",
                          dataType: "json",
                          data: {conversation_id:conversation_id},
                          success:function(data) {
                            setTimeout(function() {document.location.reload(true)}, 2000);
                               }
                               });
                        }
                      })
                    });
                  });
               </script>

               <script type="text/javascript">
               $(document).ready(function () {
                  $('.request-for-edit-button').click(function () {
                      var order_id = $(this).attr('data-order-id');
                      var enc_order_id = $(this).attr('data-enc-order-id');
                      document.getElementById("order-id").innerHTML=order_id;
                      $("input[name='service_order_id']").val(enc_order_id);
                      url = "/order/service/"+order_id+"/requestserviceorderprogressforedit";
                      $("#requestforeditform").attr("action", url);
                  });
                });
               </script>

               <script type="text/javascript">
                  // enable fileuploader plugin
                  $('input[class="service-order-progress-edit-request-photo"]').fileuploader({
                     extensions: null,
                     changeInput: ' ',
                     theme: 'thumbnails',
                     enableApi: true,
                     addMore: true,
                     thumbnails: {
                     box: '<div class="fileuploader-items">' +
                                   '<ul class="fileuploader-items-list">' +
                             '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                                   '</ul>' +
                               '</div>',
                     item: '<li class="fileuploader-item file-has-popup">' +
                            '<div class="fileuploader-item-inner">' +
                                        '<div class="type-holder">${extension}</div>' +
                                        '<div class="actions-holder">' +
                                        '<a class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i></i></a>' +
                                '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                        '</div>' +
                                        '<div class="thumbnail-holder">' +
                                            '${image}' +
                                            '<span class="fileuploader-action-popup"></span>' +
                                        '</div>' +
                                        '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                                        '<div class="progress-holder">${progressBar}</div>' +
                                    '</div>' +
                               '</li>',
                      item2: '<li class="fileuploader-item file-has-popup">' +
                            '<div class="fileuploader-item-inner">' +
                                        '<div class="type-holder">${extension}</div>' +
                                        '<div class="actions-holder">' +
                                '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
                                '<a class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i></i></a>' +
                                '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                                        '</div>' +
                                        '<div class="thumbnail-holder">' +
                                            '${image}' +
                                            '<span class="fileuploader-action-popup"></span>' +
                                        '</div>' +
                                        '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                                        '<div class="progress-holder">${progressBar}</div>' +
                                    '</div>' +
                                '</li>',
                               startImageRenderer: true,
                         canvasImage: false,
                   _selectors: {
                     list: '.fileuploader-items-list',
                     item: '.fileuploader-item',
                     start: '.fileuploader-action-start',
                     retry: '.fileuploader-action-retry',
                     remove: '.fileuploader-action-remove'
                   },
                   onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                     var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                                 api = $.fileuploader.getInstance(inputEl.get(0));

                             plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();

                     if(item.format == 'image') {
                       item.html.find('.fileuploader-item-icon').hide();
                     }
                   }
                  },
                     dragDrop: {
                   container: '.fileuploader-thumbnails-input'
                  },
                  afterRender: function(listEl, parentEl, newInputEl, inputEl) {
                   var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                     api = $.fileuploader.getInstance(inputEl.get(0));

                   plusInput.on('click', function() {
                     api.open();
                   });
                  },
                     onRemove: function(item, listEl, parentEl, newInputEl, inputEl) {
                         var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                     api = $.fileuploader.getInstance(inputEl.get(0));

                   if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit)
                             plusInput.show();
                     },
                   sorter: {
                   selectorExclude: null,
                   placeholder: null,
                   scrollContainer: window,
                   onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                             var api = $.fileuploader.getInstance(inputEl.get(0)),
                                 fileList = api.getFileList(),
                                 _list = [];

                             $.each(fileList, function(i, item) {
                                 _list.push({
                                     name: item.name,
                                     index: item.index
                                 });
                             });

                             $.post('php/ajax_sort_files.php', {
                                 _list: JSON.stringify(_list)
                             });
                         }
                       },
                           onRemove: function(item) {
                         $.post('php/ajax_remove_file.php', {
                           file: item.name
                         });
                       }

                        });
                      </script>
             @endif

        <script type="text/javascript">
              $(document).ready(function(){

                // Lift card and show stats on Mouseover
                $('.product-card').hover(function(){
                   $(this).addClass('animate');
                   $('div.carouselNext, div.carouselPrev').addClass('visible');
                  }, function(){
                   $(this).removeClass('animate');
                   $('div.carouselNext, div.carouselPrev').removeClass('visible');
                });

                // Flip card to the back side
                $('#view_details').click(function(){

                });

                });


           </script>
           <script type="text/javascript">
              $(document).ready(function(){

                //Show carousel-control

                $("#myCarousel").mouseover(function(){
                  $("#myCarousel .carousel-control").show();
                });

                $("#myCarousel").mouseleave(function(){
                  $("#myCarousel .carousel-control").hide();
                });

                //Active thumbnail

                $("#thumbCarousel .thumb").on("click", function(){
                  $(this).addClass("active");
                  $(this).siblings().removeClass("active");

                });

                //When the carousel slides, auto update

                $('#myCarousel').on('slid.bs.carousel', function(){
                   var index = $('.carousel-inner .item.active').index();
                   var thumbnailActive = $('#thumbCarousel .thumb[data-slide-to="'+index+'"]');
                   thumbnailActive.addClass('active');
                   $(thumbnailActive).siblings().removeClass("active");
                });


               $(".nav-pills li a").click(function() {
                 $(".nav-pills > .active").removeClass("active");
                 $(this).parent().addClass('active');

              });


              $(function(){
                 $('.showanswerform').on('click', function() {
                    $('.answerform').show();
                    return false;
                 });
              });

              $(function(){
                 $('.showreviewanswerform').on('click', function() {
                    $('.reviewanswerform').show();
                    return false;
                 });
              });
           });

        </script>
        <script>
        $(document).ready(function(){
        $(".increase-button").on("click", function (e) {
            var $button = $(this);
            var oldValue = $button.parent().find('.quantity').val();
            $button.parent().find('.increase-button[data-action="decrease"]').removeClass('inactive');
            if ($button.data('action') == "increase") {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below 1
                if (oldValue > 1) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 1;
                    $button.addClass('inactive');
                }
            }
            $button.parent().find('.quantity').val(newVal);
            e.preventDefault();
          });
        });

        </script>

        <script type="text/javascript">
          $(document).ready(function(){
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
          });
        </script>

        <script type="text/javascript">
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                    event.preventDefault();
                    $(this).ekkoLightbox();
            });
         </script>

         <script type="text/javascript">
         document.querySelector('.search-form').addEventListener('submit', function(e) {
           e.preventDefault();
           // read the search query for input tag, i.e. user searches
           // for "django" let's say
           var q = document.querySelector('input[name="q"]').value;
           // just proceed if user has typed something
           if (q.length > 0) {
             window.open('/search.html#gsc.q=' + q, '_blank');
           }
          });


          // check if any hash parameter exists on the URL
          if (window.location.hash.length > 0) {
           // read the search query value among hash parameters
           // with key "gsc.q="
           var q = window.location.hash.substring(1).split('&').filter(function(v) {
             return v.substring(0, 6) === 'gsc.q=';
           })[0].substring(6);
           // if there is actually a search query
           if (q.length > 0) {
             // put it as the input tag's value
             document.querySelector('input[name="q"]').value = q;
           }
          }

         </script>


    </body>
    </html>
