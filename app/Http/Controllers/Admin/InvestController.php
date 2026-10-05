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
use App\Invest;
use Session;
use DB;
use Image;

class InvestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data = $this->validate($request, [
        'start_date' => 'nullable',
        'end_date' => 'nullable',
        'whats_for' => 'nullable'
      ]);

      $start_date = $end_date = $whats_for = '';
      if(isset($data['start_date']) || isset($data['start_date']) || isset($data['start_date']))
      {
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $whats_for = $data['whats_for'];
      }

        $invests = Invest::orderBy('date', 'DESC')
        ->when($start_date, function($query, $start_date) use($end_date)
        {
          $query->whereRaw('DATE(date) >= ?', $start_date)
          ->whereRaw('DATE(date) <= ?', $end_date);
        })
        ->get();

        return view('admins.invests.index', compact('invests', 'start_date', 'end_date', 'whats_for'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invests = Invest::orderBy('id', 'DESC')
        ->Limit(10)
        ->get();
        return view('admins.invests.create')->withInvests($invests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::guard('admin')->user()->id;
        //validate the data
        $data = $this->validate($request, [
          'amount'    => 'required|max:99999',
          'date'      => 'required|max:31',
          'whats_for' => 'required|max:9999',
          'details'   => 'max:9999'
        ]);

        //store in the database
        try{
          $data['created_by'] = auth()->id();
          //
          $result = Invest::create($data);

          //session flashing
          Session::flash('success', 'New invest successfully created!');
          
          //return to the show page
          return redirect('/admin/invest/create');
        }
        catch(\Exception $error)
        {
          return $error->getMessage();
        }
        return back();
    }

    public function StoreUserPayment(Request $request)
    {
        $user_id = Auth::guard('admin')->user()->id;
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
        $userPayment->created_by          = $user_id;

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
        $invest = Invest::find($id);
        return view('admins.invests.edit')->withInvest($invest);
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

            'amount'    => 'required|max:99999',
            'date'      => 'required|max:31',
            'whats_for' => 'required|max:9999',
            'vendor'    => 'max:999',
            'details'   => 'max:9999'

        ));

        //store in the database
        $invest = invest::find($id);
        $invest->amount     = $request->input('amount');
        $invest->date       = $request->input('date');
        $invest->whats_for  = $request->input('whats_for');
        $invest->details    = $request->input('details');
        $invest->status     = 1;
        $invest->updated_by = $user_id;

        $invest->save();

        //session flashing
        Session::flash('success', 'New invest successfully updated!');
        
        //return to the show page
        return redirect('/admin/invest/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        Session::flash('success', 'The client successfully deleted!');
        return redirect('/admin/show_clients');
    }
}