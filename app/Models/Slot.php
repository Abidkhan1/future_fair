<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
  public function company()
  {
      return $this->belongsTo('App\Models\User','company_id');
  }

  public function event()
   {
       return $this->belongsTo('App\Models\Event','event_id');
   }
}
