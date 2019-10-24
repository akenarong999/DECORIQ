<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.sellertemplate')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection

@section('content')

  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 p-5">
       <h1>Add coupon</h1>
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
           <div class="add-coupon-form mt-3 border pt-3 col-9 p-5">
             <form>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Coupon code</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Coupon type</label>
                  <select class="form-control" id="exampleFormControlSelect1">
                    <option>Please select coupon type</option>
                    <option>Percentage coupon</option>
                    <option>Amount coupon</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Value</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Product allowance</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                  <small id="productallowanceHelp" class="form-text text-muted">Coupon will can use in all product if not select.</small>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Usage limit</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Expire date</label>
                  <input type="date" class="form-control" id="exampleFormControlInput1">
                </div>
                <button type="button" class="btn btn-primary col-12" name="button">Submit</button>
              </form>
              </div>
        </div>

     </div>






   </section>


@endsection
