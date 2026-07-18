<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Http\Controllers\SourceCtrl;
use App\Http\Controllers\Router;

class ExpireController extends Controller
{
  protected $source;
  public function __construct()
  {
    $this->source = new SourceCtrl;
  }

  //this method for testing perpose only
  public function addExpireUsers()
  {
    $router = new Router;
    $users = [
      [
        'ip' => '192.168.18.111',
        'name' => 'api user 1'
      ],
      [
        'ip' => '192.168.18.112',
        'name' => 'api user 2'
      ]
    ];

    $users = json_decode(json_encode($users));

    $router->addExpireIP($users);
  }

  static function expiredCheck()
  {
    $router = new Router;
    $smsctrl = new SmsCtrl;

    try {
      $users = User::with(['package:id,price'])
      ->whereRaw('DATE(payment_date) <= ?', date('Y-m-d'))
      ->where('status', 'Active')
      ->where('service_type', 'Static')
      ->select('id', 'name', 'contact', 'username', 'payment_date', 'ip', 'package_id', 'balance')
      ->get();

      //numbers for sms
      $numbers = '';
      
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
          $payment_date = date('Y-m-d', strtotime($payment_date.' +1 month'));
        }

        User::where('id', $user->id)->update([
          'status' => $status,
          'balance' => $balance,
          'payment_date' => $payment_date
        ]);

        //
        $numbers .= '88'.$user->contact.',';
      }

      //expired users block from mikrotik
      $router->addExpireIP($users, $list = 'Expired');

      //send notification by sms
      $smsctrl->sendSms($numbers, 'আপনার ইন্টারনেট সংযোগের মেয়াদ শেষ, বিল পে করুন। বিকাশ 01703587911-CBT');

      //send sms one by one
      // foreach($users as $user)
      // {
      //   $smsctrl->sendSms('88'.$user->contact, 'CBT: Your internet service stop. Bill pay for turn on it. Username:'.$user->contact);
      // }
      
    }
    catch(\Exception $e)
    {
      \Log::info($e);
    }

  }

  //get expired users and notify to the admin over email
  public function expiredUsers()
  {
    $source = new SourceCtrl;
    $host = $source->host();

    $today = date('Y-m-d');
    $users = User::whereRaw('DATE(payment_date) <= ?', $today)
    ->where('service_type', 'Static')
    ->whereIn('status', ['Active', 'Expire'])
    ->orderBy('payment_date', 'DESC')
    ->select('id', 'payment_date', 'name', 'contact', 'ip')
    ->get();

    $today_expired = $other_expired = '';
    foreach($users as $user)
    {
      if($user->payment_date == $today)
      {
        $today_expired .= '<tr>'.
        '<td><a href="'.$host.'/admin/user/'.$user->id.'">'.$user->name.'</a></td>'.
        '<td>'.$user->contact.'</td>'.
        '<td>'.$source->dformat($user->payment_date).'</td>'.
        '<td>'.$user->ip.'</td>'.
        '</tr>';
      }
      else
      {
        $other_expired .= '<tr>'.
        '<td><a href="'.$host.'/admin/user/'.$user->id.'">'.$user->name.'</a></td>'.
        '<td>'.$user->contact.'</td>'.
        '<td>'.$source->dformat($user->payment_date).'</td>'.
        '<td>'.$user->ip.'</td>'.
        '</tr>';
      }

    }

    // if(!$today_expired)
    // {
    //   return;
    // }

    //style
    $style = 'table, th, td{ border:1px solid; border-collapse: collapse; padding:5px }';

    $today_expire_user_list = '';
    if($today_expired)
    {
      $today_expire_user_list = '<h3>These users will expire today</h3>'.
      '<table border=1 collapsible=collapse>'.
      $today_expired.
      '</table>'.
      '<br>';
    }

    //email body
    $email_body = '<style>table, th, td{ border:1px solid; border-collapse: collapse; padding:5px }</style>'.
    '<div>'.
      $today_expire_user_list.
      '<h4>Other Expired Users</h4>'.
      '<table style="border:1px solid">'.
      $other_expired.
      '</table>'.
      '</div>';

    $email_data = [
      'email_to' => 'rirchse@gmail.com',
      // 'email_bcc' =>  'wm.shoriful@gmail.com',
      'subject' => 'Expired Users List',
      'email_body' => $email_body,
      'style' => $style
    ];

    //send email
    $source->sendMail($email_data);

    //send sms
    //আগামীকাল ইন্টারনেটের মেয়াদ শেষ হবে। বিল পে করুন। বিকাশ 01703587911-CBT
  }
}
