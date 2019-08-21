<?php

namespace App\Helpers\Src;

class langForm 
{
	protected  $lang = '';
    public function __construct($id)
    {
        $this->lang = $id;
    }

    public  function text($name,$value=null,$attributes=null)
    {
        $lang_id = $this->lang;
        echo view('Helpers.langForm.text',compact('name','value','attributes','lang_id'))->render();
    }


    public  function textarea($name,$value=null,$attributes=null)
    {
        $lang_id = $this->lang;
    	echo view('Helpers.langForm.textarea',compact('name','value','attributes','lang_id'))->render();
    }


}
