<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  protected $fillable = ['full_name','lat','lng','status'];
  // protected $casts = [
  //     'lat' => 'float',
  //     'lng' => 'float',
  // ];

    public function service()
    {
    	return $this->hasMany('App\Service');
    }

    public function payments()
    {
    	return $this->hasMany('App\Payment');
    }

    // public function admin()
    // {
    //   return $this->hasOne(Admins::class);
    // }
}
