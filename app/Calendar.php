<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
  public function rates()
  {
      return $this->belongsToMany(Rate::class);
  }
  public function levels()
  {
      return $this->belongsTo(Level::class);
  }

}
