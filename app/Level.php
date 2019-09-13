<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
  protected $table = 'levels';
  protected $primaryKey = 'levelsID';
  protected $keyType = 'string';
  public $incrementing = false;

  public function calendars()
  {
      return $this->morphMany(Calendar::class);
  }

}
