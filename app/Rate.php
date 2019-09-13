<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
  public function calendars()
  {
      return $this->belongsToMany(Calendar::class);
  }

}
