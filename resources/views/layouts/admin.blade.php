<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themify.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fade-down.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/webslidemenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/white-gry.css') }}">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-tagsinput.css') }}">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container">
  <a class="navbar-brand  pr-4" href="{{ url('/') }}"><img width="128" src="/images/decoriq_logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="md-input form-inline my-2 my-lg-0 w-100 border-right pr-3">
    </div>
    <ul class="navbar-nav w-50">


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
       <!-- Mobile Header -->
        <div class="wsmain clearfix border-bottom">
          <div class="container">

            <nav class="wsmenu clearfix">
              <ul class="wsmenu-list">

                <li class="nav-item">
                  <a class="navtext" href="/admin/users">
                      <span><i class="themify ti ti-id-badge" ></i> ผู้ใช้</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/admin/stores">
                      <span><i class="themify ti ti-flag" ></i> ร้านค้า</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/admin/products">
                      <span><i class="themify ti ti-package" ></i> สินค้า</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/admin/services">
                      <span><i class="themify ti ti-brush" ></i> บริการ</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/admin/orders">
                      <span><i class="themify ti ti-receipt" ></i> รายการสั่งซื้อ(สินค้า)</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/admin/orders">
                      <span><i class="themify ti ti-receipt" ></i> รายการสั่งซื้อ(บริการ)</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="navtext" href="/admin/webelement">
                      <span><i class="themify ti ti-layout" ></i> องค์ประกอบเว็บ</span>
                  </a>
                </li>



                <!-- Authentication Links -->



                  @if (!Auth::check())

                    <li class="nav-item float-right">
                      <a class="navtext" href="{{ route('login') }}">
                          <span><i class="themify ti ti-user"></i> เข้าสู่ระบบ/สมัครสมาชิก</span>
                      </a>
                    </li>
                    @else

                    <li class="nav-item float-right ">
                      <a class="navtext pt-2 pb-1" href="{{ route('login') }}">
                        <img class="rounded-circle d-inline" width="24" src="/images/{{Auth::user()->photo ? Auth::user()->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}"> <span class="d-inline">{{ Auth::user()->name }}</span>
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




        <main class="mt-3 mb-3">

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
    <p class="text-center">Copyright 2018 DECORIQ</p>

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
    <script type="text/javascript" src="{{ asset('js/drop_uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fileuploader.min.js') }}"></script>
    <script src="http://jvectormap.com/js/jquery-jvectormap-th-mill.js"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
    <script type="text/javascript" src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>

    <script type="text/javascript">
        $(document).ready( function () {
          $('#table_id').DataTable({
            "order": [[ 0, "desc" ]]
          });
        });
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
      var gdpData = {
        "TH-21": 16.63,
        "TH-22": 11.58,
        "TH-10": 158.97,
        "TH-44": 22.58,
      };
      </script>



     <script>
     var ctx = document.getElementById("myChart");
     var myChart = new Chart(ctx, {
             type: 'bar',
             data: {
                 labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                 datasets: [{
                     label: '# of Votes',
                     data: [12, 19, 3, 5, 2, 3],
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


                 @if(Request::is('admin/orders/*'))
                 <script type="text/javascript">

                 function showAddProofofPaymentForm(){
                   $("#add-proof-of-payment-button").hide();
                   $("#add-proof-of-payment-form").css("display", "block");

                 };
                 </script>

                 @endif

                 @if(Request::is('admin/products'))
                 <script type="text/javascript">
                 $('input[class=onoff-switch-input]').on('change', function() {
                   var product_id = $(this).val();
                  if($(this).prop("checked")){
                    $.ajax({
                      url: '/admin/product/setactive',
                      type: "GET",
                      data: {product_id:product_id},
                      dataType: "json",
                      success:function(data) {
                       }
                    });
                  }else{
                    $.ajax({
                      url: '/admin/product/setinactive',
                      type: "GET",
                      data: {product_id:product_id},
                      dataType: "json",
                      success:function(data) {
                       }
                    });
                  }

                  });
                  </script>


                 @endif


                 @if(Request::is('admin/product/edit/*'))

                 <script>
                    $('#producttypetab').on("click", "li", function (event) {
                       var activeTab = $(this).find('a').attr('href').split('#')[1].split('-')[0];
                       $('#producttype').val(activeTab);
                     });
                 </script>

                 <script>
                   var upload = new FileUploadWithPreview('myUniqueUploadId');
                 </script>


                           <script>
                             /* preview image in add product variation */
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
                                              url: '/storemanager/store/{{$store->name}}/products/getparentcategoryajax/'+category_id,
                                              type: "GET",
                                              dataType: "json",
                                              success:function(data) {
                                                    $.each(data, function(key, value) {
                                                         $("select[name='parent_category_id'] option[value='"+key+"'").attr("selected","selected");
                                                    });

                                              }
                                          });
                                      }else{
                                          $('select[name="parent_category_id"]').append('<option value="">XsNo Sub Category</option>');
                                      }

                                      setTimeout(
                                      function(){
                                      var product_id = $("#product_id").val();
                                      var parent_category_id = $("#parentcategories").val();
                                      if(parent_category_id) {
                                          $.ajax({
                                              url: '/storemanager/store/{{$store->name}}/products/getselectedsubcategoryajax/'+parent_category_id+'/'+product_id,
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
                                          $('select[name="category_id"]').append('<option value="">No Sub Category</option>');
                                      }
                                    },1500);
                                   });

                                      $(document).ready(function() {
                                      $('select[name="parent_category_id"]').on('change', function() {
                                        var parent_category_id = $("#parentcategories").val();
                                       if(parent_category_id) {
                                          $.ajax({
                                              url: '/storemanager/store/{{$store->name}}/products/getsubcategoriesajax/'+parent_category_id,
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
                                          $('select[name="category_id"]').append('<option value="">No Sub Category</option>');
                                      }
                                      });

                               });
                            </script>
                            <script>
                               var value=<?php echo $variable_array_count ?>;

                               $("#btnAdd").click(function(){
                                   $(".remove").first().remove();
                                   value=value+1;
                                   $("#VariableBoxContainer").append('<div class="row mb-2 mt-3 variation-row border-bottom"><div class="col-sm-2"><label for="product"><label><input type="file" onchange="readURL(this,'+value+');" style="display:none" name="file[]" /><img id="image-preview-'+value+'" class="img-fluid" src="http://placehold.it/180" alt="your image" /></div><div class="col-sm-3"><label>Variation #'+value+'</label><input type="text" name="variationname[]" class="form-control" placeholder=""></div><div class="col-sm-2"><label>Price</label><input type="text" name="variationprice[]" class="form-control"></div><div class="col-sm-2"><label>Weight(kg)</label><input name="variationweight[]" type="text" class="form-control"></div> <div class="col-sm-2"><label>Stock</label><input name="variationstock[]" type="text" class="form-control"></div><div class="col-sm-1"><label>&nbsp;</label><br><div class="startremove"><button type="button" class="btn btn-danger remove">x</button></div></div>');

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
                            @endif

                            @if(Request::is('admin/stores'))
                            <script type="text/javascript">
                            $('input[class=onoff-switch-input]').on('change', function() {
                              var store_id = $(this).val();
                             if($(this).prop("checked")){
                               $.ajax({
                                 url: '/admin/store/setapprove',
                                 type: "GET",
                                 data: {store_id:store_id},
                                 dataType: "json",
                                 success:function(data) {
                                  }
                               });
                             }else{
                               $.ajax({
                                 url: '/admin/store/setnotapprove',
                                 type: "GET",
                                 data: {store_id:store_id},
                                 dataType: "json",
                                 success:function(data) {
                                  }
                               });
                             }

                             });
                             </script>


                            @endif

                            @if(Request::is('admin/services'))
                            <script type="text/javascript">
                            $('input[class=onoff-switch-input]').on('change', function() {
                              var service_id = $(this).val();
                             if($(this).prop("checked")){
                               $.ajax({
                                 url: '/admin/service/setactive',
                                 type: "GET",
                                 data: {service_id:service_id},
                                 dataType: "json",
                                 success:function(data) {
                                  }
                               });
                             }else{
                               $.ajax({
                                 url: '/admin/service/setinactive',
                                 type: "GET",
                                 data: {service_id:service_id},
                                 dataType: "json",
                                 success:function(data) {
                                   console.log(data);
                                  }
                               });
                             }

                             });
                             </script>


                            @endif


                            @if(Request::is('admin/service/edit/*'))
                            <script type="text/javascript">
                               $(document).ready(function(){
                                       var category_id = $('#subcategories').val();
                                       if(category_id) {

                                           $.ajax({
                                               url: '/storemanager/store/{{$store->username}}/services/getparentcategoryajax/'+category_id,
                                               type: "GET",
                                               dataType: "json",
                                               success:function(data) {
                                                     $.each(data, function(key, value) {
                                                          $("select[name='parent_category_id'] option[value='"+key+"'").attr("selected","selected");
                                                     });

                                               }
                                           });
                                       }

                                       setTimeout(
                                       function(){
                                       var service_id = $("#service_id").val();
                                       var parent_category_id = $("#parentcategories").val();
                                       if(parent_category_id) {
                                           $.ajax({
                                               url: '/storemanager/store/{{$store->username}}/services/getselectedsubcategoryajax/'+parent_category_id+'/'+service_id,
                                               type: "GET",
                                               dataType: "json",
                                               success:function(data) {
                                                     let popped = data.pop();
                                                     $('select[name="service_category_id"]').empty();
                                                     $.each(data[0], function(key, value) {
                                                         $('select[name="service_category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                                           $("#subcategories").val(popped).change();
                                                     });
                                               }
                                           });
                                       }else{
                                           $('select[name="service_category_id"]').append('<option value="">No Sub Category</option>');
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
                                           $('select[name="service_category_id"]').append('<option value="">No Sub Category</option>');
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

                            @endif


                            @if(Request::is('admin/webelement/homepage/editor'))

                            <script type="text/javascript">

                            // enable fileuploader plugin
                            $('input[name="homepage-slideshow"]').fileuploader({
                               extensions: null,
                               changeInput: ' ',
                               theme: 'thumbnails',
                               limit: '5',
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

                         @if(Request::is('admin/pages/edit/*'))
                            <script type="text/javascript">
                               // enable fileuploader plugin
                               $('input[name="pagefile"]').fileuploader({
                                  extensions: null,
                                  changeInput: ' ',
                                  theme: 'thumbnails',
                                  enableApi: true,
                                  addMore: true,
                                  limit:1,
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
