<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'languages';
    protected $dates = ['deleted_at'];

    protected $fillable = ['parent','extends','lang','colum','trans'];

    public function lang()
    {
    	return $this->belongsTo('App\Lang','lang');
    }
}
