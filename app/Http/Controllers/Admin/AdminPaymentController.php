<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notify;
use App\Address;
use App\User;
use App\Service;
use App\Payment;
use App\Paymethod;
use Auth;
use Session;
use DB;
use Image;

class AdminPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function createPayment()
    {
        return view('bkash.bkash-payment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allBills()
    {
      return Payment::billings();
    }

    public function index(Request $request)
    {
      $user_id = $request->user_id;
      $start_date = $request->start_date;
      $end_date = $request->end_date;

      $date = date('Y-m-d', strtotime('-1 month'));
      $payments = [];
      $total = 0;
      if($user_id || $start_date && $end_date)
      {
        $payments = Payment::orderBy('payments.id', 'DESC')
        ->leftJoin('users', 'payments.user_id', 'users.id')
        ->when($user_id, function($query, $user_id)
        {
          $query->where('user_id', $user_id);
        })
        ->when($start_date, function($query, $start_date) use($end_date)
        {
          $query->whereRaw('DATE(payments.receive_date) >= ?', $start_date)
          ->whereRaw('DATE(payments.receive_date) <= ?', $end_date);
        });
        $total = $payments->sum('receive');
        $payments = $payments->select('payments.*', 'users.name', 'users.contact')
        ->get();
      }

      $users = User::latest()
      ->where('service_type', 'Static')
      ->select('id', 'name')
      ->get();
      
      return view('admins.billings.index', compact('payments', 'users', 'user_id', 'start_date', 'end_date', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addPayment($id, $billing_date)
    {
        $service = Service::leftJoin('users', 'services.user_id', 'users.id')
        ->leftJoin('payments', 'services.id', 'payments.service_id')
        ->select('services.*', 'services.username', 'users.name')
        ->find($id);

        $paymethods = Paymethod::orderBy('id', 'DESC')->get();
        return view('admins.billings.create_payment', compact('service', 'paymethods', 'billing_date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        //validate the data
        $this->validate($request, array(
            'payment_method'    => 'required|min:1|max:50'
            ));
        $paymethod = Paymethod::find($request->payment_method);
        if($paymethod->payment_system == 'Cash'){
            $this->validate($request, array(
                'service_id'      => 'required|max:255',
                'received_amount' => 'required|min:2|max:9999',
                'receive_date'    => 'required|date',
                'billing_month'   => 'required|max:20'
            ));
        }else{
            $this->validate($request, array(
                'received_amount'   => 'required|min:2|max:9999',
                'account_number'    => 'required|max:11',
                'reference_number'  => 'required|max:255',
                'trxid'             => 'required|max:50',
                'details'           => 'max:500'
            ));
        }

        //store in the database
        $payment = new Payment;
        $payment->paymethod_id  = $request->payment_method;
        $payment->package_id    = $request->service_id;
        $payment->receive       = $request->received_amount;
        $payment->account_no    = $request->account_number;
        $payment->refer_no      = $request->reference_number;
        $payment->trxid         = $request->trxid;
        $payment->receive_date  = $request->receive_date;
        $payment->billing_month = $request->billing_month;
        $payment->details       = $request->details;
        $payment->status        = $request->status;
        $payment->created_by    = $admin->id;
        $payment->save();

        $service = Service::find($request->service_id);
        $service->last_pay_at = $request->receive_date;
        $service->save();

        //last payment id
        $lastpay = Payment::orderBy('id', 'DESC')->select('id')->first();

        //session flashing
        Session::flash('success', 'New payment successfully created!');
        
        //return to the show page
        return redirect('/admin/payment/'.$lastpay->id);
    }

    public function StoreUserPayment(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        //validate the data
        $this->validate($request, array(

            'payment_method'    => 'required|min:1|max:50',
            'received_amount'   => 'required|min:2|max:50',
            'account_number'    => 'min:11|max:11',
            'trxid'             => 'max:50',
            'cust_id'           => 'max:255',
            'detail'            => 'max:500'

        ));

        //store in the database
        $userPayment = new Payment;
        $userPayment->receive_amount      = $request->received_amount;
        $userPayment->account_number      = $request->account_number;
        $userPayment->transaction_id      = $request->trxid;
        $userPayment->payment_method      = $request->payment_method;
        $userPayment->details             = $request->detail;
        $userPayment->created_by          = $admin->id;

        $userPayment->save();

        //session flashing
        Session::flash('success', 'New payment successfully created!');
        
        //return to the show page
        return redirect('/admin/create/'.$request->cust_id.'/user_payment_complete');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Payment::find($id);
        return view('admins.billings.read', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $payment = Payment::find($id);
      $user = $payment->user;
      return view('admins.billings.edit', compact('payment', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = Auth::guard('admin')->user()->id;

        //validate the data
        $data = $request->validate([
            'receive_date' => 'required',
            'receive'          => 'required'
            ]);

            //update to the database
            try {
              $payment = Payment::where('id', $id)->update($data);
            }
            catch(\Exception $e)
            {
              return $e->getMessage();
            }

        //session flashing
        Session::flash('success', 'Payment successfully updated!');
        
        //return to the show page
        return redirect()->route('payment.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $payment = Payment::find($id);
      $user = User::find($payment->user_id);
      if($user && $user->balance >= $payment->receive)
      {
        User::where('id', $user->id)->update([
            'balance' => DB::raw("balance - ".intval($payment->receive))
          ]);
      }
      $payment->delete();

      Session::flash('success', 'The payment successfully deleted.');

      return back();
    }

    public function delete($id)
    {
        Payment::find($id)->delete();

        Session::flash('success', 'The Payment item successfully deleted!');
        return redirect('/admin/bill/paid/view');
    }

    public function print($id)
    {
        $bill = Service::leftJoin('users', 'users.id', 'services.user_id')
        ->find($id);
        return view('admins.billings.print_due_bill', compact('bill'));
    }
}