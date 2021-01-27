<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Admin;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return \Control::index('post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \Control::create('post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'translate' => [
                'title' => 'required',
                'content' => 'required',
            ],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'category_id' => 'required',
            'uri' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/posts',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = null;
        }

        return \Control::store($request,'post',[
            'translate' => ['title','content'],
            'status' => $request->status,
            'uri' => $request->uri,
            'category_id' => $request->category_id,
            'photo' => $data['photo'],
            'created_by'    => Auth::user('admin')->id,
        ],aurl().'/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Control::show('post',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \Control::edit('post',$id);
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
        $this->validate($request,[
            'translate' => [
                'title'     => 'required',
                'content'   => 'required',
            ],
            'status'        => 'required',
            'category_id'   => 'required',
            'uri'           => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/posts',
                'upload_type'   =>  'single',
                'delete_file'   =>  Post::find($id)->photo,
           ]); 
        }else{
          $data['photo'] = Post::find($id)->photo;
        }

        return \Control::update($request,$id,'post',[
            'translate'     => ['title','content'],
            'status'        => $request->status,
            'uri'           => $request->uri,
            'category_id'   => $request->category_id,
            'photo'         => $data['photo'],
            'updated_by'    => Auth::user('admin')->id,
        ],aurl().'/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $name = 'posts';
        $posts = Post::findOrFail($id);
        \Storage::delete($posts->photo);
        $posts->delete();
        return back()->with('message', 'Your Post is deleted successfully');
    }

    public function order(Request $request)
    {
        return \Control::order($request->data,'post',0);
    }

    public function multi_delete(){
      if(is_array(request('item'))){
        Post::destroy(request('item'));
      }else{
        Post::find(request('item'))->delete();
      }
      return back();
    }

}
