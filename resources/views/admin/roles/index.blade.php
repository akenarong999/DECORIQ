<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
บทบาทของผู้ใช้ - DECORIQ
@endsection

@section('sidebar')
    @parent


@endsection

@section('content')
    <section id="admin-dashboard-main">
        <div class="container bg-white border mt-3 p-5">
          <div class="row mb-3">
           <div class="col-6">
              <h3>Roles</h3>
           </div>
           <div class="col-6 text-right">
              <a class="btn btn-primary" href="/admin/roles/create">
                <i class="themify ti ti-plus font-weight-bold"></i> Create role
              </a>
           </div>
           </div>
           <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Amount of Users</th>
                <th scope="col">Action</th>

              </tr>
            </thead>
            <tbody>
              @if($roles)
                @foreach($roles as $role)
                  <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                      @php
                      $user_role_amount = $user_role->where('roleName', $role->name);
                      echo $user_role_amount->count();
                      @endphp
                     </td>
                     <td>
                       <a href="/admin/users?role={{$role->name}}" title="list of users in this role" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-eye"></i></a>
                       <a href="{{route('roles.edit',$role->id)}}" title="edit role" class="btn btn-sm btn-outline-secondary"><i class="themify ti ti-pencil"></i></a>
                       {{ Form::open(['method'=>'DELETE','action'=>['Admin\AdminRolesController@destroy', $role->id],'class'=>'d-inline']) }}
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
