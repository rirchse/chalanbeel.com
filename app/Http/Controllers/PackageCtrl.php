<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Paymethod;
use App\Package;
use App\Service;
use App\PaymentReceive;
use App\Location;
use App\Device;
use App\User;
use Redirect;
use DB;
use Session;
use Auth;

class PackageCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $packages = Package::where(function($query) {
                $query->where('status', 'Active')
                      ->orWhere('status', 1);
            })
            ->orderBy('price', 'ASC')
            ->get();
        return view('homes.view-packages', compact('packages'));
    }

    public function check_package()
    {
        $packages = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->where('services.status', 1)
        ->where('packages.status', 1)
        ->select('packages.service')
        ->groupBy('packages.service')
        ->orderBy('packages.service', 'ASC')
        ->get();
        $limits = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->where('services.status', 1)
        ->where('packages.status', 1)
        ->select('packages.time_limit')
        ->groupBy('packages.time_limit')
        ->orderBy('packages.time_limit')
        ->get();
        return view('homes.check_package')->withPackages($packages)->withLimits($limits);
    }

    public function checkPackage(Request $request)
    {
        //data validation
        $this->validate($request, array(
            'package'      => 'required|max:50',
            'time_limit'   => 'required|max:50'
        ));
        $service = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->where('packages.service', $request->package)
        ->where('packages.time_limit', $request->time_limit)
        ->where('services.status', 1)
        ->where('packages.status', 1)
        ->select('services.*', 'packages.service', 'packages.speed', 'packages.time_limit', 'packages.connection', 'packages.price')
        ->first();
        $packages = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->where('services.status', 1)
        ->where('packages.status', 1)
        ->select('packages.service')
        ->groupBy('packages.service')
        ->orderBy('packages.service', 'ASC')
        ->get();
        $limits = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->where('services.status', 1)
        ->where('packages.status', 1)
        ->select('packages.time_limit')
        ->groupBy('packages.time_limit')
        ->orderBy('packages.time_limit')
        ->get();
        return view('homes.check_package')->withPackages($packages)->withLimits($limits)->withService($service);
    }

    public function check_payment()
    {
        $payments = Paymethod::where('status', 1)->get();
        return view('homes.check_payment')->withPayments($payments);
    }

    public function checkPayment(Request $request)
    {
        //validate the data
        $this->validate($request, array(
            'payment_method' => 'required|max:255',
            'paid_mobile_no' => 'required|max:11',
            'transaction_id' => 'required|max:32',
        ));

        $payments = PaymentReceive::where('payment_method', $request->payment_method)
        ->where('account_number', $request->paid_mobile_no)
        ->where('transaction_id', $request->transaction_id)
        ->first();

        $services = '';
        if(empty($payments)) {
            Session::flash('error', 'Payment information does not match!');
            return redirect('/check_payment');
        } elseif ($payments->status != 0) {
            Session::flash('error', 'You are already registered by this payment!');
            return redirect('/check_payment');
        } else {
            $services = Service::where('status', 1)
            ->where('category', 'Internet')
            ->where('price', $payments->receive_amount)
            ->get();
        }

        Session::put('services', $services);
        Session::put('payment_id', $payments->id);
        return redirect('/registration');
    }

    public function create()
    {
        $area = Location::where('status', 1)->orderBy('id', 'ASC')->get();
        return view('homes.register')->withAreas($area);
    }

    public function store(Request $request)
    {
        //validate the data
        $this->validate($request, array(
            'full_name'    => 'required|min:2|max:32',
            'contact'       => 'required|min:11|max:11|confirmed'
            ));
        $exuser = User::where('contact', $request->contact)->first();
        // dd($exuser->contact);
        if($exuser){
            return view('homes.register-confirm', compact('exuser'));
        }

            //store in the database
            $user = new Users;
            $user->full_name    = $request->full_name;
            $user->username     = $request->contact;
            $user->email        = $request->email;
            $user->password     = bcrypt($request->contact);
            $user->contact      = $request->contact;
            $user->join_date    = date('Y-m-d H:i:s');
            $user->save();

            //session flashing
            // Session::flash('success', 'New account successfully created! <br> You will get a confirmation message to this mobile number: <b>'.$request->contact.'</b>');
            
            //return to the show page
            return redirect('/package/'.$user_id.'/payment/'.$service_id);
    }

    public function show($user)
    {
        $user = User::find($user);
        $package = Package::find(Session::get('_package_id'));
        return view('homes.package-details', compact('user', 'package'));
    }

    public function select($id)
    {
        Session::put('_package_id', $id);
        return view('homes.register-user');
    }

    public function storeService(Request $request, $id)
    {
        //
    }
}