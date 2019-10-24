<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
องค์ประกอบเว็บไซต์ - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row mb-3 mt-3 pb-2 border-bottom">
             <div class="col-6">
                <h2>องค์ประกอบเว็บไซต์</h2>
             </div>
           </div>

           <table class="table">
              <thead>
                <tr>
                  <th scope="col">ชื่อหน้า</th>
                  <th scope="col">รายละเอียด</th>
                  <th scope="col">คำสั่ง</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>หน้าแรก</td>
                  <td>หน้าหลักของเว็บไซต์</td>
                  <td><a class="btn btn-light border" href="/admin/webelement/homepage/editor">แก้ไข</a></td>
                </tr>
                <tr>
                  <td>หน้าหลักสินค้า</td>
                  <td>หน้าหลักที่รวมสินค้าเอาไว้ทั้งหมด</td>
                  <td><a class="btn btn-light border" href="/admin/webelement/mainproductspage/editor">แก้ไข</a></td>
                </tr>
                <tr>
                  <td>หน้าหลักบริการ</td>
                  <td>หน้าหลักที่รวมบริการเอาไว้ทั้งหมด</td>
                  <td><a class="btn btn-light border" href="/admin/webelement/mainservicespage/editor">แก้ไข</a></td>
                </tr>
                <tr>
                  <td>ดีไซน์เนอร์</td>
                  <td>โขว์งานดีไซน์ของเหล่าดีไซน์เนอร์ค่ายต่างๆ</td>
                  <td><a class="btn btn-light border" href="/admin/webelement/maindesignerpage/editor">แก้ไข</a></td>
                </tr>
                <tr>
                  <td>คอมมูนิตี้</td>
                  <td>แหล่งพูดคุย สอบถามเกี่ยวกับการแต่งบ้าน</td>
                  <td><a class="btn btn-light border" href="/admin/webelement/maincommunitypage/editor">แก้ไข</a></td>
                </tr>
              </tbody>
            </table>


        </div>
    </section>
@endsection
