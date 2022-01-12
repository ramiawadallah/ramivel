<?php 
namespace Ramivel\Application\Helper\Src;
/**
* 
*/
use Illuminate\Http\Request;
Use Alert;


class Control
{

  public static function index($name ,$view = null , $compact = [],$callback = null)
  {
    if (is_null($view)) 
    {
      $view = 'admin.'.strtolower(str_plural($name)).'.index';
    }

    $model = '\App\\Models\\'.ucfirst(str_singular(camel_case($name)));
    $row = $model::orderBy('id','desc')->get();
      if (is_callable($callback)) 
      {
        $row = call_user_func_array($callback, [$row]);
      }
    
      if (count($compact) == 0) 
      {
        $compact = [strtolower(str_plural($name)) => $row];
      }
      return view($view,$compact);
  }

  public static function create($name ,$view = null , $compact = [])
  {
    if (is_null($view)) 
    {
      $view = 'admin.'.strtolower(str_plural($name)).'.create';
    }

      return view($view,$compact);
  }


  public static function show($name , $id , $view = null , $compact = [])
  {

    if (is_null($view)) 
    {
      $view = 'admin.'.strtolower(str_plural($name)).'.show';
    }

    $model = '\App\\Models\\'.ucfirst(str_singular(camel_case($name)));
    $row = $model::where('id',$id);

    if ($row->exists()) 
    {
      $compact = array_add($compact, strtolower(str_singular($name)), $row->first());
      return view($view,$compact);
    }else{
      return view('Helper::main_error404');
    }
  }

  public static function edit($name , $id , $view = null , $compact = [])
  {
    if (is_null($view)) 
    {
      $view = 'admin.'.strtolower(str_plural($name)).'.edit';
    }

    $model = '\App\\Models\\'.ucfirst(str_singular(camel_case($name)));
    $row = $model::where('id',$id);
    if ($row->exists()) 
    {
        $compact = array_add($compact, strtolower(str_singular($name)), $row->first());
      
      return view($view,$compact);
    }else{
      return view('Helper::main_error404');
    }
  }
  
  public static function store(Request $request ,$name,$data=[],$redirect=null,$calback=null)
   {

       $model = '\App\\Models\\'.ucfirst(str_singular(camel_case($name)));

       if (isset($data['translate'])) 
       {
          foreach ($data['translate'] as $k => $field) 
          {
              foreach (\App\Models\Lang::all() as $lang) 
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
            $currentLang = \App\Models\Lang::where('code',app()->getLocale())->first();
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

       $create->save(); 
       
        if (isset($data['lang'])) 
        {
           foreach ($data['lang'] as $key => $value) 
           {
            $colum = explode('-', $key)[0];
            $lang = explode('-', $key)[1];
            updateLang($lang,$name,$create->id,$colum,$value); 
           }
        }

        $id = $model::all()->last()->id;

        if (isset($data['files'])) 
        {
        \Files::upload($request,$name,$id,$data['files']);
        }

        if (is_callable($calback)) 
        {
           call_user_func_array($calback,[$request,$id]);
        }
        if (is_null($redirect)) 
        {
            return back()->with('message', 'Your ' . $name . ' created successfully');
        }else
        {
            return redirect($redirect)->with('message', 'Your ' . $name . ' created successfully');
        }
        
   }
   
  public static function update(Request $request,$id,$name,$data=[],$redirect=null,$calback=null)
   {
      
      
      if (isset($data['translate'])) 
       {
          foreach ($data['translate'] as $k => $field) 
          {
              foreach (\App\Models\Lang::all() as $lang) 
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

       $model = '\App\\Models\\'.ucfirst(str_singular(camel_case($name)));
       $create = $model::find($id);
             $currentLang = \App\Models\Lang::where('code',app()->getLocale())->first();
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
       $create->save();
       if (isset($data['lang'])) 
          {
             foreach ($data['lang'] as $key => $value) 
             {
              $colum = explode('-', $key)[0];
              $lang = explode('-', $key)[1];
              updateLang($lang,$name,$create->id,$colum,$value); 
             }
          }

       if (is_callable($calback)) 
        {
           call_user_func_array($calback,[$request,$id]);
        }
        if (isset($data['files'])) 
        {
          
          \Files::update($request,$name,$id,$data['files']);
          
        }

        if (is_null($redirect)) 
        {
            return back()->with('message', 'Your ' . $name . ' updated successfully');;
        }else
        {
            return redirect($redirect)->with('message', 'Your ' . $name . ' updated successfully');;
        }
   }

   public static function destroy(Request $request  ,$id = null,$name,$calback = null){
    $model = '\App\\Model\\'.ucfirst(str_singular(camel_case($name)));
    if ($id == null && !$request->has('delete')) 
        {
           return back(); 
        }
        
        if ($id != null) 
        {
          $row = $model::find($id);
          
           if (is_callable($calback)) 
              {
                  call_user_func_array($calback,[$row,$id]);
              }
           $row->delete();
           deleteLang($name,$id);
           \Files::delete($name,$id);
        }
        if ($request->has('delete')) 
        {
            foreach ($request->input('delete') as $value) 
            {
              $row = $model::find($value);
              if (is_callable($calback)) 
              {
                  call_user_func_array($calback,[$row,$id,$name]);
              }
              deleteLang($name,$value);
               $row->delete();
              \Files::delete($name,$value);
            }
        }
        
        return back()->with('message', 'Your ' . $name . ' deleted successfully');;
}

public static function order($req,$name,$parent=0)
    {

      $model = '\App\\Model\\'.ucfirst(str_singular(camel_case($name)));
        foreach ($req as $key => $value) 
        {
            $row = $model::find($value['id']);
            $row->parent = $parent;
            $row->order = $key;
            $row->save();
            if (!empty($value['children']) && is_array($value['children'])) 
            {
                self::order($value['children'],$name,$value['id']);
            }
        }
    }

  public static function orderHtml($name,$parentName,$parent = 0,$position=null)
  {
    $model = '\App\\Model\\'.ucfirst(str_singular(camel_case($name)));
    $rows = $model::where($parentName,$parent)->orderBy('order','asc')->get();
    if (!is_null($position)) 
    {
    $rows = $model::where($parentName,$parent)->where('position',$position)->orderBy('order','asc')->get();
      
    }
    return view('Helper::order',compact('rows','name','parentName','parent'))->render();
  }

  public static function mainOrderHtml($name,$parentName,$parent = 0,$position=null)
  {
    $model = '\App\\Model\\'.ucfirst(str_singular(camel_case($name)));
    $rows = $model::where($parentName,$parent)->orderBy('order','asc')->get();
    if (!is_null($position)) 
    {
    $rows = $model::where($parentName,$parent)->where('position',$position)->orderBy('order','asc')->get();
    }
    return view('Helper::main_order',compact('rows','name','parentName','parent','position'))->render();
  }

}
