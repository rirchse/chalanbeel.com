<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //protected $guard = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'username', 
        'email', 
        'password', 
        'contact',
        'work_at',
        'location',
        'profession',
        'lat_long', 
        'address', 
        'join_date',
        'billing_date',
        'payment_date',
        'date_of_birth',
        'service_type',
        'pon',
        'ip',
        'mac',
        'nid_no',
        'nid_image',
        'image',
        'status',
        'details',
        'created_by',
        'lat',
        'lng'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
