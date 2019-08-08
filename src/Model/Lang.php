<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    //
    public function languages()
    {
    	return $this->hasMany('App\Language','lang');
    }
}
