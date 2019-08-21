<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
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
			'desc',
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
