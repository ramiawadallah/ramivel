<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;
use Auth;
use App\Post;

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
        $posts = Post::all();
        return view('admin.posts.index',compact('posts',$posts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = [];

        foreach ($request->all() as $key => $value) {
            if(is_array($value))
            {
                  $data[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);
            } else {
                  $data[$key] = $value;
            }
        }

        $this->validate($request,[
            'title.*' => 'required|max:255',
            'content.*' => 'required',
            'status' => 'required',
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


        $post = new Post;
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->status = $data['status'];
        $post->uri = $data['uri'];
        $post->photo = $data['photo'];
        $post->created_by = auth()->user('admin')->id;
        $post->save();
        session()->flash('success',trans('lang.created'));
        return  redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.show',compact('post',$post));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.posts.edit',compact('post',$post));
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
        $data = [];

        foreach ($request->all() as $key => $value) {
            if(is_array($value))
            {
                  $data[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);
            } else {
                  $data[$key] = $value;
            }
        }

        $this->validate($request,[
            'title.*' => 'required|max:255',
            'content.*' => 'required',
            // 'status' => 'required',
            // 'uri' => 'required',
        ]);

        $post = Post::find($id);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/settings',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = $post->photo;
        }
      
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->status = $data['status'];
        $post->photo = $data['photo'];
        $post->updated_by = auth()->user('admin')->id;
        $post->update();
        session()->flash('success',trans('lang.updated'));
        return  redirect('admin/posts');
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
        session()->flash('success',trans('lang.delete'));
        return back();
    }

    public function multi_delete(){
      if(is_array(request('item'))){
        Post::destroy(request('item'));
      }else{
        Post::find(request('item'))->delete();
      }
      alert()->success(trans('lang.deleted'));
      return back();
    }

}
