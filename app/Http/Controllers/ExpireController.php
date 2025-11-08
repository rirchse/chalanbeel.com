<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ExpireController extends Controller
{
  static function expiredCheck()
  {
    try{
      $users = User::whereRaw('DATE(payment_date) <= ?', date('Y-m-d'))
      ->where('status', 'Active')
      ->where('service_type', 'Static')
      ->select('id', 'contact', 'username', 'payment_date', 'ip')
      ->get();
  
      // dd($users);
      foreach($users as $user)
      {
        User::where('id', $user->id)->update([
          'status' => 'Expire'
        ]);
      }
    }
    catch(\Exception $e)
    {
      \Log::info($e);
    }

  }
}
