<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.sellertemplate')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection

@section('content')

  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 p-5">
       <h2>Coupon</h2>
       <div class="border-top mt-4 pt-4">
         <div class="row">
            <div class="col-6">
              <h4>Your Shop Coupon</h4>
              <span class="text-muted">You can create these coupon to let's customers use at your shop.</span>
            </div>
            <div class="col-6 text-right">
               <a class="btn btn-primary" href="/seller-dashboard-add-coupon"><i class="themify ti ti-plus font-weight-bold"></i> Add coupon</a>
            </div>
          </div>
       </div>
         <div class="col-12 border-bottom">
            <table class="table table-hover mt-3">
            <thead>
              <tr>
                <th scope="col" style="width:10%">No.</th>
                <th scope="col" style="width:13%">Coupon code</th>
                <th scope="col" style="width:15%">Counpon type</th>
                <th scope="col" style="width:5%">Value</th>
                <th scope="col" style="width:20%">Description</th>
                <th scope="col" style="width:12%">Product limit</th>
                <th scope="col" style="width:5%">Usage limit</th>
                <th scope="col" style="width:5%">Expire date</th>
                <th scope="col" style="width:10%">Command</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                 <td>00001</td>
                 <td><a href="#">CHRIMST</a></td>
                 <td>Percentage coupon</td>
                 <td>10%</td>
                 <td>Christmas 2019 coupon to be use in this festival</td>
                 <td>WLKS-1000</td>
                 <td>0/10</td>
                 <td>10/11/2019</td>
                 <td><a href="#" title="edit product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a> <a href="#" title="watch product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-trash"></i></a></td>
              </tr>
              <tr>
                <td>00001</td>
                <td><a href="#">CHRIMST</a></td>
                <td>Percentage coupon</td>
                <td>10%</td>
                <td>Christmas 2019 coupon to be use in this festival</td>
                <td>WLKS-1000</td>
                <td>0/10</td>
                <td>10/11/2019</td>
                <td><a href="#" title="edit product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a> <a href="#" title="watch product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-trash"></i></a></td>
              </tr>
              <tr>
                <td>00001</td>
                <td><a href="#">CHRIMST</a></td>
                <td>Percentage coupon</td>
                <td>10%</td>
                <td>Christmas 2019 coupon to be use in this festival</td>
                <td>WLKS-1000</td>
                <td>0/10</td>
                <td>10/11/2019</td>
                <td><a href="#" title="edit product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a> <a href="#" title="watch product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-trash"></i></a></td>
              </tr>

            </tbody>
          </table>
       </div>

           <div class="mt-5 pt-4">
             <div class="row">
                <div class="col-12">
                  <h4>DECORIQ Coupon</h4>
                  <span class="text-muted">Coupons that you can give to your customers.</span>
                </div>
              </div>
           </div>
             <div class="col-12 border-bottom">
                <table class="table table-hover mt-3">
                <thead>
                  <tr>
                    <th scope="col" style="width:10%">No.</th>
                    <th scope="col" style="width:15%">Coupon code</th>
                    <th scope="col" style="width:20%">Counpon type</th>
                    <th scope="col" style="width:5%">Value</th>
                    <th scope="col" style="width:20%">Description</th>
                    <th scope="col" style="width:15%">Product limit</th>
                    <th scope="col" style="width:5%">Usage limit</th>
                    <th scope="col" style="width:5%">Expire date</th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                     <td>00001</td>
                     <td><a href="#">CHRIMST</a></td>
                     <td>Percentage coupon</td>
                     <td>10%</td>
                     <td>Christmas 2019 coupon to be use in this festival</td>
                     <td>WLKS-1000</td>
                     <td>0/10</td>
                     <td>10/11/2019</td>

                  </tr>
                  <tr>
                    <td>00001</td>
                    <td><a href="#">CHRIMST</a></td>
                    <td>Percentage coupon</td>
                    <td>10%</td>
                    <td>Christmas 2019 coupon to be use in this festival</td>
                    <td>WLKS-1000</td>
                    <td>0/10</td>
                    <td>10/11/2019</td>

                  </tr>
                  <tr>
                    <td>00001</td>
                    <td><a href="#">CHRIMST</a></td>
                    <td>Percentage coupon</td>
                    <td>10%</td>
                    <td>Christmas 2019 coupon to be use in this festival</td>
                    <td>WLKS-1000</td>
                    <td>0/10</td>
                    <td>10/11/2019</td>

                  </tr>

                </tbody>
              </table>
           </div>
     </div>






   </section>


@endsection
