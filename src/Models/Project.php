<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded;

    //
    public function files(){
    	return $this->hasMany('App\Models\File','relation_id','id')->where('file_type','photo');
    }

    public function partner(){
    	return $this->belongsTo(Partner::class);
    }
}
