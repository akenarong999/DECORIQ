<!doctype html>
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
    </head>
    <body>

      <nav id="seller-navbar" class="navbar navbar-expand-md navbar-light py-2 bg-white">
         <div class="container">
              <div class="navbar-header">
               <a href="/seller" class="navbar-brand text-primary pt-3">
                <img class="rounded-circle mr-2 d-inline" width="45" src="https://www.wazzadu.com/uploads/profile/7c721870-efb5-11e6-8518-29e6331eefc0.png"> Seller Center</a>> Shop: XX

               <button type="button" name="button" class="navbar-toggler ml-auto" data-toggle="collapse" data-target="#navbarCollapse">
                 <span class="navbar-toggler-icon"></span>
               </button>
               </div>

               <div class="collapse navbar-collapse" id="navbarCollapse">
                 <ul class="nav navbar-nav">

                 </ul>
                 <ul class="nav navbar-nav navbar-right ml-auto">
                   <li class="nav-item">
                       <a href="#" class="nav-link"> <img class="rounded-circle" width="45" src="https://hips.hearstapps.com/rover/profile_photos/7d2baa08-7816-4026-982a-8c81a6734bee_1520354300.file?fill=1:1&resize=200:*"></a>
                   </li>
                   <li class="nav-item dropdown">
                     <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>Akenarong Suksupakit</span> <i class="themify ti ti-angle-down font-weight-bold"></i></a>
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
                    <a href="/seller-dashboard">Dashboard <div class="sidebar-icon"><i class="ti ti-home text-primary"></i></div></a>
                </li>
                <li>
                    <a href="/seller-dashboard-order">Order <span class="badge badge-danger" id="sidebar-notification-badge">12</span><div class="sidebar-icon"><i class="ti ti-receipt"></i></div></a>
                </li>
                <li>
                    <a href="/seller-dashboard-message">Messages <span class="badge badge-danger" id="sidebar-notification-badge">22</span><div class="sidebar-icon"><i class="ti ti-comments text-teal"></i></div></a>
                </li>
                <li>
                    <a href="/seller-dashboard-product">Products <div class="sidebar-icon"><i class="ti ti-package text-secondary"></i></div></a>
                </li>
                <li>
                    <a href="/seller-dashboard-shipping">Shipping <div class="sidebar-icon"><i class="ti ti-truck text-success"></i></div></a>
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
       <script src="http://jvectormap.com/js/jquery-jvectormap-th-mill.js"></script>

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
            $(document).ready(function(){
            Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element
              // The configuration we've talked about above
              url: '/adsf/',
              previewsContainer: ".dropzone-previews",
              uploadMultiple: true,
              parallelUploads: 100,
              maxFiles: 100
            }

            });
            </script>

            <script>
            $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
            })
            </script>
            <script>
              var upload = new FileUploadWithPreview('myUniqueUploadId');
            </script>

    </body>
</html>
