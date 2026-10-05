<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
    //
    protected $fillable = [
      'amount',
      'whats_for',
      'date',
      'details',
      'created_by'
    ];
}
