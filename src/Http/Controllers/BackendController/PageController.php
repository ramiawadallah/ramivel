<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Baum\MoveNotPossibleException;
use App\Http\Requests;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Lang;
use Auth;
use DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pages;
    protected $settings;

    public function __construct(page $pages, setting $settings)
    {
        // $this->middleware(['auth:web']);
        $this->middleware(['web','auth:admin']);

        $this->pages = $pages;
        $this->settings = $settings;
    }

    public function index()
    {
        return \Control::index('page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = Page::all();
        $templates = $this->getPageTemplate();
        $orderPages = $this->pages->all();
        return view('admin.pages.create',compact('page','orderPages', 'templates'));
        //return \Control::create('page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        $name = 'page';
        $redirect = 'admin/pages';
        $calback = null;


        $this->validate($request,[
            'translate' => [
                'title' => ['required', 'min:3'],
                'content' => 'required',
            ],
            'uri' => ['required'],
            'status' => 'required',
        ]);

        
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/pages',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = null;
        }

        // get data from form
        $data = [
            'translate'     => ['title','content'],
            'uri'           => $request['uri'],
            'name'          => $request['name'],
            'template'      => $request['template'],
            'status'        => $request['status'],
            'photo'         => $data['photo'],
            'created_by'    => Auth::user('admin')->name,
        ];


         $model = '\App\Models\\'.ucfirst(str_singular(camel_case($name)));
         if (isset($data['translate'])) 
         {
            foreach ($data['translate'] as $k => $field) 
            {
                foreach (Lang::all() as $lang) 
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
          $currentLang = Lang::where('code',app()->getLocale())->first();
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
        
        $page = $this->pages->create($data);

        if($request->order || $request->orderPages){
          $this->updatePageOrder($page, $request);
        }  

        //$create; 
        if (isset($data['lang'])) 
          {
             foreach ($data['lang'] as $key => $value) 
             {
              $colum = explode('-', $key)[0];
              $lang = explode('-', $key)[1];
              updateLang($lang,$name,$page->id,$colum,$value); 
             }
          }

        $id = $model::all()->last()->id;
                
        if (is_null($redirect)) 
        {
            return back();
        }else
        {
            return redirect($redirect)->with('message', 'Your page is created successfully');
        }
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return \Control::show('page',$id);
    }

    public function showpage(Page $page, array $parmaeters){
        //$this->prepaerTemplate($page, $parmaeters);
        //return view('page', compact('page'));
        return \Control::show('page',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function edit($id){
        $page = $this->pages->findOrFail($id);
        $templates = $this->getPageTemplate();
        $orderPages = $this->pages->all();
        return view('admin.pages.edit',compact('page','orderPages', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */





    public function update(Request $request, $id){
        $name = 'page';
        $redirect = 'admin/pages';

        $page = $this->pages->findOrFail($id);

        if($request->order || $request->orderPages){
          if ($response = $this->updatePageOrder($page, $request)) {
              return $response;
          }
        }

        $this->validate($request,[
            'translate' => [
                'title' => ['required', 'min:3'],
            ],
            'uri' => ['required'],
            'status' => 'required',
        ]);

        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/pages',
                'upload_type'   =>  'single',
                'delete_file'   =>  Page::find($id)->photo,
           ]); 
        }else{
            $data['photo'] = Page::find($id)->photo;
        }

        // get data from form
        $data = [
            'translate'     => ['title','content'],
            'uri'           => $request['uri'],
            'name'          => $request['name'],
            'template'      => $request['template'],
            'status'        => $request['status'],
            'photo'         => $data['photo'],
            'updated_by'    => Auth::user('admin')->name,
        ];


        if (isset($data['translate'])){
          foreach ($data['translate'] as $k => $field) 
          {
              foreach (Lang::all() as $lang) 
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

        $model = '\App\Models\\'.ucfirst(str_singular(camel_case($name)));
        $create = $model::find($id);
        $currentLang = Lang::where('code',app()->getLocale())->first();
            
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

        $create->save();


        if (isset($data['lang'])){
         foreach ($data['lang'] as $key => $value){
          $colum = explode('-', $key)[0];
          $lang = explode('-', $key)[1];
          updateLang($lang,$name,$create->id,$colum,$value); 
         }
        }        

        if (is_null($redirect)) 
        {
            return back();
        }else
        {
            return redirect($redirect)->with('message', 'Your page is updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null){
        $name = 'page';
        $page = Page::findOrFail($id);

        foreach ($page->children as $child) {
            $child->makeRoot();
        }

        \Storage::delete($page->photo);

        $page->delete();
        
        return back()->with('message', 'Your page is deleted successfully');
    }


    protected function updatePageOrder(Page $page, Request $request){
        if ($request->has('order', 'orderPage')) {
            try {
                $page->updateOrder($request->input('order'), $request->input('orderPage'));
            } catch (MoveNotPossibleException $e) {
                return redirect(route('admin.pages.edit', $page->id))->with('success', trans('lang.cannot_make_page_child'));
            }
        }
    }

    protected function getPageTemplate(){
        $templates = config('cms.templates');
        return ['' => 'None'] + array_combine(array_keys($templates), array_keys($templates));
    }

    public function prepaerTemplate(Page $page, array $parmaeters){
        $templates = config('cms.templates');

        if (! $page->template || ! isset($templates[$page->template])) {
            return;
        }
        $template = app($templates[$page->template]);
        $view = sprintf('templates.%s', $template->getView());
        if (! view()->exists($view)) {
            return;
        }
        $template->prepare($view = view($view), $parmaeters);
        $page->view = $view;
    }



}
