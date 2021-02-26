<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pavillion extends Model
{
  protected $casts = [
    'remaining_slots' => 'array',
    'alloted_slots' => 'array',
  ];

  public function event()
   {
    return $this->belongsTo('App\Models\Event','event_id');
   }
}
