<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
	protected $guarded;
    //
    public function languages()
    {
    	return $this->hasMany('App\Models\Language','lang');
    }
}
