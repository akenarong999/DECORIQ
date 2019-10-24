<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.sellertemplate')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection

@section('content')

  <section id="seller-dashboard-product-main">
    <div class="container bg-white border mt-3 p-5">
      <div class="row">
       <div class="col-6">
          <h1>Product</h1>
       </div>
       <div class="col-6 text-right">
          <a class="btn btn-primary" href="/seller-dashboard-add-product">
            <i class="themify ti ti-plus font-weight-bold"></i> Add product
          </a>
       </div>
       </div>
       <table class="table table-hover">
       <thead>
         <tr>
           <th scope="col" style="width:10%">No.</th>
           <th scope="col" style="width:10%">Image</th>
           <th scope="col" style="width:45%">Product name</th>
           <th scope="col" style="width:10%">Price</th>
           <th scope="col" style="width:15%">Publish</th>
           <th scope="col" style="width:10%">Command</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td>00001</td>
           <td><img src="http://via.placeholder.com/120x120"></td>
           <td>ต้นไม้ประดิษฐ์ในกรอบรูปติดผนัง มีหลายแบบ</td>
           <td>100-200 ฿	</td>
           <td><div class="custom-switch custom-switch-label-onoff">
              <input class="custom-switch-input" id="ADD_ID_HERE" type="checkbox" checked>
              <label class="custom-switch-btn" for="ADD_ID_HERE"></label>
            </div>
          </td>
          <td><a href="#" title="edit product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a> <a href="#" title="watch product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-eye"></i></a></td>
         </tr>
         <tr>
           <td>00001</td>
           <td><img src="http://via.placeholder.com/120x120"></td>
           <td><div>ต้นไม้ประดิษฐ์ในกรอบรูปติดผนัง มีหลายแบบ</div><div class="text-muted">หมวดหมู่: ต้นไม้ประดิษฐ์</div></td>
           <td>100-200 ฿	</td>
           <td><div class="custom-switch custom-switch-label-onoff">
              <input class="custom-switch-input" id="ADD_ID_HERE" type="checkbox" checked>
              <label class="custom-switch-btn" for="ADD_ID_HERE"></label>
            </div>
          </td>
          <td><a href="#" title="edit product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a> <a href="#" title="watch product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-eye"></i></a></td>
         </tr>
         <tr>
           <td>00001</td>
           <td><img src="http://via.placeholder.com/120x120"></td>
           <td>ต้นไม้ประดิษฐ์ในกรอบรูปติดผนัง มีหลายแบบ</td>
           <td>100-200 ฿	</td>
           <td><div class="custom-switch custom-switch-label-onoff">
              <input class="custom-switch-input" id="ADD_ID_HERE" type="checkbox" checked>
              <label class="custom-switch-btn" for="ADD_ID_HERE"></label>
            </div>
          </td>
          <td><a href="#" title="edit product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a> <a href="#" title="watch product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-eye"></i></a></td>
         </tr>
         <tr>
           <td>00001</td>
           <td><img src="http://via.placeholder.com/120x120"></td>
           <td>ต้นไม้ประดิษฐ์ในกรอบรูปติดผนัง มีหลายแบบ</td>
           <td>100-200 ฿	</td>
           <td><div class="custom-switch custom-switch-label-onoff">
              <input class="custom-switch-input" id="ADD_ID_HERE" type="checkbox" checked>
              <label class="custom-switch-btn" for="ADD_ID_HERE"></label>
            </div>
          </td>
          <td><a href="#" title="edit product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a> <a href="#" title="watch product" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-eye"></i></a></td>
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
