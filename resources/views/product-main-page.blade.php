@extends('layouts.frontend')

@section('title')
หน้าหลักสินค้า - DECORIQ
@endsection

@section('content')

<?php use \App\Http\Controllers\ProductFrontendController; ?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
  </ol>
  <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="/images/product-main-slider-1.jpg">
      </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container mt-5 mb-4">
    <div class="row">
      <div class="col-10 offset-1 text-center">
        <h3><i class="themify ti ti-package"></i> สินค้าเกี่ยวกับบ้าน</h3>
        <h6 class="text-muted">ซื้อของแต่งบ้าน ของใช้ภายในบ้าน วัสดุอุปกรณ์ ที่คุณต้องการจากผู้ผลิตสินค้ามากมายทั่วประเทศ ได้ที่นี่</h6>
      </div>
    </div>
</div>



<div class="container mt-4 mb-4" id="category">
  <div class="row">
    <div class="col-12 p-4 border">
      <h5>เลือกซื้อตามหมวดหมู่</h5>

        <!-- Top Navigation -->
        <div class="content">

            <div class="row">
              <div class="col-6 col-lg-3">
                 <a href="/category/product/สติ๊กเกอร์ติดผนัง">
                    <div class="grid">
                    <figure class="effect-ravi">
                        <img src="/images/wall-sticker-thumb.jpg" alt="Wall Sticker Thumbnail" />
                        <figcaption>
                            <div>
                                <h3 class="d-none d-sm-block">สติ๊กเกอร์ติดผนัง</h3>
                                <h5 class="d-block d-sm-none">สติ๊กเกอร์ติดผนัง</h5>
                                <p>ตกแต่งผนังห้องให้สวยงามด้วยสติ๊กเกอร์ติดผนัง</p>
                            </div>
                        </figcaption>
                    </figure>
                  </div>
                 </a>
                </div>

                <div class="col-6 col-lg-3">
                   <a href="/category/product/ตุ๊กตา-โมเดล">
                      <div class="grid">
                      <figure class="effect-ravi">
                          <img src="/images/doll-model-thumb.jpg" alt="Doll and model thumbnail" />
                          <figcaption>
                              <div>
                                  <h3 class="d-none d-sm-block">ตุ๊กตา/โมเดล</h3>
                                  <h5 class="d-block d-sm-none">ตุ๊กตา/โมเดล</h5>
                                  <p>แต่งบ้านด้วยการวางตุ๊กตาหรือโมเดลเอาไว้ ช่วยสร้างเอกลักษณ์และบอกความเป็นตัวคุณ</p>
                              </div>
                          </figcaption>
                      </figure>
                    </div>
                   </a>
                  </div>

                  <div class="col-6 col-lg-3">
                     <a href="/category/product/ผ้าปูโต๊ะ">
                        <div class="grid">
                        <figure class="effect-ravi">
                            <img src="/images/table-cloth-thumb.jpg" alt="Tablecloth thumbnail" />
                            <figcaption>
                                <div>
                                    <h3 class="d-none d-sm-block">ผ้าปูโต๊ะ</h3>
                                    <h5 class="d-block d-sm-none">ผ้าปูโต๊ะ</h5>
                                    <p>ใช้ผ้าปูโต๊ะตกแต่งโต๊ะอาหาร สร้างบรรยากาศบนโต๊ะอาหารให้ดูมีสไตล์ ให้ทุกมื้ออาหารมีแต่ความสุข</p>
                                </div>
                            </figcaption>
                        </figure>
                      </div>
                     </a>
                    </div>

                    <div class="col-6 col-lg-3">
                       <a href="/category/product/พรมปูพื้น">
                          <div class="grid">
                          <figure class="effect-ravi">
                              <img src="/images/carpet-thumb.jpg" alt="Carpet thumbnail" />
                              <figcaption>
                                  <div>
                                      <h3 class="d-none d-sm-block">พรมปูพื้น</h3>
                                      <h5 class="d-block d-sm-none">พรมปูพื้น</h5>
                                      <p>สร้างมิติให้กับห้องด้วยพรมปูพื้น ทำให้สวยงามและรู้สึกสบายทุกย่างก้าว</p>
                                  </div>
                              </figcaption>
                          </figure>
                        </div>
                       </a>
                      </div>

              </div><!--row -->

              <div class="row">
                <div class="col-6 col-lg-3">
                   <a href="/category/product/ดอกไม้">
                      <div class="grid">
                      <figure class="effect-ravi">
                          <img src="/images/flower-thumb.jpg" alt="Flower Thumbnail" />
                          <figcaption>
                              <div>
                                  <h3 class="d-none d-sm-block">ดอกไม้</h3>
                                  <h5 class="d-block d-sm-none">ดอกไม้</h5>
                                  <p>ใช้ดอกไม้ตกแต่งบ้าน ช่วยทำให้บ้านดูสวยงาม สดชื่นไปตลอดทั้งวัน</p>
                              </div>
                          </figcaption>
                      </figure>
                    </div>
                   </a>
                  </div>

                  <div class="col-6 col-lg-3">
                     <a href="/category/product/ต้นไม้">
                        <div class="grid">
                        <figure class="effect-ravi">
                            <img src="/images/tree-thumbnail.jpg" alt="Tree thumbnail" />
                            <figcaption>
                                <div>
                                    <h3 class="d-none d-sm-block">ต้นไม้</h3>
                                    <h5 class="d-block d-sm-none">ต้นไม้</h5>
                                    <p>สร้างพื้นที่สีเขียวให้กับบ้าน ช่วยให้คนที่อาศัยอยู่ในบ้านสดชื่นและมีความสุข</p>
                                </div>
                            </figcaption>
                        </figure>
                      </div>
                     </a>
                    </div>

                    <div class="col-6 col-lg-3">
                       <a href="/category/product/แจกัน">
                          <div class="grid">
                          <figure class="effect-ravi">
                              <img src="/images/vase-thumb.jpg" alt="Vase thumbnail" />
                              <figcaption>
                                  <div>
                                      <h3 class="d-none d-sm-block">แจกัน</h3>
                                      <h5 class="d-block d-sm-none">แจกัน</h5>
                                      <p>นำดอกไม้มาใส่ในแจกันใบโปรด สร้างความมีชีวิตชีวาให้กับห้องของคุณ	</p>
                                  </div>
                              </figcaption>
                          </figure>
                        </div>
                       </a>
                      </div>

                      <div class="col-6 col-lg-3">
                         <a href="/category/product/กระถาง">
                            <div class="grid">
                            <figure class="effect-ravi">
                                <img src="/images/plant-pot-thumb.jpg" alt="Plant pot thumbnail" />
                                <figcaption>
                                    <div>
                                        <h3 class="d-none d-sm-block">กระถาง</h3>
                                        <h5 class="d-block d-sm-none">กระถาง</h5>
                                        <p>ปลูกต้นไม้สร้างความสดชื่นให้กับบ้านของคุณด้วยกระถางที่สวยงามมีสไตล์	</p>
                                    </div>
                                </figcaption>
                            </figure>
                          </div>
                         </a>
                        </div>

                </div><!--row -->


                <div class="row">
                  <div class="col-6 col-lg-3">
                     <a href="/category/product/เทียน-เชิงเทียน">
                        <div class="grid">
                        <figure class="effect-ravi">
                            <img src="/images/candle-holder-thumb.jpg" alt="Candle Holder Thumbnail" />
                            <figcaption>
                                <div>
                                    <h3 class="d-none d-sm-block">เทียน/เชิงเทียน</h3>
                                    <h5 class="d-block d-sm-none">เทียน/เชิงเทียน</h5>
                                    <p>สร้างบรรยากาศให้กับบ้านยามค่ำคืนด้วยเทียนและเชิงเทียน ที่จะทำให้บรรยากาศดูแสนโรแมนติค</p>
                                </div>
                            </figcaption>
                        </figure>
                      </div>
                     </a>
                    </div>

                    <div class="col-6 col-lg-3">
                       <a href="/category/product/โมบาย-กระดิ่งลม">
                          <div class="grid">
                          <figure class="effect-ravi">
                              <img src="/images/wind-chime-thumb.jpg" alt="Wind Chime thumbnail" />
                              <figcaption>
                                  <div>
                                      <h3 class="d-none d-sm-block">โมบาย/กระดิ่งลม</h3>
                                      <h5 class="d-block d-sm-none">โมบาย/กระดิ่งลม</h5>
                                      <p>แขวนกระดิ่งลม/โมบาย เอาไว้ที่บ้าน ให้เกิดเสียงไพเราะยามกระดิ่งต้องลม และยังช่วยในด้านของฮวงจุ้ยให้กับบ้าน</p>
                                  </div>
                              </figcaption>
                          </figure>
                        </div>
                       </a>
                      </div>

                      <div class="col-6 col-lg-3">
                         <a href="/category/product/โคมไฟ-ไฟตกแต่ง">
                            <div class="grid">
                            <figure class="effect-ravi">
                                <img src="/images/lamp-lighting-thumb.jpg" alt="Lamp and Lighting thumbnail" />
                                <figcaption>
                                    <div>
                                        <h3 class="d-none d-sm-block">โคมไฟ/ไฟตกแต่ง</h3>
                                        <h5 class="d-block d-sm-none">โคมไฟ/ไฟตกแต่ง</h5>
                                        <p>ให้บ้านของคุณสวยงาม สว่างไสวในยามค่ำคืน พร้อมบรรยากาศที่แสนดูดีและน่าอยู่ด้วยโคมไฟและไฟตกแต่ง</p>
                                    </div>
                                </figcaption>
                            </figure>
                          </div>
                         </a>
                        </div>

                        <div class="col-6 col-lg-3">
                           <a href="/category/product/เฟอร์นิเจอร์">
                              <div class="grid">
                              <figure class="effect-ravi">
                                  <img src="/images/furniture-thumb.jpg" alt="Furniture thumbnail" />
                                  <figcaption>
                                      <div>
                                          <h3 class="d-none d-sm-block">เฟอร์นิเจอร์</h3>
                                          <h5 class="d-block d-sm-none">เฟอร์นิเจอร์</h5>
                                          <p>ด้วยเฟอร์นิเจอร์ที่มีสไตล์ นอกจากจะได้ประโยชน์จากการใช้สอย ยังแต่งบ้านให้สวยงามได้อีกด้วย</p>
                                      </div>
                                  </figcaption>
                              </figure>
                            </div>
                           </a>
                          </div>

                  </div><!--row -->


                  <div class="row">
                    <div class="col-6 col-lg-3">
                       <a href="/category/product/หมอน">
                          <div class="grid">
                          <figure class="effect-ravi">
                              <img src="/images/pillow-thumb.jpg" alt="Pillow Thumbnail" />
                              <figcaption>
                                  <div>
                                      <h3 class="d-none d-sm-block">หมอน</h3>
                                      <h5 class="d-block d-sm-none">หมอน</h5>
                                      <p>หมอนนอกจากนุ่ม ใช้ประโยชน์เมื่อเรานอน อีกทั้งยังช่วยแต่งบ้านให้สวยงามได้ อาทิเช่น หมอนอิง</p>
                                  </div>
                              </figcaption>
                          </figure>
                        </div>
                       </a>
                      </div>

                      <div class="col-6 col-lg-3">
                         <a href="/category/product/ของใช้ในบ้าน">
                            <div class="grid">
                            <figure class="effect-ravi">
                                <img src="/images/household-stuff-thumb.jpg" alt="Household stuff thumbnail" />
                                <figcaption>
                                    <div>
                                        <h3 class="d-none d-sm-block">ของใช้ในบ้าน</h3>
                                        <h5 class="d-block d-sm-none">ของใช้ในบ้าน</h5>
                                        <p>เลือกของสำหรับใช้ในบ้าน ที่มีคุณภาพ หยิบใช้สอยได้อย่างมั่นใจ</p>
                                    </div>
                                </figcaption>
                            </figure>
                          </div>
                         </a>
                        </div>

                        <div class="col-6 col-lg-3">
                           <a href="/category/product/ภาพตกแต่ง">
                              <div class="grid">
                              <figure class="effect-ravi">
                                  <img src="/images/art-picture-thumb.jpg" alt="Art picture thumbnail" />
                                  <figcaption>
                                      <div>
                                          <h3 class="d-none d-sm-block">ภาพตกแต่ง</h3>
                                          <h5 class="d-block d-sm-none">ภาพตกแต่ง</h5>
                                          <p>สร้างสีสันให้กับบ้านด้วยภาพตกแต่ง ซึ่งจะติดผนังหรือตั้งโต๊ะก็สวยงามทั้งนั้น</p>
                                      </div>
                                  </figcaption>
                              </figure>
                            </div>
                           </a>
                          </div>

                          <div class="col-6 col-lg-3">
                             <a href="/category/product/ของตกแต่งงานปาร์ตี้">
                                <div class="grid">
                                <figure class="effect-ravi">
                                    <img src="/images/party-stuff-thumb.jpg" alt="Party Stuff thumbnail" />
                                    <figcaption>
                                        <div>
                                            <h3 class="d-none d-sm-block">ของตกแต่งงานปาร์ตี้</h3>
                                            <h5 class="d-block d-sm-none">ของตกแต่งงานปาร์ตี้</h5>
                                            <p>จัดงานปาร์ตี้ให้สนุกกว่าที่เคย ด้วยพร็อพสวยๆ ช่วยเพิ่มความสุขสนุกให้กับทุกคน</p>
                                        </div>
                                    </figcaption>
                                </figure>
                              </div>
                             </a>
                            </div>

                    </div><!--row -->


                    <div class="row">
                      <div class="col-6 col-lg-3">
                         <a href="/category/product/ชั้นวางของ">
                            <div class="grid">
                            <figure class="effect-ravi">
                                <img src="/images/shelf-thumb.jpg" alt="Shelf Thumbnail" />
                                <figcaption>
                                    <div>
                                        <h3 class="d-none d-sm-block">ชั้นวางของ</h3>
                                        <h5 class="d-block d-sm-none">ชั้นวางของ</h5>
                                        <p>วางสิ่งของชิ้นโปรด บนชั้นวางของที่ออกแบบมาเพื่อให้การตกแต่งบ้านของคุณมีความสวยงาม</p>
                                    </div>
                                </figcaption>
                            </figure>
                          </div>
                         </a>
                        </div>

                        <div class="col-6 col-lg-3">
                           <a href="/category/product/ชุดเครื่องนอน">
                              <div class="grid">
                              <figure class="effect-ravi">
                                  <img src="/images/bed-set-thumb.jpg" alt="Bed Set thumbnail" />
                                  <figcaption>
                                      <div>
                                          <h3 class="d-none d-sm-block">ชุดเครื่องนอน</h3>
                                          <h5 class="d-block d-sm-none">ชุดเครื่องนอน</h5>
                                          <p>หลับฝันดีได้ทุกคืนด้วยชุดเครื่องนอนที่คัดสรรคุณภาพมาเพื่อให้ทุกวินาทีที่คุณนอนนั้นเต็มเปี่ยมด้วยความสุข</p>
                                      </div>
                                  </figcaption>
                              </figure>
                            </div>
                           </a>
                          </div>

                          <div class="col-6 col-lg-3">
                             <a href="/category/product/กรอบรูป-ตั้งโต๊ะ">
                                <div class="grid">
                                <figure class="effect-ravi">
                                    <img src="/images/photo-frame-on-table-thumb.jpg" alt="Photo frame on table thumbnail" />
                                    <figcaption>
                                        <div>
                                            <h3 class="d-none d-sm-block">กรอบรูป (ตั้งโต๊ะ)</h3>
                                            <h5 class="d-block d-sm-none">กรอบรูป (ตั้งโต๊ะ)</h5>
                                            <p>เก็บภาพความทรงจำที่น่าประทับใจ ใส่กรอบตั้งไว้บนโต๊ะ ให้รู้สึกดีทุกครั้งที่ได้เห็น	</p>
                                        </div>
                                    </figcaption>
                                </figure>
                              </div>
                             </a>
                            </div>

                            <div class="col-6 col-lg-3">
                               <a href="/category/product/กรอบรูป-ติดผนัง">
                                  <div class="grid">
                                  <figure class="effect-ravi">
                                      <img src="/images/photo-frame-on-wall-thumb.jpg" alt="Photo frame on wall thumbnail" />
                                      <figcaption>
                                          <div>
                                              <h3 class="d-none d-sm-block">กรอบรูป (ติดผนัง)</h3>
                                              <h5 class="d-block d-sm-none">กรอบรูป (ติดผนัง)</h5>
                                              <p>ให้ภาพสวยงามหรือภาพแห่งความทรงจำ ติดอยู่บนฝาผนัง ให้คุณรู้สึกดีและมีพลังบวกทุกๆวัน	</p>
                                          </div>
                                      </figcaption>
                                  </figure>
                                </div>
                               </a>
                              </div>

                      </div><!--row -->

    </div>


    </div>
  </div>
