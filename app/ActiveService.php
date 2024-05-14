<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveService extends Model
{
    public function service()
    {
    	return $this->hasOne('App\Service');
    }
}
