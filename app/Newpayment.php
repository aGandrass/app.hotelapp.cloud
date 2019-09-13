<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newpayment extends Model
{
    protected $fillable = [
      'title',
      '_salutation',
      'firstname',
      'lastname',
      'email',
      'telephone',
      'arrival',
      'departure',
      'rooms',
      'persons',
      'children',
      'category',
      'total',
      'language',
      'type',
      'cardholder',
      'paymentuniqid',
      'paymentaccess',
      'paymentstatus',
      'paymentuniqlink',
      '_user',
      'active',
      '_userSoftdelete',
      '_userLastEdit',
    ];
    public function users()
    {
      return $this->belongsTo(User::class);
    }
}
