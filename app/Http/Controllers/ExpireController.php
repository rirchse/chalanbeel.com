<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class ExpireController extends Controller
{
  static function expiredCheck()
  {
    try{
      $users = User::with(['package:id,price'])
      ->whereRaw('DATE(payment_date) <= ?', date('Y-m-d'))
      ->where('status', 'Active')
      ->where('service_type', 'Static')
      ->select('id', 'contact', 'username', 'payment_date', 'ip', 'package_id', 'balance')
      ->get();
  
      // dd($users);
      foreach($users as $user)
      {
        $price = $user->package?$user->package->price:0;
        User::where('id', $user->id)->update([
          'status' => 'Expire',
          'balance' => $user->balance - $price
        ]);
      }
    }
    catch(\Exception $e)
    {
      \Log::info($e);
    }

  }
}
