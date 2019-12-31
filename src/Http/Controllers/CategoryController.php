<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;
use App\Category;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $categories; 

    public function __construct(category $categories)
    {
        $this->middleware('auth:admin');
        $this->categories = $categories;
    }

    public function index()
    {
        return \Control::index('category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $orderCategories = $this->categories->all();
        return \Control::create('category')->with(compact('categories','orderCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = 'categories';
        $redirect = 'admin/categories';
        $calback = null;

        $this->validate($request,[
            'translate' => [
                'title' => 'required',
            ],
            'status' => 'required',
            'uri' => 'required',
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

        // get data from form
        $data = [
            'translate'     => ['title'],
            'uri'           => $request['uri'],
            'status'        => $request['status'],
            'photo'         => $data['photo'],
            'created_by'    => Auth::user('admin')->name,
        ];

        $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
         if (isset($data['translate'])) 
         {
            foreach ($data['translate'] as $k => $field) 
            {
                foreach (\App\Lang::all() as $lang) 
                {
                    if (is_string($k)) 
                    {
                      $data['lang'][$k.'-'.$lang->id] = $field;
                    }elseif(is_numeric($k))
                    {
                      $transField = $field.$lang->id;
                      $data['lang'][$field.'-'.$lang->id] = $request->{$transField};
                    }
                }
            }
         }


        $create = new $model;
        $currentLang = \App\Lang::where('code',app()->getLocale())->first();
        if (isset($data['translate'])) 
            {
              foreach ($data['translate'] as $k => $trans) 
              {
                if (is_string($k)) 
                {
                  $data[$k] = $trans;
                }elseif(is_numeric($k))
                {
                  $data[$trans] = $request->{$trans.$currentLang->id};
                }
              }
            }           
           foreach (array_except($data, ['translate','lang','files']) as $key => $value) 
           {
              $create->{$key} = $value;
           }

        $category = $this->categories->create($data);

        if($request->order || $request->orderCategories){
          $this->updateCategoryOrder($category, $request);
        }  

        session()->flash('success',trans('lang.added',['var'=>trans('lang.category')]));
        if (is_null($redirect)) 
        {
            return back();
        }else
        {
            return redirect($redirect);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Control::show('category',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categories->findOrFail($id);
        $orderCategories = $this->categories->all();
        return \Control::edit('category',$id)->with(compact('categories','orderCategories'));
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
        $name = 'category';
        $redirect = 'admin/categories';

        $this->validate($request,[
            'translate' => [
                'title' => 'required',
            ],
            'status' => 'required',
            'uri' => 'required',
        ]);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/categories',
                'upload_type'   =>  'single',
                'delete_file'   =>  Category::find($id)->photo,
           ]); 
        }else{
          $data['photo'] = Category::find($id)->photo;
        }

         // get data from form
        $data = [
            'translate'     => ['title'],
            'status'        => $request['status'],
            'photo'         => $data['photo'],
            'updated_by'    => Auth::user('admin')->name,
        ];

        if (isset($data['translate'])){
          foreach ($data['translate'] as $k => $field) 
          {
              foreach (\App\Lang::all() as $lang) 
              {
                  if (is_string($k)) 
                  {
                    $data['lang'][$k.'-'.$lang->id] = $field;
                  }elseif(is_numeric($k))
                  {
                    $transField = $field.$lang->id;
                    $data['lang'][$field.'-'.$lang->id] = $request->{$transField};
                  }
              }
          }
        }

        $model = '\App\\'.ucfirst(str_singular(camel_case($name)));
        $create = $model::find($id);
        $currentLang = \App\Lang::where('code',app()->getLocale())->first();
            
        if (isset($data['translate'])){
          foreach ($data['translate'] as $k => $trans){
            if (is_string($k)){
              $data[$k] = $trans;
            }elseif(is_numeric($k)){
              $data[$trans] = $request->{$trans.$currentLang->id};
            }
          }
        }


        foreach (array_except($data, ['translate','lang','files']) as $key => $value) 
        {
          $create->{$key} = $value;
        }

        $category = $this->categories->findOrFail($id);

        if($request->order || $request->orderCategories){
          if ($response = $this->updateCategoryOrder($category, $request)) {
              return $response;
          }
        }


        $create->save();

        if (isset($data['lang'])){
         foreach ($data['lang'] as $key => $value){
          $colum = explode('-', $key)[0];
          $lang = explode('-', $key)[1];
          updateLang($lang,$name,$create->id,$colum,$value); 
         }
        }

        session()->flash('success',trans('lang.updated',['var'=>trans('lang.'.$name)]));

        if (is_null($redirect)) 
        {
            return back();
        }else
        {
            return redirect($redirect);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {   
        $name = 'category';
        $category = Category::findOrFail($id);

        foreach ($category->children as $child) {
            $child->makeRoot();
        }

        \Storage::delete($category->photo);

        $category->delete();

        session()->flash('success',trans('lang.delete',['var'=>trans('lang.'.$name)]));

        return back();
    }

    protected function updateCategoryOrder(Category $category, Request $request){
        if ($request->has('order', 'orderCategory')) {
            try {
                $category->updateOrder($request->input('order'), $request->input('orderCategory'));
            } catch (MoveNotPossibleException $e) {
                session()->flash('error',trans('lang.cannot_make_page_child',['var'=>trans('lang.'.$name)]));
                return redirect(route('admin.categories.edit', $category->id));
            }
        }
    }

    public function order(Request $request)
    {
        return \Control::order($request->data,'category',0);
    }

    public function multi_delete(){
      if(is_array(request('item'))){
        Category::destroy(request('item'));
      }else{
        Category::find(request('item'))->delete();
      }
      alert()->success(trans('lang.deleted'), trans('lang.category'));
      return back();
    }

}
