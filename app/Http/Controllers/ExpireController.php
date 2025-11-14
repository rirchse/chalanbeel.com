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
        $balance = 0;
        $status = 'Expire';
        $payment_date = $user->payment_date;
        $price = $user->package ? $user->package->price:0;

        if($user->balance >= $price)
        {
          $balance = $user->balance - $price;
        }
        else
        {
          $balance = $user->balance;
        }

        if($balance >= $price)
        {
          $status = 'Active';
          $payment_date = date('Y-m-d', strtotime($payment_date.' +30 days'));
        }

        User::where('id', $user->id)->update([
          'status' => $status,
          'balance' => $balance,
          'payment_date' => $payment_date
        ]);
      }
    }
    catch(\Exception $e)
    {
      \Log::info($e);
    }

  }
}
