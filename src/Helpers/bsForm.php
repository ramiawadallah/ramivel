<?php

namespace App\Helpers;

class bsForm 
{

    public static function start($attributes=null)
    {
        return view('Helpers.bsForm.start',compact('attributes'))->render();
    } 

    public static function end($options=null)
    {
        return view('Helpers.bsForm.end',compact('options'))->render();
    } 

    public static function text($name,$value=null,$attributes=null)
    {
        return view('Helpers.bsForm.text',compact('name','value','attributes'))->render();
    }

    public static function textarea($name, $value=null, $attributes=null){
        return view('Helpers.bsForm.textarea',compact('name','value','attributes'))->render();
    }

    public static function translate($callback)
    {
        if (is_callable($callback)) 
        {
            return view('Helpers.bsForm.translate',compact('callback'))->render();
        }
    }

    public static function tage($name,$value=null,$attributes=null)
    {
        return view('Helpers.bsForm.tage',compact('name','value','attributes'))->render();
    }

    public static function textdate($name,$value=null,$attributes=null)
    {
        return view('Helpers.bsForm.textdate',compact('name','value','attributes'))->render();
    }

    public static function number($name,$value=null,$attributes=null)
    {
        return view('Helpers.bsForm.number',compact('name','value','attributes'))->render();
    }

    public static function url($name,$value=null,$attributes=null)
    {
        return view('Helpers.bsForm.url',compact('name','value','attributes'))->render();
    }

    public static function uri($name,$value=null,$attributes=null)
    {
        return view('Helpers.bsForm.uri',compact('name','value','attributes'))->render();
    }

    public static function password($name,$attributes=null)
    {
        return view('Helpers.bsForm.password',compact('name','attributes'))->render();
    }

    public static function email($name,$value=null,$attributes=null)
    {
        return view('Helpers.bsForm.email',compact('name','value','attributes'))->render();
    }

    public static function time($name,$value=null,$attributes=null)
    {
        return view('Helpers.bsForm.time',compact('name','value','attributes'))->render();
    }

    public static function checkbox($name,$options,$labels,$value=null,$attributes=null)
    {
        return view('Helpers.bsForm.checkbox',compact('name','options','labels','value','attributes'))->render();
    }

    public static function radio($name,$options,$value=null,$attributes=null)
    {
      return view('Helpers.bsForm.radio',compact('name','options','value','attributes'))->render();
    }

    public static function birthday($values=null,$attributes=null)
    {
      return view('Helpers.bsForm.birthday',compact('values','attributes'))->render();
    }

    public static function select($name,$options,$value=null,$attributes=null)
    {
      return view('Helpers.bsForm.select',compact('name','options','value','attributes'))->render();
    }

    public static function image($name=null,$url=null)
    {
      return view('Helpers.bsForm.image',compact('name','url'))->render();
    }

    public static function file($name=null,$url=null)
    {
      return view('Helpers.bsForm.file',compact('name','url'))->render();
    }

    public static function create($url = null,$attr = null)
    {
        return view('Helpers.btns.create',compact('url','attr'))->render();
    }

    public static function edit($id,$url = null,$attr = null)
    {
        return view('Helpers.btns.edit',compact('id','url','attr'))->render();
    }
    public static function delete($options = null,$name = null)
    {
        return view('Helpers.btns.delete',compact('options','name'))->render();
    }    
    public static function view($id,$attr = null)
    {
        return view('Helpers.btns.view',compact('id','attr'))->render();
    }    

    public static function deleteAll($attr = null)
    {
        return view('Helpers.btns.deleteAll',compact('attr'))->render();
    }

}