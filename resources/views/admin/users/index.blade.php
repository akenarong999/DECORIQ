<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
ผู้ใช้/บทบาททั้งหมด - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row">
            <div class="col-12 pb-2 border-bottom">
              <h2>ผู้ใช้/บทบาท</h2>
            </div>
          </div>
          <div class="row mb-3 mt-3">
           <div class="col-6">
              <h4>ผู้ใช้</h4>
           </div>
           <div class="col-6 text-right">
              <a class="btn btn-primary" href="/admin/users/create">
                <i class="themify ti ti-plus font-weight-bold"></i> เพิ่มผู้ใช้
              </a>
           </div>
           </div>
           <div class="row">
             <div class="col">
               <ul class="list-inline">
                 แสดงผู้ใช้ตาม:
                 @if($roles)
                      <li class="list-inline-item"><a href="/admin/users">All</a></li>
                   @foreach($roles as $role)
                      <li class="list-inline-item"><a href="/admin/users?role={{ $role->name }}">{{ $role->name }}</a></li>
                    @endforeach
                 @endif
                </ul>
             </div>
           </div>
           <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Active</th>
                <th scope="col">Command</th>
              </tr>
            </thead>
            <tbody>
              @if($users)
                @foreach($users as $user)
                  <tr>
                    <th scope="row">{{$user->userId}}</th>
                    <td>
                      @if(isset($user->file) && $user->file)
                      <img height="50" src="/images/{{$user->file}}">
                      @else
                      <img height="50" src="https://static1.squarespace.com/static/58f7904703596ef4c4bdb2e1/t/5991c101a803bb3bb083acae/1502724567949/no+avatar.png">
                      @endif
                    </td>
                    <td>{{$user->firstname}} {{$user->lastname}} ({{$user->userName}})</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->roleName}}</td>
                    <td>{{$user->is_active == '1' ? 'Active' : 'Not Active'}}</td>
                    <td>
                      <a href="{{route('users.edit',$user->userId)}}" title="edit user" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a>
                      {{ Form::open(['method'=>'DELETE','action'=>['Admin\AdminUsersController@destroy', $user->userId],'class'=>'d-inline']) }}
                      <button type="submit" onclick="return confirm('Do you want to delete this user?')" class="btn btn-sm btn-outline-secondary">
                         <i class="themify ti ti-trash"></i>
                      </button>
                      {{ Form::close() }}
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>

          <div class="row">
            <div class="col-sm-4 offset-sm-5">
            </div>
          </div>
        </div>
    </section>
@endsection
