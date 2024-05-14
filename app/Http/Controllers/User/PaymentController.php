<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Service;
use App\Payment;
use App\Notify;
use App\User;
use Session;
use DB;
use Image;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();
        $payments = Payment::leftJoin('services', 'services.id', 'payments.service_id')
        ->leftJoin('packages', 'packages.id', 'services.package_id')
        ->leftJoin('paymethods', 'paymethods.id', 'payments.paymethod_id')
        ->orderBy('payments.id', 'DESC')->where('services.user_id', $user->id)
        ->select('payments.*', 'packages.speed', 'packages.service', 'packages.time_limit', 'paymethods.payment_system')->get();
        return view('users.view_payments')->withPayments($payments);
    }

    public function dueBills()
    {
        $bills = Payment::leftJoin('services', 'services.id', 'payments.service_id')
        ->where('services.user_id', Auth::id())->select('services.*')->get();
        $services = Service::leftJoin('packages', 'packages.id', 'services.package_id')
        ->where('services.user_id', Auth::id())->select('services.*', 'packages.speed', 'packages.time_limit', 'packages.service')->get();
        
        return view('users.view_due_bills', compact('bills', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $service = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->select('packages.*', 'services.id as service_id')->find($id);
        return view('users.create_payment')->withService($service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        //validate the data
        $this->validate($request, array(
            'service_id'      => 'required|max:255',
            'payment_method'  => 'required|max:50',
            'transaction_id'  => 'required|max:50',
            'account_number'  => 'required|max:11',
            'paid_amount'     => 'required|max:9999'
        ));

        if(empty(Payment::where('account_no', $request->account_number)->where('trxid', $request->transaction_id)->where('paymethod_id', $request->payment_method)->where('status', 0)->orderBy('id', 'DESC')->first())) {
            //session flashing
            Session::flash('error', 'Please input your payment infomation carefully. Otherwise you do not pay for this service! If you are face any problem to payment verification, please call to service provider.');
            return redirect('/'.$request->service_id.'/payment');
        } else {

            //store in the database
            $payment = Payment::find($id);
            $payment->service_id  = $request->service_id;
            $payment->user_id     = $user->id;
            $payment->user_inputs = $request->payment_method.', '.$request->transaction_id.', '.$request->account_number.', '.$request->paid_amount;
            $payment->status      = 1;

            $payment->save();
        }

        //session flashing
        Session::flash('success', 'New payment successfully created!');
        
        //return to the show page
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
