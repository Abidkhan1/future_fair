<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  public function pavillions()
  {
      return $this->hasMany('App\Models\Pavillion','event_id');
  }

  public function users()
  {
     return $this->belongsToMany('App\Models\User', 'event_user', 'event_id','user_id');
  }
}
