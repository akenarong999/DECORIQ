<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.sellertemplate')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection

@section('content')

  <section id="seller-dashboard-message">
    <div class="container border bg-white mt-3 ">
      <div class="row">
        <div class="col-sm-3 d-block no-padding-left no-padding-right">
           <div class="h-100">
              <div class="w-100">
                <input type="text" class="form-control border-radius-0 p-2" placeholder="search contact...">
              </div>
              <div class="w-100" id="message-contact">
                <ul class="list-group">
                  <li class="list-group-item border-radius-0">
                    <a href="#">
                          <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" style="width:20%" alt="">
                     <div class="d-inline-block float-center align-middle pl-2">
                       <span>APonrlort lomyen</span><br>
                       <span class="small text-success">online</span>
                     </div>
                    </a>
                  </li>
                  <li class="list-group-item border-radius-0">
                    <a href="#">
                      <div class="d-inline align-middle w-100">
                          <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" style="width:20%" alt="">
                      </div>
                     <div class="d-inline-block float-center align-middle pl-2">
                       <span>APonrlort lomyen</span><br>
                       <span class="small text-warning">away</span>
                     </div>
                   </a>
                  </li>
                  <li class="list-group-item border-radius-0">
                    <a href="#">
                      <div class="d-inline align-middle w-100">
                          <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" style="width:20%" alt="">
                      </div>
                     <div class="d-inline-block float-center align-middle pl-2">
                       <span>APonrlort lomyen</span><br>
                       <span class="small text-secondary">offline</span>
                     </div>
                   </a>
                  </li>
                  <li class="list-group-item border-radius-0">
                    <a href="#">
                      <div class="d-inline align-middle w-100">
                          <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" style="width:20%" alt="">
                      </div>
                     <div class="d-inline-block float-center align-middle pl-2">
                       <span>APonrlort lomyen</span><br>
                       <span class="small text-danger">busy</span>
                     </div>
                   </a>
                  </li>
                  <li class="list-group-item border-radius-0">
                    <a href="#">
                      <div class="d-inline align-middle w-100">
                          <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" style="width:20%" alt="">
                      </div>
                     <div class="d-inline-block float-center align-middle pl-2">
                       <span>APonrlort lomyen</span><br>
                       <span class="text-muted">09/11/2018</span>
                     </div>
                   </a>
                  </li>
                  <li class="list-group-item border-radius-0">
                    <a href="#">
                      <div class="d-inline align-middle w-100">
                          <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" style="width:20%" alt="">
                      </div>
                     <div class="d-inline-block float-center align-middle pl-2">
                       <span>APonrlort lomyen</span><br>
                       <span class="text-muted">09/11/2018</span>
                     </div>
                   </a>
                  </li>
                  <li class="list-group-item border-radius-0">
                    <a href="#">
                      <div class="d-inline align-middle w-100">
                          <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" style="width:20%" alt="">
                      </div>
                     <div class="d-inline-block float-center align-middle pl-2">
                       <span>APonrlort lomyen</span><br>
                       <span class="text-muted">09/11/2018</span>
                     </div>
                   </a>
                  </li>
                  <li class="list-group-item border-radius-0">
                    <a href="#">
                      <div class="d-inline align-middle w-100">
                          <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" style="width:20%" alt="">
                      </div>
                     <div class="d-inline-block float-center align-middle pl-2">
                       <span>APonrlort lomyen</span><br>
                       <span class="text-muted">09/11/2018</span>
                     </div>
                   </a>
                  </li>
                  <li class="list-group-item border-radius-0">
                    <a href="#">
                      <div class="d-inline align-middle w-100">
                          <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" style="width:20%" alt="">
                      </div>
                     <div class="d-inline-block float-center align-middle pl-2">
                       <span>APonrlort lomyen</span><br>
                       <span class="text-muted">09/11/2018</span>
                     </div>
                    </a>
                  </li>
                </ul>
              </div>
           </div>
        </div>
        <div class="col-sm-9 no-padding-right no-padding-left">
          <div class="border p-3" id="message-box-header">
            <div class="d-inline align-middle w-100">
                <img src="https://randomuser.me/api/portraits/men/2.jpg" class="rounded-circle" style="max-width:60px;max-height:60px;width:auto;height:auto;" alt="">
            </div>
           <div class="d-inline-block float-center align-middle pl-2">
             <span>Michael weston</span><br>
             <span class="font-italic">Typing...</span>
           </div>
          </div>
          <div id="message-area" class="p-3">
            <div class="">
              <div class="bg-white border-radius-0 w-50 p-3 text-dark m-2">
              <div class="font-weight-bold">Michael Weston:</div>
              <div class="font-weight-light">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </div>
              <div class="text-light-gray">10:00am</div>
              </div>
            </div>
            <div class="bg-white border-radius-0 w-50 p-3 text-dark m-2 float-right">
              <div class="font-weight-bold">Muse Furniture:</div>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              <div class="text-light-gray">10:00am</div>
            </div>
          </div>
          <div id="reply-area" class="border-top">
           <button type="button" class="btn btn-secondary align-top border-radius-0 float-left" name="button"><i class="themify ti ti-image"></i> </button><input type="text" name="name" class="form-control border-radius-0 d-inline" id="reply-textarea" style="width:84%;resize:none;"><button type="button" class="btn btn-primary align-top border-radius-0 float-right" name="button">Send</button>
          </div>
        </div>
      </div>
    </div>
   </section>


@endsection
