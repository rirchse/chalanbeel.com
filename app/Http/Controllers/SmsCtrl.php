<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SourceCtrl;

class SmsCtrl extends Controller
{
  public function sendSms($numbers, $message)
  {
    // $numbers = '8801825322626,8801778573396';
    // $message = 'First configuration test';

    $source = new SourceCtrl;

    $sms_host = config('services.sms.server');
    $server = $sms_host.'api?';

    $response = $source->sms($server, $numbers, $message);
    return $response;
  }
}
