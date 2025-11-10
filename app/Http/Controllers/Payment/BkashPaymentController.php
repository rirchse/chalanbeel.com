<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mahedi250\Bkash\Facade\CheckoutUrl;

/** customized */
use App\Service;
use App\ServicePlan;
use App\User;
use App\Payment;
use Session;
use DB;

class BkashPaymentController extends Controller
{
    public function pay(Request $request)
    {
        $user = auth()->user();
        $bill = User::with('package:id,price')
        ->where('id', $user->id)
        ->select('id', 'name', 'contact', 'balance', 'package_id')
        ->first();

        $amount = 0;
        $additional = [];

        if($user->package)
        {
          $amount = $user->package->price;
          $additional = [
            'payerReference'=> '_'.$user->contact, 
            'merchantInvoiceNumber' => date('Ymd-H:i:s')
          ];
        }
        else
        {
          Session::flash('error', 'Package and Price not selected for you.');
          return back();
        }

        if($amount > 0)
        {
          $response = CheckoutUrl::Create($amount, $additional);  
          return redirect($response->bkashURL);
        }
        Session::flash('error', 'Billing amount not decided.');
        return back();
    }

    public function callback(Request $request)
    {
        $status = $request->input('status');
        $paymentId = $request->input('paymentID');

        if ($status === 'success')
        {
            $response = CheckoutUrl::MakePayment($paymentId);

            if ($response->statusCode !== '0000')
            {
            return CheckoutUrl::Failed($response->statusMessage);
            }

            if (isset($response->transactionStatus)&&($response->transactionStatus=='Completed'||$response->transactionStatus=='Authorized'))
            {
              // update user database
              try {
                $user = User::find(auth()->id());
                User::where('id', auth()->id())->update(
                  [
                    'payment_date' => date('Y-m-d', strtotime($user->payment_date.'+30 days')),
                    'balance' => DB::raw("balance + ".intval($user->package->price)),
                    'status' => 'Active'
                  ]
                );

                // add to the payment
                Payment::create([
                  'receive' => $user->package->price,
                  'user_id' => $user->id,
                  'status' => 'Paid',
                  'trxid' => $request->input('paymentID')
                ]);

                return back();
              }
              catch(\Exception $e)
              {
                return $e->getMessage();
              }
              
              //Database Insert Operation
              return redirect('/home');
              return CheckoutUrl::Success($response->trxID."({$response->transactionStatus})");
            }
            else if($response->transactionStatus=='Initiated')
            {
              return CheckoutUrl::Failed("Try Again");
            }
        }

        else
        {
            return redirect('/home');
            return CheckoutUrl::Failed($status);
        }
    }

    public function refund(Request $request)
    {
        return CheckoutUrl::Refund(paymentID,$trxID,$amountToRefund);
    }


}
