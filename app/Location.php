<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function services()
    {
        return $this->hasMany(Service::class)->where('status', 1);
    }
}