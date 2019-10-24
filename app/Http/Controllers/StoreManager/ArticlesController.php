<?php

namespace App\Http\Controllers\StoreManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\Store_articles;
use Crypt;
use FileUploader;
use App\Photo;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store_username)
    {
      $store = Store::where('username',$store_username)->first();
      $articles = Store_articles::where('store_id',$store->id)->get();
      return view('storemanager.store.articles',compact('articles','store'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($store_username)
    {
      $store = Store::where('username',$store_username)->firstOrFail();
      return view('storemanager.store.add-article',compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $input = $request->all();
      $input['store_id']=Crypt::decrypt($request->input('store_id'));
      $input['is_approve']="0";
      $store = Store::where('id',$input['store_id'])->first();
      $store_article = new Store_articles($input);
      $store_article->save();

      $articlecoverphoto = $request->file('articlecoverphoto');

      $public_path = public_path();
      $uploadDir = $public_path.'/images/';

      if(!is_null($articlecoverphoto)){

      // Set up FileUploader
      $articlecoverphoto = new FileUploader('articlecoverphoto', array(
        'limit' => null,
        'maxSize' => null,
        'fileMaxSize' => null,
        'extensions' => null,
        'required' => false,
        'uploadDir' => $uploadDir,
        'title' => $store->username.'_article_{random}',
        'replace' => false,
        'editor' => array(
          'minWidth' => 1200,
          'minHeight' => 720,
          'quality' => 80,
          'crop' => true,
        ),
        'listInput' => true,
        'files' => null,
        ));
       $upload = $articlecoverphoto->upload();
       if($upload['isSuccess']) {
            // get the uploaded files
         $photos = $upload['files'];

         if(!empty($photos[0])){
           for ($i = 0; $i < count($photos); $i++) {
               $photo = $photos[$i];
               $upload = new Photo();
               $upload->file = $photo['name'];
               $upload->save();
               $article = Store_articles::where('id', $store_article->id)->first();
               $article->photo_id = $upload->id;
               $article->save();
            }
          }

       } else {
         $warnings = $upload['warnings'];
         var_dump($warnings);
       }
     }

     return redirect()->back()->with('success', 'ได้เพิ่มบทความนี้เป็นที่เรียบร้อยแล้ว! กรุณารอการอนุมัติ');

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
