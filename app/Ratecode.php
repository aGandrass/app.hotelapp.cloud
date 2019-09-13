<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratecode extends Model
{
    protected $primaryKey = 'ratecodeID';
    protected $keyType = 'string';
    public $incrementing = false;
}
