<?php

namespace App\Http\Controllers\StoreManager;

use Illuminate\Http\Request;
use App\Http\Requests\StoreManagerCreateStoreRequest;
use App\Http\Controllers\Controller;
use App\Photo;
use App\Store;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class StoresListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $stores = Store::whereHas('users', function($query) use($user_id) {
          $query->where('users.id', $user_id);
        })->leftjoin('photos', 'photos.id', '=', 'stores.photo_id')->orderBy('stores.id','desc')->get();
        return view('storemanager.storelist',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storemanager.createstore');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManagerCreateStoreRequest $request)
    {
      $input = $request->all();
      $input['is_approve']=0;
      if($file = $request->file('photo_id')){
          $name = time(). $file->getClientOriginalName();
          $file->move('images', $name);
          $photo = Photo::create(['file'=>$name]);
          $input['photo_id']=$photo->id;
      }
      $store = Store::create($input);
      $store->users()->attach(Auth::user());
      return redirect('/storemanager');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