</div>


<div class="container mt-4 mb-4">
  <div class="row">
    <div class="col-12 pt-4 pl-4 pr-4 border">
      <h5>สินค้าใหม่</h5>

          <div class="product-list">
            @foreach($new_products as $product)

              <div class="pl-4 pr-4 mt-4">
                <a href="/product/{{$product->slug}}" style="text-decoration:none;" target="_blank">
                <div class="product-card">
                    <div id="product-front">
                      <div class="shadow"></div>
                      <div class="product-thumb">
                        @if(!empty($product->name))
                        <div class="product-thumb">
                         <img src="/images/{{$product->product_photos[0]->name}}">
                         <?php $stock = ProductFrontendController::checkProductStock($product->id);
                          if($stock==0){ ?>
                            <div class="product-empty-label">สินค้าหมด</div>
                          <?php } ?>
                       </div>
                        @else
                         <img src="https://static.umotive.com/img/product_image_thumbnail_placeholder.png" class="img-fluid">
                        @endif
                      </div>


                      <div class="stats p-1">
                          <div class="stats-container">
                              <p><img class="d-inline rounded-circle"  style="display: block; width: 15px; height: 15px; object-fit: cover;" src="/images/{{$product->store->photo->file}}"> {{$product->store->name}}</p>
                              <span class="product_name">{{$product->name}}</span>
                              <span class="product_price">
                                @php
                                if($product->product_type=='single'){
                                  echo $product->price.' ฿';
                                }
                                else{
                                     $variationlowestprice = ProductFrontendController::getVariationLowestPrice($product->id);
                                     $variationhighestprice = ProductFrontendController::getVariationHighestPrice($product->id);
                                     if($variationlowestprice!=$variationhighestprice){
                                       echo $variationlowestprice;
                                       echo " - ";
                                       echo $variationhighestprice.' ฿';
                                     }
                                     else{
                                       echo $variationlowestprice.'฿';
                                     }
                                }
                                @endphp

                              </span>
                          </div>
                      </div>
                  </div>

                </div>
              </a>
              </div>
               @endforeach
      </div>
    </div>
  </div>
</div>


<div class="container mt-4 mb-4">
  <div class="row">
    <div class="col-12 p-5 text-center" style="border:dashed 1px lightgray;">
      <h5 style="color:gray;">ร่วมเป็นส่วนหนึ่งของความสำเร็จไปกับเรา</h5>
      <span class="text-muted">สร้างรายได้ในการขายสินค้าหรือนำเสนอบริการเกี่ยวกับบ้านให้กับลูกค้า</span><br><br>
      <a href="/partner/become" class="btn btn-outline-dark"><i class="fas fa-plus"></i> ลงขายสินค้า/บริการ</a>
    </div>
  </div>
</div>


<style>
.slick-prev:before {
    color:black !important;
}
.slick-next:before {
    color:black !important;
}
</style>

@endsection
