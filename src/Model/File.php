<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

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
