<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Permissions\HasPermissionTrait;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasPermissionTrait;
    use HasApiTokens;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','social_id','social_type','role_id','slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','two_factor_recovery_codes','two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users.'.$this->id;
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function offers()
    {
        return $this->hasMany('App\Models\Offer','company_id');
    }

    public function visitors()
    {
        return $this->hasMany('App\Models\Visitor','company_id');
    }

    public function uploads()
    {
        return $this->hasMany('App\Models\Upload','user_id');
    }

    public function videos()
    {
        return $this->hasMany('App\Models\Upload','user_id')->where('type','=','video');
    }

    public function galleryImages()
    {
        return $this->hasMany('App\Models\Upload','user_id')->where('type','=','gallery');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Upload','user_id')->where('type','=','document');
    }

    public function links()
    {
        return $this->hasMany('App\Models\SocialLink','user_id');
    }

    public function slot()
    {
       return $this->hasOne('App\Models\Slot','user_id');
    }

    public function slot_design()
    {
       return $this->hasOne('App\Models\SlotDesign','company_id');
    }

    public function events()
    {
       return $this->belongsToMany('App\Models\Event','event_user','user_id', 'event_id')->withTimestamps();
    }
    public function messages(){

        return $this->hasMany(Chat::class);

    }
}
