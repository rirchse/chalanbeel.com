<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public function service()
    {
    	return $this->hasMany('App\Service');
    }

    public function payments()
    {
    	return $this->hasMany('App\Payment');
    }
}
