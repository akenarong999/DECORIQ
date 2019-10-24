<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.sellertemplate')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection

@section('content')

  <section id="seller-dashboard-add-product-page">
     <div class="container bg-white border mt-3 p-5">
       <h1>Add product</h1>
       <div class="add-product-form mt-3 border-top pt-3">
       <form>
          <div class="form-group">
            <label for="exampleFormControlInput1">Product title</label>
            <input type="email" class="form-control" id="exampleFormControlInput1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Category</label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option>Please select category</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Sub-category</label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option>Please select sub-category</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Short description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Full description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>




          <div  class="form-group">
             <label for="exampleFormControlSelect1">Product type</label>
          <ul  class="nav nav-pills">
            <li>
              <a class="btn btn-secondary active" class="text-black" href="#single-product" data-toggle="tab">
               Single
              </a>
            </li>
            <li>
              <a class="btn btn-secondary" class="text-black" href="#variable-product" data-toggle="tab">
               Variable
              </a>
            </li>

              </ul>

                <div class="tab-content clearfix p-4 border">
                  <div class="tab-pane active" id="single-product">
                      <div class="form-group">
                        <label for="exampleFormControlInput1">Price</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">Weight</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">SKU</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">Available stock</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1">
                      </div>
                  </div>

                  <div class="tab-pane" id="variable-product">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Attributes</label>
                      <textarea class="form-control" name="name"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Price</label>
                      <input type="email" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Weight</label>
                      <input type="email" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">SKU</label>
                      <input type="email" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Available stock</label>
                      <input type="email" class="form-control" id="exampleFormControlInput1">
                    </div>



                  </div>

                </div>
            </div>
          <button type="button" class="btn btn-primary col-12" name="button">Submit</button>
        </form>
        </div>

     </div>






   </section>


@endsection
