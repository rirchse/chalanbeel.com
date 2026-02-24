<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
  protected $fillable = [
    'service', 
    'service_mode', 
    'server', 
    'connection', 
    'speed', 
    'time_limit',
    'price',
    'discount',
    'details',
    'status', 
    'created_by', 
    'created_at'
];

  public function user()
  {
    return $this->belongsTo(User::class, 'package_id');
  }

  // public function payment()
  // {
  //   return $this->belongsTo(Payment::class, 'package_id');
  // }
}
