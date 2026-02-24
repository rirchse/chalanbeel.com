<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = [
    'receive',
    'account_no',
    'refer_no',
    'trxid',
    'receive_date',
    'billing_month',
    'service_id',
    'user_id',
    'paymethod_id',
    'user_inputs',
    'details',
    'status',
    '	created_by',
    'created_at',
  ];

  public function package()
  {
    return $this->belongsTo(Package::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function paymethod()
  {
    return $this->belongsTo(Paymethod::class);
  }

  public static function billings()
  {
    $billings_arr = $billing_months = [];
    $start_date = '2019-01';
    $end_date = '2021-12';

    $start_at = strtotime($start_date);
    $end_at = strtotime($end_date);

    $user_id = 3;

    //get all payments with service and service plans
    $payments = Payment::leftJoin('services', 'services.id', 'payments.service_id')
    ->leftJoin('service_plans', 'service_plans.service_id', 'services.id')
    ->where('services.id', $user_id)
    ->whereBetween('payments.billing_month', [$start_date, $end_date])
    ->select('payments.*', 'service_plans.billing_date')
    ->get();
    
    //filter and make billings month array
    foreach($payments as $key => $value)
    {
        array_push($billing_months, $value->billing_month);
    }

    while($start_at <= $end_at)
    {
      // foreach($payments as $payment)
      // {
      //     if(in_array(date('Y-m', $start_at), $billing_months))
      //     {
      //        array_push($billings_arr, $payment->billing_date);
      //        break;
      //     }
      // }
      
      if( in_array(date('Y-m', $start_at), $billing_months) )
      {
        array_push($billings_arr, 'paid');
      }
      else
      {
      array_push($billings_arr, 'due');
      }

      $start_at = strtotime('+1 month', $start_at);
    }

    return dd($billings_arr);

  }
}
