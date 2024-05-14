<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Notify;
use App\Paymethod;
use App\User;
use Session;
use DB;
use Image;

class PaymethodController extends Controller
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
    public function index()
    {
        $paymethod = Paymethod::orderBy('id', 'DESC')->get();
        return view('admins.payment_methods.view_paymethod')->withPaymethods($paymethod);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.payment_methods.create_paymethod');
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
        $this->validate($request, array(

            'bank_name'         => 'required|min:2|max:50',
            'payment_system'    => 'required|max:255',
            'operator'          => 'required|max:255',
            'country_code'      => 'max:255',
            'account_no'        => 'max:255',
            'detail'            => 'max:500'

        ));

        //store in the database
        $create = new Paymethod;
        $create->bank_name      = $request->bank_name;
        $create->payment_system = $request->payment_system;
        $create->operator       = $request->operator;
        $create->country_code   = $request->country_code;
        $create->account_number = $request->account_no;
        $create->detail         = $request->detail;
        $create->created_by     = $user_id;
        $create->status         = 1;

        $create->save();

        //session flashing
        Session::flash('success', 'New Payment Method successfully created!');
        

        //return to the show page
        //return redirect('/admin/bol_confirm/'.$request->work_order_id.'/'.$request->pick_up.'/'.$request->delivery);
        //->withPickaddr($pickup_address)->withDeliaddr($delivery_address);
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
        $paymethod = Paymethod::find($id);
        return view('admins.payment_methods.edit_paymethod')->withPaymethod($paymethod);
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
        // validate the data
        $this->validate($request, array(
            'bank_name'         => 'required|min:2|max:50',
            'payment_system'    => 'required|max:255',
            'operator'          => 'required|max:255',
            'country_code'      => 'required|max:255',
            'account_no'        => 'required|max:255',
            'details'            => 'max:500'
            ));

        //save the data to the database
        $update = Paymethod::find($id);
        $update->bank_name      = $request->input('bank_name');
        $update->payment_system = $request->input('payment_system');
        $update->operator       = $request->input('operator');
        $update->country_code   = $request->input('country_code');
        $update->account_number = $request->input('account_no');
        $update->detail         = $request->input('details');
        $update->updated_by     = $user_id;

        $update->save();

        //set flash data with success message
        Session::flash('success', 'Payment method was successfully updated.');

        //redirect with flash data to posts.show
        return redirect('/admin/paymethod/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //find bill of lading and delete
        Paymethod::find($id)->delete();

        //flash the message
        Session::flash('success', 'The paymethod successfully deleted.');

        //return to the index page
        return redirect('/admin/view_all_bols');
    }
}