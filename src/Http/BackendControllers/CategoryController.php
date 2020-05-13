<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;
use Auth;
use App\Category;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('admin.categories.index',compact('categories',$categories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/categories',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = null;
        }

        $category = new Category;
        $category->title = $data['title'];
        $category->photo = $data['photo'];
        $category->created_by = auth()->user('admin')->id;
        $category->save();
        session()->flash('success',trans('lang.created'));
        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.categories.show',compact('category',$category));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit',compact('category',$category));
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
        ]);

        $category = Category::find($id);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/categories',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = $category->photo;
        }

        $category = new Category;
        $category->title = $data['title'];
        $category->photo = $data['photo'];
        $category->updated_by = auth()->user('admin')->id;
        $category->update();
        session()->flash('success',trans('lang.updated'));
        return  redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $name = 'categories';
        $categories = Category::findOrFail($id);
        \Storage::delete($categories->photo);
        $categories->delete();
        session()->flash('success',trans('lang.delete'));
        return back();
    }

    public function multi_delete(){
      if(is_array(request('item'))){
        Category::destroy(request('item'));
      }else{
        Category::find(request('item'))->delete();
      }
      alert()->success(trans('lang.deleted'));
      return back();
    }

}
