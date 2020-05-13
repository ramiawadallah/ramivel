<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Alert;
use Auth;
use App\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $pages;

    public function __construct(page $pages)
    {
        $this->middleware('auth:admin');
        $this->pages = $pages;
    }

    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index',compact('pages',$pages));
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'uri' => 'required',
        ]);

        //Request Photo Upload
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

        $page = new Page;
        $page->title = $data['title'];
        $page->content = $data['content'];
        $page->status = $data['status'];
        $page->uri = $data['uri'];
        $page->photo = $data['photo'];
        $page->template = $data['template'];
        $page->created_by = auth()->user('admin')->id;
        $page->save();

        if($request->order || $request->orderPages){
          $this->updatePageOrder($page, $request);
        }  

        session()->flash('success',trans('lang.created'));
        return  redirect('admin/pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::find($id);
        return view('admin.pages.show',compact('page',$page));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    public function update(Request $request, $id)
    {
        $data = [];

        if($request->order || $request->orderPages){
          if ($response = $this->updatePageOrder($page, $request)) {
              return $response;
          }
        }

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

        $page = Page::find($id);

        //Request Photo Upload
        if(request()->hasFile('photo')) {
           $data['photo'] = Up()->upload([
                // 'new_name'      =>  '',
                'file'          =>  'photo',
                'path'          =>  'public/pages',
                'upload_type'   =>  'single',
                'delete_file'   =>  '',
           ]); 
        }else{
          $data['photo'] = $page->photo;
        }

        $page->title = $data['title'];
        $page->content = $data['content'];
        $page->status = $data['status'];
        $page->uri = $data['uri'];
        $page->photo = $data['photo'];
        $page->template = $data['template'];
        $page->updated_by = auth()->user('admin')->id;
        $page->update();

        session()->flash('success',trans('lang.updated'));
        return  redirect('admin/pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $name = 'pages';
        $pages = Page::findOrFail($id);
        \Storage::delete($pages->photo);
        $pages->delete();
        session()->flash('success',trans('lang.delete'));
        return back();
    }

    public function multi_delete(){
      if(is_array(request('item'))){
        Page::destroy(request('item'));
      }else{
        Page::find(request('item'))->delete();
      }
      alert()->success(trans('lang.deleted'));
      return back();
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
