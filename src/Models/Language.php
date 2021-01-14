<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    
    protected $table = 'languages';

    protected $fillable = ['parent','extends','lang','colum','trans'];

    public function lang()
    {
    	return $this->belongsTo('App\Lang','lang');
    }
}
