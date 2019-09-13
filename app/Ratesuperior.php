<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratesuperior extends Model
{
  protected $table = 'ratesuperior';
  protected $primaryKey = 'ratesuperiorID';
  protected $keyType = 'string';
  public $incrementing = false;
}
