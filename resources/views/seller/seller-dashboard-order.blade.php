<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.sellertemplate')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection

@section('content')

  <section id="seller-dashboard-order-main">
    <div class="container bg-white border mt-3 p-5">
      <h1>Order</h1>
      <div class="row mt-2 mb-5">
          <div class="col-lg-4 mt-2">
            <form class="form-inline" action="index.html" method="post">
             <label for="exampleFormControlSelect1" class="pr-1 col-3  d-block text-right">Month: </label>
             <select class="form-control col-5 mr-1" id="exampleFormControlSelect1">
               <option>- Select month -</option>
               <option>January 2018</option>
               <option>February 2018</option>
               <option>March 2018</option>
               <option>April 2018</option>
               <option>May 2018</option>
             </select>
             <button type="button" class="btn btn-primary col-3" name="button">Show</button>
             </form>
           </div>
           <div class="col-lg-4 mt-2">
            </div>
            <div class="col-lg-4 mt-2">
              <form class="form-inline" action="index.html" method="post">
               <label for="exampleFormControlSelect1" class="pr-1 col-3 d-block text-right">Search: </label>
                <input type="text" class="form-control col-5 mr-1"  name="" value="">
               <button type="button" class="btn btn-primary col-3" name="button">Search</button>
               </form>
             </div>
      </div>
      <ul class="list-inline lead">
        <li class="list-inline-item border-right pr-3 pl-3"><a class="text-center" target="_blank" href="#">All</a></li>
        <li class="list-inline-item border-right pr-3 pl-3"><a class="social-icon text-center" target="_blank" href="#">Awating payment</a></li>
        <li class="list-inline-item border-right pr-3 pl-3"><a class="social-icon text-center" target="_blank" href="#">Processing</a></li>
        <li class="list-inline-item border-right pr-3 pl-3"><a class="social-icon text-center" target="_blank" href="#">Delivering</a></li>
        <li class="list-inline-item border-right pr-3 pl-3"><a class="social-icon text-center" target="_blank" href="#">Completed</a></li>
        <li class="list-inline-item border-right pr-3 pl-3"><a class="social-icon text-center" target="_blank" href="#">Cancelled</a></li>
        <li class="list-inline-item pr-3 pl-3"><a class="social-icon text-center" target="_blank" href="#">Return/Refund</a></li>
      </ul>
      <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col" style="width:8%">No.</th>
          <th scope="col" style="width:32%">Name</th>
          <th scope="col" style="width:20%">Date</th>
          <th scope="col" style="width:20%">Total</th>
          <th scope="col" style="width:20%">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"><a href="#">10504</a></th>
          <td>Jacob price<br><span class="text-muted">Keas 69 Str. 15234, Chalandri Athens, Greece</span></td>
          <td>08/4/2018	</td>
          <td>1,200 ฿	</td>
          <td><span class="badge badge-pill badge-warning">Pending payment</span></td>
        </tr>
        <tr>
          <th scope="row"><a href="#">02115</a></th>
          <td>เอกณรงค์ สุขสุภกิจ<br><span class="text-muted">159/41-44 อาคารเสริมมิตรทาวเวอร์ ชั้น 27-30 สุขุมวิท 21(อโศก) คลองเตยเหนือ วัฒนา กรุงเทพฯ 10110</span></td>
          <td>08/4/2018</td>
          <td>20 ฿</td>
          <td><span class="badge badge-pill badge-primary">Processing</span></td>
        </tr>
        <tr>
          <th scope="row"><a href="#">02114</a></th>
          <td>Udomsuk seksan<br><span class="text-muted">476/5 Pattanakarn Soi 53, Suanluang, Suanluang  12312</span></td>
          <td>07/4/2018</td>
          <td>900 ฿</td>
          <td><span class="badge badge-pill badge-success">Delivered</span></td>
        </tr>
        <tr>
          <th scope="row"><a href="#">02113</a></th>
          <td>Michael Bolton<br><span class="text-muted">131-151 Great Titchfield St, Fitzrovia, London W1W 5BB </span></td>
          <td>07/4/2018</td>
          <td>13,200 ฿</td>
          <td><span class="badge badge-pill badge-success">Delivered</span></td>
        </tr>
        <tr>
          <th scope="row"><a href="#">02112</a></th>
          <td>John Wick<br><span class="text-muted">417 Vista Ln, Murrysville, PA; 200 Cloverleaf Dr, Delmont, PA</span></td>
          <td>07/4/2018</td>
          <td>100 ฿</td>
          <td><span class="badge badge-pill badge-success">Delivered</span></td>
        </tr>
      </tbody>
    </table>
    <div class="row">
      <div  class="mx-auto">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
            </nav>
        </div>
      </div>

   </div>
   </section>

@endsection
