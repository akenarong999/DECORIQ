<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUsersRequest;
use App\Http\Requests\AdminUsersEditRequest;
use App\User;
use App\Role;
use App\Photo;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $getrole = Input::get('role');
        if($getrole!=""){
           $users = DB::table('users')->leftjoin('roles', 'roles.id', '=', 'users.role_id')->leftjoin('photos','photos.id','=','users.photo_id')->select('users.id as userId','users.name as userName','users.*','roles.name as roleName','photos.*')->where('roles.name','=',$getrole)->get();
           return view('admin.users.index', compact('users','roles'));
        }else{
          $users = DB::table('users')->leftjoin('roles', 'roles.id', '=', 'users.role_id')->leftjoin('photos','photos.id','=','users.photo_id')->select('users.id as userId','users.name as userName','users.*','roles.name as roleName','photos.*')->get();
          return view('admin.users.index', compact('users','roles'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUsersRequest $request)
    {
        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time(). $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;
        }
        $input['password']=bcrypt($request->password);
        User::create($input);
        return redirect('/admin/users');
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
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUsersEditRequest $request, $id)
    {


        $user = User::findOrFail($id);

        if(trim($request->password)==''){
          $input = $request->except('password');
        }
        else{
          $input = $request->all();
          $input['password'] = bcrypt($request->password);
        }

          if($file = $request->file('photo_id')){
              $name = time(). $file->getClientOriginalName();
              $file->move('images', $name);
              $photo = Photo::create(['file'=>$name]);
              $input['photo_id']=$photo->id;
          }
          $user->update($input);
          return redirect('/admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/admin/users');
    }
}
