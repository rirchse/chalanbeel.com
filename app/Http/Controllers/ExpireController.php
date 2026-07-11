<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Http\Controllers\SourceCtrl;

class ExpireController extends Controller
{
  protected $source;
  public function __construct()
  {
    $this->source = new SourceCtrl;
  }

  static function expiredCheck()
  {
    try{
      $users = User::with(['package:id,price'])
      ->whereRaw('DATE(payment_date) <= ?', date('Y-m-d'))
      ->where('status', 'Active')
      ->where('service_type', 'Static')
      ->select('id', 'contact', 'username', 'payment_date', 'ip', 'package_id', 'balance')
      ->get();
      
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

  //get expired users
  public function expiredUsers()
  {
    $host = $this->source->host();

    $today = date('Y-m-d');
    $users = User::whereRaw('DATE(payment_date) <= ?', $today)
    ->whereIn('status', ['Active', 'Expire'])
    ->orderBy('payment_date', 'DESC')
    ->select('id', 'payment_date', 'name', 'contact')
    ->get();

    $today_expired = $other_expired = '';
    foreach($users as $user)
    {
      if($user->payment_date == $today)
      {
        $today_expired .= '<tr>'.
        '<td><a href="'.$host.'/admin/user/'.$user->id.'">'.$user->name.'</a></td>'.
        '<td>'.$user->contact.'</td>'.
        '<td>'.$user->payment_date.'</td>'.
        '</tr>';
      }
      else
      {
        $other_expired .= '<tr>'.
        '<td><a href="'.$host.'/admin/user/'.$user->id.'">'.$user->name.'</a></td>'.
        '<td>'.$user->contact.'</td>'.
        '<td>'.$user->payment_date.'</td>'.
        '</tr>';
      }

    }

    // dd($today_expired, $other_expired);

    //style
    $style = 'table, th, td{ border:1px solid; border-collapse: collapse; padding:5px }';

    //email body
    $email_body = '<style>table, th, td{ border:1px solid; border-collapse: collapse; padding:5px }</style>'.
    '<div>'.
      '<table border=1 collapsible=collapse>'.
      '<tr><td colspan="3"><h3>These users will expire today</h3></td></tr>'.
      $today_expired.
      '</table>'.
      '<hr>'.
      '<table style="border:1px solid">'.
      '<tr><td colspan="3"><h4>Other Expired Users</h4></td></tr>'.
      $other_expired.
      '</table>'.
      '</div>';

    $email_data = [
      'email_to' => 'rirchse@gmail.com',
      'email_bcc' =>  'wm.shoriful@gmail.com',
      'subject' => 'Expired Users List',
      'email_body' => $email_body,
      'style' => $style
    ];

    // return $email_body;

    //send email
    $this->source->sendMail($email_data);
  }
}
