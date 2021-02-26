<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Permissions\HasPermissionTrait;

class User extends Authenticatable
{
    use Notifiable, HasPermissionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
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

    public function links()
    {
        return $this->hasMany('App\Models\SocialLink','user_id');
    }

    public function slot()
    {
       return $this->hasOne('App\Models\Slot','company_id');
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
