<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Ramivel\Application\Traits\hasPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramivel\Application\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Admin extends Authenticatable implements HasMedia
{

    use Notifiable, hasPermissions, InteractsWithMedia;

    protected $casts = ['active' => 'boolean'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function registerMediaCollections(): void
    // {
    //     $this
    //     ->addMediaCollection('media')
    //     ->registerMediaConversions(function (Media $media) {
    //         $this
    //             ->addMediaConversion('thumb')
    //             ->width(250)
    //             ->height(250);
    //         $this
    //             ->addMediaConversion('avatar')
    //             ->width(100)
    //             ->height(100);
    //     });
    // }

    public function avatar(){
        return $this->hasOne(Media::class,'id','avatar_id');
    }

    public function getAvatarUrlAttribute(){
        if(auth()->user()->avatar_id != null){
            return $this->avatar->getUrl('avatar');
        }else{
            return null;
        }
    }
}
