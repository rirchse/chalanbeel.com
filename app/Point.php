<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
  protected $fillable = [
    'address',
    'lat_lon',
    'lat',
    'lng',
    'details',
    'image',
    'created_at',
    'created_by',
    'status'
  ];

  public function adminCreated()
  {
    return $this->belongsTo(Admin::class, 'created_by');
  }

  public function adminUpdated()
  {
    return $this->belongsTo(Admin::class, 'updated_by');
  }
}