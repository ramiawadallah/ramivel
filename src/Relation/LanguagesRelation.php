<?php
namespace App\Relation;

trait LanguagesRelation{
    
	public function trans($colum,$language = null)
    {
        if (is_null($language)) 
        {
            $lang_id = \App\Lang::where('code',app()->getLocale())->first()->id;
        }
        else{
            $lang_id = \App\Lang::where('code',$language)->first()->id;
        }
        $table = str_singular($this->getTable());
        
        $trans = @$this->hasMany('App\Language','parent')->where('lang',$lang_id)->where('extends',$table)->where('colum',$colum)->first()->trans;

            if (is_null($trans)) 
            {
                return @$this->{$colum};
            }else{
            return $trans;
                
            }
    }
  
}


