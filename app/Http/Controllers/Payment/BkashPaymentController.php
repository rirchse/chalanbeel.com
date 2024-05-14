<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mahedi250\Bkash\Facade\CheckoutUrl;

/** customized */
use App\Service;
use App\ServicePlan;

class BkashPaymentController extends Controller
{
    public function pay(Request $request)
    {
        $user = auth()->user();
        $bill = Service::leftJoin('service_plans', 'service_plans.service_id', 'services.id')
        ->where('services.user_id', $user->id)
        ->OrderBy('service_plans.id', 'DESC')
        ->first();
        // dd($bill);

        $amount = 10;
        $additional = [];

        if($request->amount)
        {
            $amount = $request->amount;
        }
        elseif(!is_null($bill))
        {
            $amount = $bill->amount;
            // $amount = 5;
            $additional = [
                'payerReference'=> '_'.$user->username, 
                'merchantInvoiceNumber' => date('Ymd-H:i:s')
            ];
        }

        $response = CheckoutUrl::Create($amount, $additional);

        return redirect($response->bkashURL);

        // $response = CheckoutUrl::Create($amount);

        // dd($response->bkashURL);
        // return redirect($response->bkashURL);

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
                // dd($response);
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
