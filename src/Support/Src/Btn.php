<?php

namespace App\Helpers\Src;

class Btn
{
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
