<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Notify;
use App\Address;
use App\User;
use App\Service;
use App\Payment;
use App\Paymethod;
use Session;
use DB;
use Image;

class PaymentController extends Controller
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

    public function index()
    {
      $date = date('Y-m-d', strtotime('-1 month'));
      $payments = Payment::orderBy('payments.id', 'DESC')
      ->leftJoin('users', 'payments.user_id', 'users.id')
      ->whereRaw('DATE(payments.created_at) >= ?', $date)
      ->select('payments.*', 'users.name', 'users.contact')
      ->get();
      
      $services = Service::leftJoin('users', 'users.id', 'services.user_id')
      ->where('services.status', 1)
      ->select('services.*', 'users.name', 'users.contact')
      ->get();
      
      return view('admins.billings.index')
      ->withPayments($payments)
      ->withServices($services);
    }

    public function due()
    {        
        $services = Service::leftJoin('users', 'users.id', 'services.user_id')
        // ->leftJoin('packages', 'services.id', 'packages.service_id')
        ->where('services.status', 1)->select('services.*', 'users.name', 'users.contact')->get();
        return view('admins.billings.view_due_payments')->withServices($services);
    }

    public function totalPaid($id)
    {
        $payments = Payment::leftJoin('services', 'services.id', 'payments.service_id')
        ->where('service_id', $id)->orderBy('id', 'DESC')->select('payments.*', 'services.username')->get();
        return view('admins.billings.view_payments', compact('payments'));
    }

    public function totalDue($id)
    {        
        $service = Service::leftJoin('packages', 'packages.id', 'services.package_id')
        ->leftJoin('users', 'users.id', 'services.user_id')
        // ->leftJoin('service_plans', 'services.id', 'service_plans.service_id')
        ->select('services.*','users.name', 'users.contact', 'packages.speed', 'packages.time_limit')
        ->find($id);

        $payments = Payment::where('service_id', $id)->select('billing_month', 'receive')->get();

        return view('admins.billings.view_total_due', compact('service', 'payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->leftJoin('users', 'services.user_id', 'users.id')
        ->leftJoin('payments', 'payments.service_id', 'services.id')
        ->orderBy('payments.receive_date', 'ASC')
        ->select('services.*', 'packages.service', 'packages.speed', 'packages.time_limit', 'packages.connection', 'payments.receive', 'payments.receive_date', 'users.name', 'users.contact')
        ->get();

        return view('admins.billings.view_services')->withServices($services);
    }

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
        $bill = Payment::leftJoin('packages', 'packages.id', 'payments.package_id')
        ->leftJoin('admins', 'admins.id', 'payments.created_by')
        ->find($id);
        return view('admins.billings.read_payment', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymethod = Paymethod::orderBy('id', 'DESC')->get();
        $payment = Payment::find($id);
        $services = Service::leftJoin('users', 'services.user_id', 'users.id')
        ->leftJoin('packages', 'services.package_id', 'packages.id')
        ->select('services.*', 'users.contact', 'users.name', 'packages.speed', 'packages.connection')->get();
        return view('admins.billings.edit_payment')->withPayment($payment)->withPaymethods($paymethod)->withServices($services);
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
        $this->validate($request, array(
            'payment_method'    => 'required|min:1|max:50'
            ));
        $paymethod = Paymethod::find($request->payment_method);
        if($paymethod->payment_system == 'Cash'){
            $this->validate($request, array(
            'service_id'      => 'required|max:255',
            'receive_date'    => 'required|date',
            'billing_month'   => 'required|max:20',
            'received_amount' => 'required|min:2|max:9999'
            ));
        }else{
            $this->validate($request, array(
                'received_amount'   => 'required|min:2|max:9999',
                'account_number'    => 'required|max:11',
                'reference_number'  => 'required|max:255',
                'trxid'             => 'required|max:50',
                'detail'            => 'max:500'
            ));
        }

        //store in the database
        $payment = Payment::find($id);
        $payment->service_id    = $request->input('service_id');
        $payment->paymethod_id  = $request->input('payment_method');
        $payment->receive       = $request->input('received_amount');
        $payment->account_no    = $request->input('account_number');
        $payment->refer_no      = $request->input('reference_number');
        $payment->trxid         = $request->input('trxid');
        $payment->receive_date  = $request->input('receive_date');
        $payment->billing_month = $request->input('billing_month');
        $payment->details       = $request->input('detail');
        $payment->status        = $request->input('service_id')?1:0;
        $payment->updated_by    = $user_id;

        $payment->save();

        $service = Service::find($request->service_id);
        $service->last_pay_at = $request->input('receive_date');
        $service->save();

        //session flashing
        Session::flash('success', 'Payment successfully updated!');
        
        //return to the show page
        return redirect('/admin/payment/'.$id);
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
      if($user->balance >= $payment->receive)
      {
        User::where('id', $user->id)->update([
            'balance' => DB::raw("balance - ".intval($payment->receive))
          ]);
      }
      $payment->delete();
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