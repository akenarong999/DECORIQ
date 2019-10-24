<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRolesRequest;
use App\Http\Requests\AdminRolesEditRequest;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
use Illuminate\Support\Facades\Input;

class AdminRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_role = DB::table('users')
              ->join('roles', 'users.role_id', '=', 'roles.id')
              ->select('users.name as userName', 'roles.name as roleName')
              ->get();
        $roles = Role::all();
        return view('admin.roles.index', compact('user_role','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRolesRequest $request)
    {
      $input = $request->all();
      Role::create($input);
      return redirect('/admin/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $role = Role::findOrFail($id);
      return view('admin.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRolesEditRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $input = $request->all();
        $role->update($input);
        return redirect('/admin/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Role::findOrFail($id)->delete();
      return redirect('/admin/roles');
    }
}
