<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
  public function company()
  {
      return $this->belongsTo('App\Models\User','company_id');
  }
}
