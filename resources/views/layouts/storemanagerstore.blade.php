
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/themify.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-tagsinput.css') }}">
    </head>
    <body>

      <nav id="seller-navbar" class="navbar navbar-expand-md navbar-light py-2 bg-white">
         <div class="container">
              <div class="navbar-header">
               <a href="#" class="navbar-brand text-primary pt-3">
                <img class="rounded-circle mr-2 d-inline" width="45" src="#"> Seller Center</a>> Shop: Muse Furniture

               <button type="button" name="button" class="navbar-toggler ml-auto" data-toggle="collapse" data-target="#navbarCollapse">
                 <span class="navbar-toggler-icon"></span>
               </button>
               </div>

               <div class="collapse navbar-collapse" id="navbarCollapse">
                 <ul class="nav navbar-nav">

                 </ul>
                 <ul class="nav navbar-nav navbar-right ml-auto">
                   <li class="nav-item">
                       <a href="#" class="nav-link"> <img class="rounded-circle" width="45" src="/images/{{Auth::user()->photo ? Auth::user()->photo->file : 'https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png'}}"></a>
                   </li>
                   <li class="nav-item dropdown">
                     <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>{{ Auth::user()->name }}</span> <i class="themify ti ti-angle-down font-weight-bold"></i></a>
                     <ul class="dropdown-menu ml-auto">
                       <li class="dropdown-item" href="#">Action</li>
                       <li class="dropdown-item" href="#">Another action</li>
                       <li class="dropdown-item" href="#">Something else here</li>
                       <li class="dropdown-item" href="#">Separated link</li>
                     </ul>
                   </li>
                   <li class="nav-item" id="notification">
                     <a href="#" class="nav-link themify ti ti-bell d-inline">
                       <span class="badge badge-danger num" id="sidebar-notification-badge">33</span>
                     </a><span class="d-md-none">Notification</span>
                   </li>
                   <li class="nav-item" id="notification">
                     <a href="#" class="nav-link themify ti ti-comments d-inline">
                       <span class="badge badge-danger num" id="sidebar-notification-badge">122</span>
                     </a><span class="d-md-none">Chat</span>
                   </li>
                 </ul>


               </div>
             </div>
      </nav>

        @section('sidebar')


          <!-- Sidebar -->
        <div id="menu-toggle">
        <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                    <a href="/storemanager/store/{{$store->name}}/dashboard">Dashboard <div class="sidebar-icon"><i class="ti ti-home text-primary"></i></div></a>
                </li>
                <li>
                    <a href="/seller-dashboard-order">Order <span class="badge badge-danger" id="sidebar-notification-badge">12</span><div class="sidebar-icon"><i class="ti ti-receipt"></i></div></a>
                </li>
                <li>
                    <a href="/seller-dashboard-message">Messages <span class="badge badge-danger" id="sidebar-notification-badge">22</span><div class="sidebar-icon"><i class="ti ti-comments text-teal"></i></div></a>
                </li>
                <li>
                    <a href="/storemanager/store/{{$store->name}}/products">Products <div class="sidebar-icon"><i class="ti ti-package text-secondary"></i></div></a>
                </li>
                <li>
                    <a href="/storemanager/store/{{$store->name}}/shippings">Shipping <div class="sidebar-icon"><i class="ti ti-truck text-success"></i></div></a>
                </li>
                <li>
                    <a href="/seller-dashboard-coupon">Coupons <div class="sidebar-icon"><i class="ti ti-ticket text-warning"></i></div></a>
                </li>
                <li>
                    <a href="#">Report <div class="sidebar-icon"><i class="ti-bar-chart text-info"></i></div></a>
                </li>
                <li>
                    <a href="#">Articles <div class="sidebar-icon"><i class="ti ti-write text-danger"></i></div></a>
                </li>
                <li>
                    <a href="#">Shop setting <div class="sidebar-icon"><i class="ti ti-settings text-dark"></i></div></a>
                </li>
            </ul>
          </div>
          </div>
          </div>
          <!-- /#sidebar-wrapper -->

        @show


          @yield('content')

       <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
       <script type="text/javascript" src="{{ asset('js/drop_uploader.js') }}"></script>
       <script type="text/javascript" src="{{ asset('js/jquery.fileuploader.min.js') }}"></script>
       <script src="http://jvectormap.com/js/jquery-jvectormap-th-mill.js"></script>
       <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
       <script type="text/javascript" src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>


       <script type="text/javascript">
           $(document).ready( function () {
             $('#table_id').DataTable();
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


            @if(Request::is('storemanager/store/*/products'))
              <script>
                  var value=1;
                  $("#btnAdd").click(function(){
                      $(".remove").first().remove();
                      value=value+1;
                      $("#VariableBoxContainer").append('<div class="row mb-2 mt-3 variation-row border-bottom"><div class="col-sm-2"><label for="product"><label><input type="file" onchange="readURL(this,'+value+');" style="display:none" name="file[]" /><img id="image-preview-'+value+'" class="img-fluid" src="http://placehold.it/180" alt="your image" /></div><div class="col-sm-3"><label>Variation #'+value+'</label><input type="text" name="variationname[]" class="form-control" placeholder=""></div><div class="col-sm-2"><label>Price</label><input type="text" name="variationprice[]" class="form-control"></div><div class="col-sm-2"><label>Weight(kg)</label><input name="variationweight[]" type="text" class="form-control"></div> <div class="col-sm-2"><label>Stock</label><input name="variationstock[]" type="text" class="form-control"></div><div class="col-sm-1"><label>&nbsp;</label><br><div class="startremove"><button type="button" class="btn btn-danger remove">x</button></div></div>');
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
                                 url: '/storemanager/store/{{$store->name}}/products/getsubcategoriesajax/'+category_id,
                                 type: "GET",
                                 dataType: "json",
                                 success:function(data) {
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

               <script type="text/javascript">
                     $(document).ready(function() {
                     setTimeout(
                     function(){
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
                           }
                          else{
                                $('select[name="category_id"]').append('<option value="">No Sub Category</option>');
                           }

                    },1500);
                    });
               </script>
            @endif

          <script>
             $('#producttypetab').on("click", "li", function (event) {
                var activeTab = $(this).find('a').attr('href').split('#')[1].split('-')[0];
                $('#producttype').val(activeTab);
              });
          </script>

          <script>
            var upload = new FileUploadWithPreview('myUniqueUploadId');
          </script>

          @if(Request::is('storemanager/store/*/products/*/edit'))

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
           @endif


           @if(Request::is('storemanager/store/*/shippings/*/edit'))
           <script>
               var shipping_weightbases_array_count=<?php echo $shipping_weightbases_array_count ?>;

               $("#btnAdd").click(function(){
                   $(".remove").first().remove();
                   shipping_weightbases_array_count=shipping_weightbases_array_count+1;
                   $("#WeightbaseBoxContainer").append('<div class="row mb-2 mt-4 weightbase-row"><div class="col-sm-4"><label>Weight above (> kg)</label><input type="text" name="weightbaseminweight[]" class="form-control" placeholder=""></div><div class="col-sm-4"><label>Weight below (<= kg)</label><input type="text" name="weightbasemaxweight[]" class="form-control"></div><div class="col-sm-3"><label>Cost</label><input name="weightbasecost[]" type="text" class="form-control"></div><div class="col-sm-1"><label>&nbsp;</label><br><div class="startremove"><button type="button" class="btn btn-danger remove">x</button></div></div>');
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
                  itemText  : 'name_in_thai',
                  maxChars: 10,
                  trimValue: true,
                  allowDuplicates : false,
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
                                displayKey: 'name_in_thai',
                                source: allowlocations.ttAdapter(),
                                templates: {
                                    empty: [
                                        '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                                    ],
                                    header: [
                                        '<ul class="list-group">'
                                    ],
                                    suggestion: function (data) {
                                        return '<li class="list-group-item">' + data.name_in_thai + '</li>'
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
                    itemText  : 'name_in_thai',
                    maxChars: 10,
                    trimValue: true,
                    allowDuplicates : false,
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
                                     name: 'notallowlocations',
                                  itemValue: 'id',
                                  displayKey: 'name_in_thai',
                                  source: notallowlocations.ttAdapter(),
                                  templates: {
                                      empty: [
                                          '<ul class="list-group"><li class="list-group-item">Nothing found.</li></ul>'
                                      ],
                                      header: [
                                          '<ul class="list-group">'
                                      ],
                                      suggestion: function (data) {
                                          return '<li class="list-group-item">' + data.name_in_thai + '</li>'
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




    </body>
</html>
