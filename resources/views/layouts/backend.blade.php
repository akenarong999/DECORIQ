<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themify.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fade-down.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/webslidemenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/white-gry.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ekko-lightbox.css') }}">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container">
  <a class="navbar-brand  pr-3" href="/storemanager"><img width="128" src="/images/decoriq_store_manager_logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="md-input form-inline my-2 my-lg-0 w-100 border-right pr-3">
         <span class="font-weight-bold mr-3 text-muted">  @if(Request::is('storemanager/store/*'))X</span> <h4><img src="/images/{{$store->photo->file}}"  class="d-inline" style="display: block; width: 48px; height: 48px; object-fit: cover;"> {{$store->name}}</h4> @endif
    </div>
    <ul class="navbar-nav w-50">

      <li class="nav-item active">
        <a class="nav-link" href="/">หน้าแรก</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="#">ศูนย์ช่วยเหลือผู้ขาย</a>
      </li>


      <li class="nav-item">
        <a href="/storemanager/"><button type="button" class="btn btn-outline-dark">เลือกร้านค้า</button></a>
      </li>
    </ul>
  </div>
</div>

</nav>

    <div id="app">
       <!-- Mobile Header -->
                <div class="wsmobileheader clearfix">
                  <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
                  <span class="smllogo"><img width="128" src="/images/decoriq_logo.png"></span>
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


  @if(Request::is('storemanager/store/*'))

       <!-- Mobile Header -->
        <div class="wsmain clearfix border-bottom">
          <div class="container">

            <nav class="wsmenu clearfix">

              <ul class="wsmenu-list">



                <li class="nav-item">
                  <a class="navtext" href="/storemanager/store/{{$store->username}}/dashboard">
                      <span><i class="themify ti ti-home" ></i></span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/storemanager/store/{{$store->username}}/orders/all">
                      <span><i class="themify ti ti-receipt" ></i> รายการสั่งซื้อ</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/storemanager/store/{{$store->username}}/products">
                      <span><i class="themify ti ti-package" ></i> สินค้า</span>
                  </a>
                </li>


                <li class="nav-item">
                  <a class="navtext" href="/storemanager/store/{{$store->username}}/shippings">
                      <span><i class="themify ti ti-truck" ></i> การจัดส่ง</span>
                  </a>
                </li>


                 <li class="nav-item">
                      <a class="navtext" href="/storemanager/store/{{$store->username}}/services">
                         <span><i class="themify ti ti-ruler-pencil" ></i> บริการ</span>
                      </a>
                 </li>

                <li class="nav-item">
                  <a class="navtext" href="#">
                      <span><i class="themify ti ti-ticket" ></i> คูปอง</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/storemanager/store/{{$store->username}}/articles">
                      <span><i class="themify ti ti-write" ></i> บทความ</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/storemanager/store/{{$store->username}}/settings">
                      <span><i class="themify ti ti-settings" ></i> ตั้งค่า</span>
                  </a>
                </li>


                <!-- Authentication Links -->



                  @if (!Auth::check())

                    <li class="nav-item">
                      <a class="navtext" href="{{ route('login') }}">
                          <span><i class="themify ti ti-user"></i> เข้าสู่ระบบ/สมัครสมาชิก</span>
                      </a>
                    </li>
                @else
                <li class="nav-item">
                  <a class="navtext" href="#">
                      <span><i class="themify ti ti-comments" ></i></span>
                  </a>
                </li>
                    <li class="nav-item">
                      <a class="navtext" href="{{ route('login') }}">
                        <img class="rounded-circle d-inline"  style="display: block; width: 18px; height: 18px; object-fit: cover;" src="/images/{{Auth::user()->photo ? Auth::user()->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}"> <span class="d-inline"><?php if(empty(Auth::user()->firstname)){ echo Auth::user()->name; }else{ echo Auth::user()->firstname.' '.Auth::user()->lastname; } ?></span>
                      </a>
                    </li>

                    @endif
                    <li class="nav-item">
                      <a class="navtext d-xs-block d-sm-block d-md-none d-lg-none d-xl-none" href="#">
                      <span><i class="themify ti ti-book" ></i> วิธีการสั่งซื้อ</span>
                  </a>
                </li>
              </ul>

            </nav>
          </div>
          </div>
          @endif


        <main>

            @yield('content')
        </main>
    </div>

    <!--footer starts from here-->
    <footer class="footer">
    <div class="container bottom_border">
    <div class="row">
    <div class=" col-sm-4 col-md col-sm-4  col-12 col">
    <h5 class="headin5_amrc col_white_amrc pt2"><img width="200" class="img-fluid" src="/images/decoriq_footer.png" alt=""></h5>
    <!--headin5_amrc-->
    <p class="mb10">คือออนไลน์ช็อปปิ้งมอลล์ที่รวบรวมสินค้าประเภทของแต่งบ้านที่หลากหลาย จากผู้ผลิตหลายราย สำหรับผู้ที่ต้องการเนรมิตตกแต่งบ้าน คอนโด ที่อยู่อาศัยของคุณให้เป็นไปตามสไตล์ที่ต้องการในราคาที่ใครก็เป็นเจ้าของได้</p>
    <p><i class="fa fa-location-arrow"></i> กรุงเทพ, ประเทศไทย. </p>
    <p><i class="fa fa-phone"></i>  02-0137767  </p>
    <p><i class="fa fa fa-envelope"></i> contact@decoriq.com </p>


    </div>


    <div class=" col-sm-4 col-md  col-6 col">
    <h5 class="headin5_amrc col_white_amrc pt2">เกี่ยวกับเดคคอริค</h5>
    <!--headin5_amrc-->
    <ul class="footer_ul_amrc">
    <li><a href="#">ข้อมูลเกี่ยวกับเรา</a></li>
    <li><a href="#">ข่าวสารเกี่ยวกับเรา</a></li>
    <li><a href="#">ร่วมงานกับเรา</a></li>
    <li><a href="#">ลงขายกับเรา</a></li>
    <li><a href="#">สนใจเป็นตัวแทนขาย</a></li>
    </ul>
    <!--footer_ul_amrc ends here-->
    </div>


    <div class=" col-sm-4 col-md  col-6 col">
    <h5 class="headin5_amrc col_white_amrc pt2">ความช่วยเหลือ</h5>
    <!--headin5_amrc-->
    <ul class="footer_ul_amrc">
    <li><a href="#">ติดต่อสอบถาม</a></li>
    <li><a href="#">คำถามที่พบบ่อย</a></li>
    <li><a href="#">คู่มือการเรียนรู้ผู้ซื้อ/ผู้ขาย</a></li>
    <li><a href="#">ข้อมูลการจัดส่งสินค้า</a></li>
    <li><a href="#">ปัญหาและการคืนสินค้า</a></li>
    <li><a href="#">นโยบายความเป็นส่วนตัว</a></li>
    </ul>
    <!--footer_ul_amrc ends here-->
    </div>


    <div class=" col-sm-4 col-md  col-12 col">
    <h5 class="headin5_amrc col_white_amrc pt2">ภาษาของเว็บ</h5>
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
    <li><a href="#">หน้าหลัก</a></li>
    <li><a href="#">หมวดหมู่สินค้า</a></li>
    <li><a href="#">ชุมชนนักออกแบบ</a></li>
    <li><a href="#">บริการ</a></li>
    <li><a href="#">คอมมูนิตี้</a></li>
    <li><a href="#">ติดต่อเรา</a></li>
    </ul>
    <!--foote_bottom_ul_amrc ends here-->
    <p class="text-center">Copyright 2019 DECORIQ</p>

    <ul class="social_footer_ul">
    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
    </ul>
    <!--social_footer_ul ends here-->
    </div>

    </footer>


    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/webslidemenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ekko-lightbox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/drop_uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fileuploader.min.js') }}"></script>
    <script type="text/javascript" src="https://jvectormap.com/js/jquery-jvectormap-th-mill.js"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
    <script type="text/javascript" src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>


    <script type="text/javascript">
        $(document).ready( function () {
          $('#table_id').DataTable({
            "order": [[ 0, "desc" ]]
          });
        } );
    </script>


     <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").hover(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $("#sidebar-wrapper").toggleClass("toggled");
    });
    </script>
    <script>
     $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
       });
     });
     </script>


     @if(Request::is('storemanager/store/*/dashboard'))

     <script type="text/javascript">// <![CDATA[
        $(function(){
          $('#thailand-map').vectorMap({
              map: 'th_mill',
              backgroundColor: '#fff',
             regionStyle: {
             initial: {
               fill: '#E4ECEF'
             },
             hover: {
                 fill: "#49C3FF"
               },
           },
           series: {
              regions: [{
                values: gdpData,
                scale: ['#C8EEFF', '#1495ee'],
                normalizeFunction: 'polynomial'
              }]
            },
            onRegionTipShow: function(e, el, code){
              el.html(el.html()+' (Order - '+gdpData[code]+')');
            }
              });  // <-- mal formed
          });     // <-- mal formed
      </script>




     <script>
     var ctx = document.getElementById("myChart");
     var myChart = new Chart(ctx, {
             type: 'bar',
             data: {
                 labels: ["จันทร์", "อังตาร", "พุทธ", "พฤหัส", "ศุกร์", "เสาร์"],
                 datasets: [{
                     label: '# จำนวนรายการสั่งซื้อ',
                     data: [<?php echo $days["Mon"] ?>, <?php echo $days["Tue"] ?>, <?php echo $days["Wed"] ?>, <?php echo $days["Thu"] ?>, <?php echo $days["Fri"] ?>, <?php echo $days["Sat"] ?>],
                     backgroundColor: [
                         'rgba(255, 99, 132, 0.2)',
                         'rgba(54, 162, 235, 0.2)',
                         'rgba(255, 206, 86, 0.2)',
                         'rgba(75, 192, 192, 0.2)',
                         'rgba(153, 102, 255, 0.2)',
                         'rgba(255, 159, 64, 0.2)'
                     ],
                     borderColor: [
                         'rgba(255,99,132,1)',
                         'rgba(54, 162, 235, 1)',
                         'rgba(255, 206, 86, 1)',
                         'rgba(75, 192, 192, 1)',
                         'rgba(153, 102, 255, 1)',
                         'rgba(255, 159, 64, 1)'
                     ],
                     borderWidth: 1
                 }]
             },
             options: {
                 scales: {
                     yAxes: [{
                         ticks: {
                             beginAtZero:true
                         }
                     }]
                 }
             }
         });
         </script>

         @endif

         <script>
         $('#myModal').on('shown.bs.modal', function () {
         $('#myInput').trigger('focus')
         })
         </script>
         <script>
           $('#summernote').summernote({
             tabsize: 2,
             height: 180,
             callbacks: {
                 onPaste: function (e) {
                     var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                     e.preventDefault();
                     document.execCommand('insertText', false, bufferText);
                 }
             }
           });
         </script>


       <script>
          $('#producttypetab').on("click", "li", function (event) {
             var activeTab = $(this).find('a').attr('href').split('#')[1].split('-')[0];
             $('#producttype').val(activeTab);
           });
       </script>

       <script>
          var upload = new FileUploadWithPreview('myUniqueUploadId');
       </script>

       @if(Request::is('storemanager/store/*/products/create'))

       <script>
           var value=1;
           $("#btnAdd").click(function(){
               $(".remove").first().remove();
               value=value+1;
               $("#VariableBoxContainer").append('<div class="row mb-2 mt-3 variation-row border-bottom"><div class="col-sm-2"><label for="product"><label><input type="file" onchange="readURL(this,'+value+');" style="display:none" name="file[]" /><img id="image-preview-'+value+'" class="img-fluid" src="/images/product-variation-placeholder.png" alt="your image" /></div><div class="col-sm-3"><label>รูปแบบ #'+value+'</label><input type="text" name="variationname[]" class="form-control" placeholder=""></div><div class="col-sm-2"><label>ราคา</label><input type="text" name="variationprice[]" class="form-control"></div><div class="col-sm-2"><label>น้ำหนัก(kg)</label><input name="variationweight[]" type="text" class="form-control"></div> <div class="col-sm-2"><label>จำนวนในสต็อก</label><input name="variationstock[]" type="text" class="form-control"></div><div class="col-sm-1"><label>&nbsp;</label><br><div class="startremove"><button type="button" class="btn btn-danger remove">x</button></div></div>');
               if(value==1){
                 $("button.remove").last().remove();
               }
           });
           $("body").on("click", ".remove", function () {
               value=value-1;
               $(".variation-row").last().remove();
               $( '<button type="button" class="btn btn-danger remove">x</button>' ).insertAfter( $( ".startremove:last" ) ).last();
               if(value==1){
                 $("button.remove").last().remove();
               }
           });
       </script>

       <script>
          $(document).ready(function() {
            var inputVal=$("#producttype").val();

            if(inputVal=='variable'){
              $('#variable-product-pill').addClass('active');
              $('#single-product-pill').removeClass('active');
              $('#variabletab').addClass('active');
              $('#variable-product').addClass('active');
              $('#singletab').removeClass('active');
              $('#single-product').removeClass('active');
            }
            else{
              $('#single-product-pill').addClass('active');
              $('#variable-product-pill').removeClass('active');
              $('#singletab').addClass('active');
              $('#single-product').addClass('active');
              $('#variabletab').removeClass('active');
              $('#variable-product').removeClass('active');
            }
          });
       </script>

       <script type="text/javascript">
          $(document).ready(function() {
              $('select[name="parent_category_id"]').on('change', function() {
                  var category_id = $(this).val();
                  if(category_id) {
                      $.ajax({
                          url: '/storemanager/store/{{$store->username}}/products/getsubcategoriesajax/'+category_id,
                          type: "GET",
                          dataType: "json",
                          success:function(data) {
                                $('select[name="category_id"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                });
                          }
                      });
                  }else{
                      $('select[name="category_id"]').append('<option value="">ไม่มีหมวดหมู่สินค้า</option>');
                  }
              });
           });

        </script>

        <script type="text/javascript">
              $(document).ready(function() {
              setTimeout(
              function(){
              var parent_category_id = $("#parentcategories").val();
                   if(parent_category_id) {
                      $.ajax({
                      url: '/storemanager/store/{{$store->username}}/products/getsubcategoriesajax/'+parent_category_id,
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                           $('select[name="category_id"]').empty();
                           $.each(data, function(key, value) {
                           $('select[name="category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                           });
                           }
                           });
                    }
                   else{
                         $('select[name="category_id"]').append('<option value="">ไม่มีหมวดหมู่สินค้า</option>');
                    }

             },1500);
             });
        </script>

       <script>
         /* preview image in edit product variation */
         function readURL(input,j) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function (e) {
                      $('#image-preview-'+j)
                          .attr('src', e.target.result);
                  };

                  reader.readAsDataURL(input.files[0]);
              }
          }
       </script>
       @endif

       @if(Request::is('storemanager/store/*/products'))

         <script type="text/javascript">

             $('.delete-product-button').click(function(){
               var product_id = $(this).data("product-id");
               var store_username = '<?php echo $store->username; ?>';
               swal.fire({
                   title: 'ลบสินค้านี้?',
                   text: "คุณต้องการลบสินค้านี้ใช่หรือไม่?",
                   type: 'question',
                   showCancelButton: true,
                   confirmButtonColor: '#4caf50',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'ใช่, ฉันต้องการลบ',
                   cancelButtonText: 'ไม่ลบ',
                 }).then((result) => {
                   if (result.value) {
                     $.ajax({
                     url:'/storemanager/store/'+store_username+'/products/'+product_id+'/delete',
                     type: "GET",
                     dataType: "text",
                    success:function(store_username) {
                      swal.fire(
                        'ลบเรียบร้อยแล้ว!',
                        'สินค้านี้จะไม่อยู่ในระบบอีกต่อไป',
                        'success'
                      )
                      document.location.reload(true);
                          }
                       });
                   }

                 });

               });


         </script>

         <script type="text/javascript">
         $('input[class=onoff-switch-input]').on('change', function() {
           var product_id = $(this).val();
           var store_username = '<?php echo $store->username; ?>';
          if($(this).prop("checked")){
            $.ajax({
              url: '/storemanager/store/'+store_username+'/products/'+product_id+'/setpublish',
              type: "GET",
              data: {product_id:product_id},
              dataType: "json",
              success:function(data) {
                if(data==false){
                  swal.fire({
                      type: 'error',
                      title: 'เผยแพร่สินค้านี้ไม่ได้',
                      text: 'ไม่สามารถเผยแพร่ได้ เนื่องจากยังไม่ได้ทำการตั้งค่าการจัดส่งของสินค้าชิ้นนี้ คุณสามารถแก้ไขสินค้าเพื่อเปิดการจัดส่งสำหรับสินค้านี้',
                      footer: '<a href="/storemanager/store/'+store_username+'/products/'+product_id+'/set-shipping">ไปตั้งค่าการจัดส่งของสินค้านี้</a>'
                    }).then((text) => {
                    location.reload(true);
                    })
                }else{
                  swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'เผยแพร่สินค้านี้เรียบร้อยแล้ว',
                    showConfirmButton: false,
                    timer: 1500
                  })
                }
               }
            });
          }else{
            $.ajax({
              url: '/storemanager/store/'+store_username+'/products/'+product_id+'/setunpublish',
              type: "GET",
              data: {product_id:product_id},
              dataType: "json",
              success:function(data) {
               }
            });
          }

          });
          </script>

          <!-- edit discount price -->
          <script type="text/javascript">
            function showEditSingleProductDiscountPriceForm(product_id){
              $("#single_product_discount_price_"+product_id).hide();
              $("#single_product_discount_price_form_"+product_id).css("display", "block");
            };

            function hideEditStatusMessageForm(){
              $("#status_message").show();
              $("#status_message_form").css("display", "none");
            }
          </script>

          <script type="text/javascript">
          $('button[class=add-discount-price-button]').on('click', function() {
             product_id = $(this).val();
             discount_price = $('#add-discount-price-input-product-'+$(this).val()).val();
             $.ajax({
             url:'/storemanager/store/<?php echo $store->username; ?>/products/updatesingleproductdiscountprice/'+product_id+'/'+discount_price,
             type: "GET",
             dataType: "text",
             success:function(data) {
               $("#single_product_discount_price_"+product_id).text(data+' ฿');
               $("#single_product_discount_price_"+product_id).show();
               $("#single_product_discount_price_form_"+product_id).css("display", "none");
              }
               });
           });
          </script>


       @endif

       @if(Request::is('storemanager/store/*/products/*/edit'))

       <script>
         /* preview image in edit product variation */
         function readURL(input,j) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function (e) {
                      $('#image-preview-'+j)
                          .attr('src', e.target.result);
                  };

                  reader.readAsDataURL(input.files[0]);
              }
          }
       </script>
       <script>
          $(document).ready(function() {
            var inputVal=$("#producttype").val();
            if(inputVal=='single'){

              $('#singletab').addClass('active');
              $('#single-product').addClass('active');
            }
            else{

              $('#variabletab').addClass('active in');
              $('#variable-product').addClass('active in');
            }
          });
       </script>
       <script type="text/javascript">
          $(document).ready(function(){
                  var category_id = $('#subcategories').val();
                  if(category_id) {
                      $.ajax({
                          url: '/storemanager/store/{{$store->username}}/products/getparentcategoryajax/'+category_id,
                          type: "GET",
                          dataType: "json",
                          success:function(data) {
                                $.each(data, function(key, value) {
                                     $("select[name='parent_category_id'] option[value='"+key+"'").attr("selected","selected");
                                });

                          }
                      });
                  }else{
                      $('select[name="parent_category_id"]').append('<option value="">ไม่มีหมวดหมู่สินค้า</option>');
                  }

                  setTimeout(
                  function(){
                  var product_id = $("#product_id").val();
                  var parent_category_id = $("#parentcategories").val();
                  if(parent_category_id) {
                      $.ajax({
                          url: '/storemanager/store/{{$store->username}}/products/getselectedsubcategoryajax/'+parent_category_id+'/'+product_id,
                          type: "GET",
                          dataType: "json",
                          success:function(data) {
                                let popped = data.pop();
                                $('select[name="category_id"]').empty();
                                $.each(data[0], function(key, value) {
                                    $('select[name="category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                      $("#subcategories").val(popped).change();
                                });
                          }
                      });
                  }else{
                      $('select[name="category_id"]').append('<option value="">ไม่มีหมวดหมู่สินค้า</option>');
                  }
                },1500);
               });

                  $(document).ready(function() {
                  $('select[name="parent_category_id"]').on('change', function() {
                    var parent_category_id = $("#parentcategories").val();
                   if(parent_category_id) {
                      $.ajax({
                          url: '/storemanager/store/{{$store->username}}/products/getsubcategoriesajax/'+parent_category_id,
                          type: "GET",
                          dataType: "json",
                          success:function(data) {
                                $('select[name="category_id"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                });
                          }
                      });
                  }else{
                      $('select[name="category_id"]').append('<option value="">ไม่มีหมวดหมู่สินค้า</option>');
                  }
                  });

           });
        </script>
        <script>
           var value=<?php echo $variable_array_count ?>;

           $("#btnAdd").click(function(){
               $(".remove").first().remove();
               value=value+1;
               $("#VariableBoxContainer").append('<div class="row mb-2 mt-3 variation-row border-bottom"><div class="col-sm-2"><label for="product"><label><input type="file" onchange="readURL(this,'+value+');" style="display:none" name="file[]" /><img id="image-preview-'+value+'" class="img-fluid" src="/images/product-variation-placeholder.png"/></div><div class="col-sm-3"><label>รูปแบบ #'+value+'</label><input type="text" name="variationname[]" class="form-control" placeholder=""></div><div class="col-sm-2"><label>ราคา</label><input type="text" name="variationprice[]" class="form-control"></div><div class="col-sm-2"><label>น้ำหนัก(kg)</label><input name="variationweight[]" type="text" class="form-control"></div> <div class="col-sm-2"><label>จำนวนในสต็อก</label><input name="variationstock[]" type="text" class="form-control"></div><div class="col-sm-1"><label>&nbsp;</label><br><div class="startremove"><button type="button" class="btn btn-danger remove">x</button></div></div>');

           });
           $("body").on("click", ".remove", function () {
               value=value-1;
               $(".variation-row").last().remove();
               $( '<button type="button" class="btn btn-danger remove">x</button>' ).insertAfter( $( ".startremove:last" ) ).last();
               if(value==1){
                 $("button.remove").last().remove();
               }
           });
       </script>
        @endif

        @if(Request::is('storemanager/store/*/services'))

          <script type="text/javascript">

              $('.delete-service-button').click(function(){
                var service_id = $(this).data("service-id");
                var store_username = '<?php echo $store->username; ?>';
                swal.fire({
                    title: 'ลบบริการนี้?',
                    text: "คุณต้องการลบบริการนี้ใช่หรือไม่?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#4caf50',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่, ฉันต้องการลบ',
                    cancelButtonText: 'ไม่ลบ',
                  }).then((result) => {
                    if (result.value) {
                      $.ajax({
                      url:'/storemanager/store/'+store_username+'/services/'+service_id+'/delete',
                      type: "GET",
                      dataType: "text",
                     success:function(store_username) {
                       swal.fire(
                         'ลบเรียบร้อยแล้ว!',
                         'บริการนี้จะไม่อยู่ในระบบอีกต่อไป',
                         'success'
                       )
                       document.location.reload(true);
                           }
                        });
                    }
                  });

                });


          </script>

          <script type="text/javascript">
          $('input[class=onoff-switch-input]').on('change', function() {
            var service_id = $(this).val();
            var store_username = '<?php echo $store->username; ?>';
           if($(this).prop("checked")){
             $.ajax({
               url: '/storemanager/store/'+store_username+'/services/'+service_id+'/setpublish',
               type: "GET",
               data: {service_id:service_id},
               dataType: "json",
               success:function(data) {
                }
             });
           }else{
             $.ajax({
               url: '/storemanager/store/'+store_username+'/services/'+service_id+'/setunpublish',
               type: "GET",
               data: {service_id:service_id},
               dataType: "json",
               success:function(data) {
                }
             });
           }

           });
           </script>

        @endif

        @if(Request::is('storemanager/store/*/services/create'))

        <script type="text/javascript">
           $(document).ready(function() {
               $('select[name="parent_category_id"]').on('change', function() {
                   var category_id = $(this).val();
                   if(category_id) {
                       $.ajax({
                           url: '/storemanager/store/{{$store->username}}/services/getsubcategoriesajax/'+category_id,
                           type: "GET",
                           dataType: "json",
                           success:function(data) {
                                 $('select[name="category_id"]').empty();
                                   $.each(data, function(key, value) {
                                   $('select[name="category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                   });
                           }
                       });
                   }else{
                     $('select[name="category_id"]').empty();
                       $('select[name="category_id"]').append('<option value="">ไม่มีหมวดหมู่ย่อย</option>');
                   }
               });
            });

         </script>

         <script type="text/javascript">
               $(document).ready(function() {
               setTimeout(
               function(){
               var parent_category_id = $("#parentcategories").val();
                    if(parent_category_id) {
                       $.ajax({
                       url: '/storemanager/store/{{$store->username}}/services/getsubcategoriesajax/'+parent_category_id,
                       type: "GET",
                       dataType: "json",
                       success:function(data) {
                            $('select[name="category_id"]').empty();
                              $.each(data, function(key, value) {
                              $('select[name="category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                              });

                          }
                         });
                     }
                    else{
                      $('select[name="category_id"]').empty();
                          $('select[name="category_id"]').append('<option value="">ไม่มีหมวดหมู่ย่อย</option>');
                     }

              },1500);
              });
         </script>

         <script type="text/javascript">
         // Settings for allow location on edit shipping page
          var elt = $('#inputallowlocation');

          var allowlocations = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              limit: 20,
              remote: {
                    url: '{!!url("/")!!}' + '/api/find?keyword=%QUERY%',
                    wildcard: '%QUERY%',
              }
          });
          allowlocations.initialize();
          $('#inputallowlocation').tagsinput({
          itemValue : 'id',
          itemText  : 'name',
          maxChars: 10,
          trimValue: true,
          allowDuplicates : true,
          freeInput: false,
          focusClass: 'form-control',
          tagClass: function(item) {
              if(item.display)
                 return 'label label-' + item.display;
              else
                  return 'label label-default';

          },
          onTagExists: function(item, $tag) {
              $tag.hide().fadeIn();
          },
          typeaheadjs: [{
                    hint: false,
                            highlight: true
                        },
                        {
                           name: 'allowlocations',
                        itemValue: 'id',
                        displayKey: 'name',
                        source: allowlocations.ttAdapter(),
                        templates: {
                            empty: [
                                '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                            ],
                            header: [
                                '<ul class="list-group">'
                            ],
                            suggestion: function (data) {
                                return '<li class="list-group-item">' + data.name + '</li>'
                            }
                        }
            }]
            });
           </script>

           <script type="text/javascript">
           // Settings for not allow location on edit shipping page
            var elt = $('#inputnotallowlocation');

            var notallowlocations = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 20,
                remote: {
                      url: '{!!url("/")!!}' + '/api/find?keyword=%QUERY%',
                      wildcard: '%QUERY%',
                }
            });
            notallowlocations.initialize();
            $('#inputnotallowlocation').tagsinput({
            itemValue : 'id',
            itemText  : 'name',
            maxChars: 10,
            trimValue: true,
            allowDuplicates : false,
            freeInput: true,
            focusClass: 'form-control',
            tagClass: function(item) {
                if(item.display)
                   return 'label label-' + item.display;
                else
                    return 'label label-default';

            },
            onTagExists: function(item, $tag) {
                $tag.hide().fadeIn();
            },
            typeaheadjs: [{
                      hint: false,
                              highlight: true
                          },
                          {
                             name: 'notallowlocations',
                          itemValue: 'id',
                          displayKey: 'name',
                          source: notallowlocations.ttAdapter(),
                          templates: {
                              empty: [
                                  '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                              ],
                              header: [
                                  '<ul class="list-group">'
                              ],
                              suggestion: function (data) {
                                  return '<li class="list-group-item">' + data.name + '</li>'
                              }
                          }
              }]
              });

           </script>

           <script>
            $(document).ready(function(){
                $('.bootstrap-tagsinput').addClass('form-control');
                $('.tt-input').css("vertical-align", "baseline");
                $('.tt-dataset').css("width", "100%");
                $(document).ready(function() {
                $(window).keydown(function(event){
                  if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                  }
                });
              });
              });
            </script>

            <script type="text/javascript">

              $("#afterservicecareduration").change(function(){
                afterservicecareduration = $("#afterservicecareduration").val();

                if (afterservicecareduration !== null && afterservicecareduration!=='-') {
                  $("#after-service-support-description-form").css("display", "block");

                }else{
                  $("#after-service-support-description-form").css("display", "none");
                }
              });
            </script>

        @endif

        @if(Request::is('storemanager/store/*/services/*/edit'))
        <script type="text/javascript">
           $(document).ready(function(){

                   var category_id = $('#subcategories').val();
                   if(category_id) {
                       $.ajax({
                           url: '/storemanager/store/{{$store->name}}/services/getparentcategoryajax/'+category_id,
                           type: "GET",
                           dataType: "json",
                           success:function(data) {
                                 $.each(data, function(key, value) {
                                      $("select[name='parent_category_id'] option[value='"+key+"'").attr("selected","selected");
                                 });

                           }
                       });
                   }else{
                       $('select[name="parent_category_id"]').append('<option value="">ไม่มีหมวดหมู่สินค้า</option>');
                   }

                   setTimeout(
                   function(){
                   var service_id = $("#service_id").val();
                   var parent_category_id = $("#parentcategories").val();
                   if(parent_category_id) {
                       $.ajax({
                           url: '/storemanager/store/{{$store->name}}/services/getselectedsubcategoryajax/'+parent_category_id+'/'+service_id,
                           type: "GET",
                           dataType: "json",
                           success:function(data) {
                                 let popped = data.pop();
                                 $('select[name="category_id"]').empty();
                                 $.each(data[0], function(key, value) {
                                     $('select[name="category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                       $("#subcategories").val(popped).change();
                                 });
                           }
                       });
                   }else{
                       $('select[name="service_category_id"]').append('<option value="">ไม่มีหมวดหมู่สินค้า</option>');
                   }
                 },1000);
                });

                   $(document).ready(function() {
                   $('select[name="parent_category_id"]').on('change', function() {
                    var parent_category_id = $("#parentcategories").val();
                    if(parent_category_id) {
                       $.ajax({
                           url: '/storemanager/store/{{$store->name}}/services/getsubcategoriesajax/'+parent_category_id,
                           type: "GET",
                           dataType: "json",
                           success:function(data) {
                                 $('select[name="service_category_id"]').empty();
                                 $.each(data, function(key, value) {
                                     $('select[name="service_category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                 });
                           }
                       });
                   }else{
                       $('select[name="service_category_id"]').append('<option value="">ไม่มีหมวดหมู่สินค้า</option>');
                   }
                   });

            });
         </script>
         <script type="text/javascript">
         // Settings for allow location on edit shipping page
          var elt = $('#inputallowlocation');

          var allowlocations = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              limit: 20,
              remote: {
                    url: '{!!url("/")!!}' + '/api/find?keyword=%QUERY%',
                    wildcard: '%QUERY%',
              }
          });
          allowlocations.initialize();
          $('#inputallowlocation').tagsinput({
          itemValue : 'id',
          itemText  : 'name',
          maxChars: 10,
          trimValue: true,
          allowDuplicates : true,
          freeInput: false,
          focusClass: 'form-control',
          tagClass: function(item) {
              if(item.display)
                 return 'label label-' + item.display;
              else
                  return 'label label-default';

          },
          onTagExists: function(item, $tag) {
              $tag.hide().fadeIn();
          },
          typeaheadjs: [{
                    hint: false,
                            highlight: true
                        },
                        {
                           name: 'allowlocations',
                        itemValue: 'id',
                        displayKey: 'name',
                        source: allowlocations.ttAdapter(),
                        templates: {
                            empty: [
                                '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                            ],
                            header: [
                                '<ul class="list-group">'
                            ],
                            suggestion: function (data) {
                                return '<li class="list-group-item">' + data.name + '</li>'
                            }
                        }
            }]
            });

           </script>

           <script type="text/javascript">
           // Settings for not allow location on edit shipping page
            var elt = $('#inputnotallowlocation');

            var notallowlocations = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit: 20,
                remote: {
                      url: '{!!url("/")!!}' + '/api/find?keyword=%QUERY%',
                      wildcard: '%QUERY%',
                }
            });
            notallowlocations.initialize();
            $('#inputnotallowlocation').tagsinput({
            itemValue : 'id',
            itemText  : 'name',
            maxChars: 10,
            trimValue: true,
            allowDuplicates : false,
            freeInput: true,
            focusClass: 'form-control',
            tagClass: function(item) {
                if(item.display)
                   return 'label label-' + item.display;
                else
                    return 'label label-default';

            },
            onTagExists: function(item, $tag) {
                $tag.hide().fadeIn();
            },
            typeaheadjs: [{
                      hint: false,
                              highlight: true
                          },
                          {
                             name: 'notallowlocations',
                          itemValue: 'id',
                          displayKey: 'name',
                          source: notallowlocations.ttAdapter(),
                          templates: {
                              empty: [
                                  '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                              ],
                              header: [
                                  '<ul class="list-group">'
                              ],
                              suggestion: function (data) {
                                  return '<li class="list-group-item">' + data.name + '</li>'
                              }
                          }
              }]
              });

           </script>

           <script>
            $(document).ready(function(){
                $('.bootstrap-tagsinput').addClass('form-control');
                $('.tt-input').css("vertical-align", "baseline");
                $('.tt-dataset').css("width", "100%");
                $(document).ready(function() {
                $(window).keydown(function(event){
                  if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                  }
                });
              });
              });
            </script>

            <script type="text/javascript">

              $("#afterservicecareduration").change(function(){
                afterservicecareduration = $("#afterservicecareduration").val();
                if (afterservicecareduration !== "" && afterservicecareduration!=='-') {
                  $("#after-service-support-description-form").css("display", "block");

                }else{
                  $("#after-service-support-description-form").css("display", "none");
                }
              });
            </script>
        @endif

        @if(Request::is('storemanager/store/*/shippings/*/edit') && ($shipping->type=='weight'))
        <script>
            var shipping_weightbases_array_count=<?php echo $shipping_weightbases_array_count ?>;

            $("#btnAdd").click(function(){
                $(".remove").first().remove();
                shipping_weightbases_array_count=shipping_weightbases_array_count+1;
                $("#WeightbaseBoxContainer").append('<div class="row mb-2 mt-4 weightbase-row"><div class="col-sm-4"><label>น้ำหนักมากกว่า (> kg)</label><input type="text" name="weightbaseminweight[]" class="form-control" placeholder=""></div><div class="col-sm-4"><label>น้ำหนักน้อยกว่าหรือเท่ากับ (<= kg)</label><input type="text" name="weightbasemaxweight[]" class="form-control"></div><div class="col-sm-3"><label>ค่าจัดส่ง</label><input name="weightbasecost[]" type="text" class="form-control"></div><div class="col-sm-1"><label>&nbsp;</label><br><div class="startremove"><button type="button" class="btn btn-danger remove">x</button></div></div>');
            });
            $("body").on("click", ".remove", function () {
                shipping_weightbases_array_count=shipping_weightbases_array_count-1;
                $(".weightbase-row").last().remove();
                $( '<button type="button" class="btn btn-danger remove">x</button>' ).insertAfter( $( ".startremove:last" ) ).last();
                if(shipping_weightbases_array_count==1){
                  $("button.remove").last().remove();
                }
            });
        </script>
        @endif

       <script type="text/javascript">
          // enable fileuploader plugin
          $('input[name="productfile"]').fileuploader({
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

              @if(Request::is('storemanager/store/*/shippings/*/edit'))

              <script type="text/javascript">
              // Settings for allow location on edit shipping page
               var elt = $('#inputallowlocation');

               var allowlocations = new Bloodhound({
                   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
                   queryTokenizer: Bloodhound.tokenizers.whitespace,
                   limit: 20,
                   remote: {
                         url: '{!!url("/")!!}' + '/api/find?keyword=%QUERY%',
                         wildcard: '%QUERY%',
                   }
               });
               allowlocations.initialize();
               $('#inputallowlocation').tagsinput({
               itemValue : 'id',
               itemText  : 'name',
               maxChars: 10,
               trimValue: true,
               allowDuplicates : true,
               freeInput: false,
               focusClass: 'form-control',
               tagClass: function(item) {
                   if(item.display)
                      return 'label label-' + item.display;
                   else
                       return 'label label-default';

               },
               onTagExists: function(item, $tag) {
                   $tag.hide().fadeIn();
               },
               typeaheadjs: [{
                         hint: false,
                                 highlight: true
                             },
                             {
                                name: 'allowlocations',
                             itemValue: 'id',
                             displayKey: 'name',
                             source: allowlocations.ttAdapter(),
                             templates: {
                                 empty: [
                                     '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                                 ],
                                 header: [
                                     '<ul class="list-group">'
                                 ],
                                 suggestion: function (data) {
                                     return '<li class="list-group-item">' + data.name + '</li>'
                                 }
                             }
                 }]
                 });
                </script>

                <script type="text/javascript">
                // Settings for not allow location on edit shipping page
                 var elt = $('#inputnotallowlocation');

                 var notallowlocations = new Bloodhound({
                     datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
                     queryTokenizer: Bloodhound.tokenizers.whitespace,
                     limit: 20,
                     remote: {
                           url: '{!!url("/")!!}' + '/api/find?keyword=%QUERY%',
                           wildcard: '%QUERY%',
                     }
                 });
                 notallowlocations.initialize();
                 $('#inputnotallowlocation').tagsinput({
                 itemValue : 'id',
                 itemText  : 'name',
                 maxChars: 10,
                 trimValue: true,
                 allowDuplicates : false,
                 freeInput: true,
                 focusClass: 'form-control',
                 tagClass: function(item) {
                     if(item.display)
                        return 'label label-' + item.display;
                     else
                         return 'label label-default';

                 },
                 onTagExists: function(item, $tag) {
                     $tag.hide().fadeIn();
                 },
                 typeaheadjs: [{
                           hint: false,
                                   highlight: true
                               },
                               {
                                  name: 'notallowlocations',
                               itemValue: 'id',
                               displayKey: 'name',
                               source: notallowlocations.ttAdapter(),
                               templates: {
                                   empty: [
                                       '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                                   ],
                                   header: [
                                       '<ul class="list-group">'
                                   ],
                                   suggestion: function (data) {
                                       return '<li class="list-group-item">' + data.name + '</li>'
                                   }
                               }
                   }]
                   });
                </script>


                <script type="text/javascript">
                    var value = <?php echo $allowlocation; ?>;

                    var array_value =[];
                    var count=Object.keys(value).length;
                    $.each(elt, function(index) {

                      for (i = 0; i < count; i++) {
                       $('#inputallowlocation').tagsinput('add', value[i]);
                      }
                   });
                </script>
                <script type="text/javascript">
                    var value = <?php echo $notallowlocation; ?>;

                    var array_value =[];
                    var count=Object.keys(value).length;
                    $.each(elt, function(index) {

                      for (i = 0; i < count; i++) {
                       $('#inputnotallowlocation').tagsinput('add', value[i]);
                      }
                   });
                </script>


                <script>
                 $(document).ready(function(){
                     $('.bootstrap-tagsinput').addClass('form-control');
                     $('.tt-input').css("vertical-align", "baseline");
                     $('.tt-dataset').css("width", "100%");
                     $(document).ready(function() {
                     $(window).keydown(function(event){
                       if(event.keyCode == 13) {
                         event.preventDefault();
                         return false;
                       }
                     });
                   });
                   });
                 </script>
                 @endif

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

                 @if(Request::is('storemanager/store/*/order/*'))

                 <script type="text/javascript">
                 // Order Status section - get value to tracking on Modal

                 $( "select#shipping_name" ).change(function () {
                   var shipping_company_id = $(this).children("option:selected").val();
                   var shipping_company = { id : shipping_company_id};
                   if(shipping_company_id!=0){
                     document.getElementById("customshippingcompany-input").style.display = "none";
                     $.ajax({
                     url: '/storemanager/store/{{$store->username}}/gettrackurl',
                     type: "GET",
                     data: shipping_company,
                     dataType: "json",
                     success:function(data) {
                          $('#shippingtrackurl').val(data);
                          }
                          });
                   }else{
                     $('#shippingtrackurl').val("");
                     document.getElementById("customshippingcompany-input").style.display = "block";

                   }
                  });

                  $( "#submittrackno").click(function() {
                    var shipping_company_id = $('#shipping_name').val();
                    if(shipping_company_id!=0) {
                      var track_data = {order_id: <?php echo $order->id ?> , shipping_name: $("#shipping_name option:selected").text(),  shipping_track_url: $("#shippingtrackurl").val(), tracking_no: $("#trackingno").val() }
                    }else{
                      var track_data = {order_id: <?php echo $order->id ?>,  shipping_name: $("#customshippingcompany").val(), shipping_track_url: $("#shippingtrackurl").val(), tracking_no: $("#trackingno").val() }
                    }
                    $.ajax({
                    url: '/storemanager/store/{{$store->username}}/setordertrackno',
                    type: "GET",
                    data: track_data,
                    dataType: "json",
                    success:function(data) {
                         document.location.reload(true);
                         }
                         });


                  });

                 </script>

                 @endif

                 @if(Request::is('storemanager/store/*/order/service/*'))
                 @endif

                 @if(Request::is('storemanager/store/*/settings/*'))
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
                     $('input[id="coverphoto"]').fileuploader({
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
                   @endif



                 @if(Request::is('storemanager/store/*/service/messages/*'))
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
                                   url: "/storemanager/store/"+store_username+"/service/messages/"+conversation_id+"/sendmessage",
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
                                  url: "/storemanager/store/"+store_username+"/service/messages/"+conversation_id+"/getnewchatmessage",
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
                           $('#datepicker').datepicker();
                         </script>

                         <script type="text/javascript">
                            // enable fileuploader plugin
                            $('input[class="service-order-photo"]').fileuploader({
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

                                <script type="text/javascript">
                                 $(document).ready(function(){
                                   $('.cancel-service-quote').click(function(){
                                     var order_id = $(this).attr("data-order-id");
                                     var conversation_id = <?php echo $service_conversation->id; ?>;
                                     swal.fire({
                                         title: 'คุณต้องการยกเลิกการเสนอราคานี้?',
                                         text: "ถ้าหากคุณยกเลิกการเสนอราคานี้ คุณจะไม่สามารถกลับมาแก้ไขได้",
                                         type: 'question',
                                         showCancelButton: true,
                                         confirmButtonColor: '#d33',
                                         cancelButtonColor: '#4caf50',
                                         confirmButtonText: 'ใช่, ฉันจะยกเลิก',
                                         cancelButtonText: 'ไม่ยกเลิก',
                                       }).then((result) => {
                                         if (result.value) {
                                           swal.fire(
                                             'คุณได้ทำการยกเลิกแล้ว!',
                                             'การเสนอราคาของบริการนี้ได้ถูกยกเลิกแล้ว อย่างไรก็ตามคุณสามารถเสนอราคาใหม่ได้',
                                             'success'
                                           )

                                           $.ajax({
                                           url: '/storemanager/store/<?php echo $service_conversation->store->username ?>/service-order/'+order_id+'/cancelservicequote/',
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
                                   $('.update-order-button').click(function () {
                                       var order_id = $(this).attr('data-order-id');
                                       var store_username = $(this).attr('data-store-username');
                                       var enc_order_id = $(this).attr('data-enc-order-id');
                                       url = "/storemanager/store/"+store_username+"/service-order/"+order_id+"/updateserviceorderprogress";
                                       $("input[name='service_order_id']").val(enc_order_id);

                                       $("#updateserviceorderprogressform").attr("action", url);
                                   });
                                 });
                                </script>

                                <script type="text/javascript">
                                   // enable fileuploader plugin
                                   $('input[class="service-order-progress-photo"]').fileuploader({
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

                                       <script type="text/javascript">
                                        $(document).ready(function(){
                                          $('.accept-customer-edit-request').click(function(){
                                            var order_id = $(this).attr("data-order-id");
                                            var conversation_id = <?php echo $service_conversation->id; ?>;
                                            var store_username = "<?php echo $service_conversation->store->username ?>";
                                            swal.fire({
                                                title: 'ยอมรับและแก้ไขงาน?',
                                                text: "คุณจะยอมรับและแก้ไขงานตามที่ลูกค้าต้องการ",
                                                type: 'question',
                                                showCancelButton: true,
                                                confirmButtonColor: '#4caf50',
                                                cancelButtonColor: '#818384',
                                                confirmButtonText: 'ใช่, ฉันจะยอมรับ',
                                                cancelButtonText: 'ขอคิดดูก่อน',
                                              }).then((result) => {
                                                if (result.value) {
                                                  swal.fire(
                                                    'คุณได้ยอมรับการแก้ไขงานแล้ว!',
                                                    'กรุณาแก้ไขงานตามที่ลูกค้าต้องการ',
                                                    'success'
                                                  )

                                                  $.ajax({
                                                  url: '/storemanager/store/'+store_username+'/service-order/'+order_id+'/acceptcustomereditrequest/',
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
                                        $(document).ready(function(){
                                          $('.reject-customer-edit-request').click(function(){
                                            var order_id = $(this).attr("data-order-id");
                                            var conversation_id = <?php echo $service_conversation->id; ?>;
                                            var store_username = "<?php echo $service_conversation->store->username ?>";
                                            swal.fire({
                                                title: 'ปฏิเสธการแก้ไข?',
                                                text: "คุณไม่ต้องการแก้ไขงานตามที่ลูกค้าต้องการ กรุณาระบุเหตุผลเพื่อให้ลูกค้าเข้าใจ",
                                                type: 'question',
                                                showCancelButton: true,
                                                confirmButtonColor: '#818384',
                                                cancelButtonColor: '#4caf50',
                                                confirmButtonText: 'ใช่, ฉันขอปฏิเสธการแก้ไข',
                                                cancelButtonText: 'ขอคิดดูก่อน',
                                              }).then((result) => {
                                                if (result.value) {
                                                     swal.fire({
                                                        input: 'textarea',
                                                        title: 'ระบุเหตุผลที่ไม่ต้องการแก้ไข',
                                                        inputPlaceholder: 'กรุณาระบุเหตุผลที่คุณไม่ต้องการแก้ไขปัญหานี้',
                                                        showCancelButton: true

                                                      }).then((text) => {
                                                  $.ajax({
                                                  url: '/storemanager/store/'+store_username+'/service-order/'+order_id+'/rejectcustomereditrequest/',
                                                  type: "GET",
                                                  dataType: "json",
                                                  data: {conversation_id:conversation_id, text},
                                                  success:function(data) {
                                                    setTimeout(function() {document.location.reload(true)}, 2000);
                                                    }
                                                 });
                                               })
                                                }
                                              })
                                            });
                                          });
                                       </script>

                       @endif

                       @if(Request::is('storemanager/store/*/service-order/*'))
                        <script type="text/javascript">
                        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                            event.preventDefault();
                            $(this).ekkoLightbox();
                        });
                        </script>

                        <script type="text/javascript">
                           // enable fileuploader plugin
                           $('input[class="service-order-progress-edit-response-photo"]').fileuploader({
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

                               <script type="text/javascript">
                                $(document).ready(function(){
                                  $('.accept-customer-edit-request').click(function(){
                                    var order_id = $(this).attr("data-order-id");
                                    var conversation_id = <?php echo $conversation_id; ?>;
                                    var store_username = "<?php echo $store->username ?>";
                                    swal.fire({
                                        title: 'ยอมรับและแก้ไขงาน?',
                                        text: "คุณจะยอมรับและแก้ไขงานตามที่ลูกค้าต้องการ",
                                        type: 'question',
                                        showCancelButton: true,
                                        confirmButtonColor: '#4caf50',
                                        cancelButtonColor: '#818384',
                                        confirmButtonText: 'ใช่, ฉันจะยอมรับ',
                                        cancelButtonText: 'ขอคิดดูก่อน',
                                      }).then((result) => {
                                        if (result.value) {
                                          swal.fire(
                                            'คุณได้ยอมรับการแก้ไขงานแล้ว!',
                                            'กรุณาแก้ไขงานตามที่ลูกค้าต้องการ',
                                            'success'
                                          )

                                          $.ajax({
                                          url: '/storemanager/store/'+store_username+'/service-order/'+order_id+'/acceptcustomereditrequest/',
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
                                $(document).ready(function(){
                                  $('.reject-customer-edit-request').click(function(){
                                    var order_id = $(this).attr("data-order-id");
                                    var conversation_id = <?php echo $conversation_id; ?>;
                                    var store_username = "<?php echo $store->username ?>";
                                    swal.fire({
                                        title: 'ปฏิเสธการแก้ไข?',
                                        text: "คุณไม่ต้องการแก้ไขงานตามที่ลูกค้าต้องการ กรุณาระบุเหตุผลเพื่อให้ลูกค้าเข้าใจ",
                                        type: 'question',
                                        showCancelButton: true,
                                        confirmButtonColor: '#818384',
                                        cancelButtonColor: '#4caf50',
                                        confirmButtonText: 'ใช่, ฉันขอปฏิเสธการแก้ไข',
                                        cancelButtonText: 'ขอคิดดูก่อน',
                                      }).then((result) => {
                                        if (result.value) {
                                             swal.fire({
                                                input: 'textarea',
                                                title: 'ระบุเหตุผลที่ไม่ต้องการแก้ไข',
                                                inputPlaceholder: 'กรุณาระบุเหตุผลที่คุณไม่ต้องการแก้ไขปัญหานี้',
                                                showCancelButton: true

                                              }).then((text) => {
                                          $.ajax({
                                          url: '/storemanager/store/'+store_username+'/service-order/'+order_id+'/rejectcustomereditrequest/',
                                          type: "GET",
                                          dataType: "json",
                                          data: {conversation_id:conversation_id, text},
                                          success:function(data) {
                                            setTimeout(function() {document.location.reload(true)}, 2000);
                                            }
                                         });
                                       })
                                        }
                                      })
                                    });
                                  });
                                  </script>
                       @endif

                       @if(Request::is('storemanager/store/*/articles/create'))
                       <script type="text/javascript">
                          // enable fileuploader plugin
                          $('input[name="articlecoverphoto"]').fileuploader({
                             extensions: null,
                             changeInput: ' ',
                             theme: 'thumbnails',
                             limit: 1,
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

</body>
</html>
