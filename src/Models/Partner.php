<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    //

    public function projects()
    {
    	return $this->hasMany(Project::class,'partner_id', 'id');
    }

    public function getPartnerNameAttribute($id){
    	return dd($id); 
    }
}
