<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    //
    // use SoftDeletes;

    protected $table = 'files';
    protected $dates = ['deleted_at'];

    protected $fillable = [
		'name',
		'size',
		'file',
		'path',
		'full_file',
		'mime_type',
		'file_type', // new / product / atc..
		'relation_id',
    ];
}
