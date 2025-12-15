<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Notify;
use App\Address;
use App\User;
use Session;
use DB;
use Image;

class apiUserCtrl extends Controller
{
	public function index(Request $request)
	{
    $status = $request->input('status');
    $date = $request->input('date');
    $service_type = $request->input('service_type');
    $ip = $request->input('ip');
    $iparray = $request->input('iparray');

		$users = User::query()
    ->when($status, function($query, $status)
    {
      $query->where('status', $status);
    })
    ->when($date, function($query, $date)
    {
      $query->where('payment_date', 'like',  '%'.$date);
    })
    ->when($service_type, function($query, $service_type)
    {
      $query->where('service_type', $service_type);
    })
    ->when($ip, function($query, $ip)
    {
      $query->where('ip', $ip);
    });

    if($iparray)
    {
      $users = $users->pluck('ip')->toArray();
    }
    else
    {
      $users = $users->select('id', 'name', 'contact', 'ip', 'mac')
      ->get();
    }

    return $users;
	}
}