<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'categoryID';
    protected $keyType = 'string';
    public $incrementing = false;
}
