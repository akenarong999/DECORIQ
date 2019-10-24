<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.sellertemplate')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="seller-dashboard-shipping">
       <div class="container bg-white border mt-3 p-5">
         <div class="row">
           <div class="col-9"><h1>Shipping</h1></div>
           <div class="col-3">
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddShippingModal">
                <i class="themify ti ti-plus font-weight-bold"></i> Add shipping method</button></div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="AddShippingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add your new shipping method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="form-group">
                        <label for="Shipping method name">Shipping method name</label>
                        <input type="email" class="form-control" id="ShippingMethodName">
                      </div>
                      <div class="form-group">
                        <label for="Shipping type">Shipping type</label>
                        <select multiple class="form-control" id="shippingType">
                          <option>Flat rate</option>
                          <option>Free shipping</option>
                          <option>Weight based</option>
                          <option>Local pickup</option>
                        </select>
                        <small id="addshippingmethodHelp" class="form-text text-muted">Note: You can edit other details later.</small>
                      </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        <div class="col-6"><h2 class="mt-4">Select Shipping Method to Edit</h2></div>
        <div class="pb-4 mb-5 border-bottom">
           <form action="#" method="post">
             <div class="input-group mb-3">
               <select class="custom-select" id="inputGroupSelect02">
                 <option selected>Select shipping method</option>
                 <option value="1">One</option>
                 <option value="2">Two</option>
                 <option value="3">Three</option>
               </select>
               <div class="input-group-append">
                 <label class="input-group-text" for="inputGroupSelect02">Select</label>
               </div>
             </div>
             <small id="addshippingmethodHelp" class="form-text text-muted">Please select shipping method to edit them.</small>
           </form>
         </div>

         <div class="container">
           <h2 class="mt-4">Edit Shipping Method</h2>
           <div class="row">
             <div class="col-3">
               <div class="custom-file-container" data-upload-id="myUniqueUploadId">
                   <div class="custom-file-container__image-preview" style="margin-bottom:20px !important;"></div>
                   <label class="custom-file-container__custom-file" >
                       <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="*" multiple>
                       <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                       <span class="custom-file-container__custom-file__custom-file-control"></span>
                   </label>
                    <label>Upload File <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">Remove preview</a></label>
               </div>
             </div>
             <div class="col-9 border p-4">

               <h3>Name: Kerry Express (Flat rate)</h3>

               <form class="">
                 <div class="form-group">
                   <label for="">Include area</label>
                   <input type="text" class="form-control" name="" value="">
                 </div>
                 <div class="form-group">
                   <label for="">Exclude area</label>
                   <input type="text" class="form-control" name="" value="">
                 </div>
                 <div class="form-group">
                   <label for="">Delivery cost</label>
                   <input type="text" class="form-control" name="" value="">
                 </div>
               </form>
             </div>
           </div>
         </div>
       </div>
    </section>
@endsection
