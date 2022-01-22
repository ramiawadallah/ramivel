<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Setting extends Model
{
	use HasFactory;
    //
    protected $table = 'settings';

    protected $fillable = [
			'title',
			'subtitle',
			'email',
			'phone',
			'address',
			'fax',
			'pobox',
			'map',
			'mainvideo',
            // About your website
			'content',
			'logo',
			'icon',
			'maintenance',
			'keywords',
			'copyright',
            // Social media
			'facebook',
			'twitter',
			'instagram',
			'linkedin',
			'youtube',

			'updated_by'
    ];
}
