<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Users;
use App\Paymethod;
use App\ActiveService;
use App\Service;
use App\Package;
use App\PaymentReceive;
use App\Location;
use App\Device;
use App\User;
use App\Payment;
use Redirect;
use DB;
use Session;
use Auth;
use Mail;

class PackageCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();
        $services = Service::leftJoin('packages', 'packages.id', 'services.package_id')
        ->where('services.user_id', $user->id)->orderBy('services.id', 'DESC')->get();
        $payments = Payment::leftJoin('services', 'payments.service_id', 'services.id')
        ->leftJoin('users', 'users.id', 'services.user_id')
        ->where('services.user_id', $user->id)
        ->get();
        return view('users.index')->withServices($services)->withPayments($payments);
    }

    public function check_package()
    {
        $packages = Service::where('status', 1)
        ->select('package')
        ->groupBy('package')
        ->orderBy('id', 'ASC')
        ->get();
        $limits = Service::where('status', 1)
        ->select('time_limit')
        ->groupBy('time_limit')
        ->orderBy('time_limit')
        ->get();
        return view('users.check_package')->withPackages($packages)->withLimits($limits);
    }

    public function checkPackage(Request $request)
    {
        //data validation
        $this->validate($request, array(
            'package'      => 'required|max:50',
            'time_limit'   => 'required|max:50'
        ));
        $service = Service::where('package', $request->package)->where('time_limit', $request->time_limit)->where('status', 1)->first();
        $packages = Service::where('status', 1)
        ->select('package')
        ->groupBy('package')
        ->orderBy('id', 'ASC')
        ->get();
        $limits = Service::where('status', 1)
        ->select('time_limit')
        ->groupBy('time_limit')
        ->orderBy('time_limit')
        ->get();
        return view('users.check_package')->withPackages($packages)->withLimits($limits)->withService($service);
    }

    public function check_payment()
    {
        $payments = Paymethod::where('status', 1)->get();
        return view('users.check_payment')->withPayments($payments);
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
        return view('users.register')->withAreas($area);
    }

    public function store(Request $request)
    {

        //validate the data
        $this->validate($request, array(

            'full_name'    => 'required|min:2|max:32',
            'email'         => 'unique:users|email|max:50|nullable',
            'contact'       => 'required|min:11|max:11|confirmed',
            'service'       => 'required|max:255',
            'connection'    => 'required|max:255',
            'speed'         => 'required|max:255',
            'time_limit'    => 'required|max:255',
            'area'          => 'required|max:255'

        ));

        if ( !empty(Users::where('contact', $request->contact)->first()) ) {
            Session::flash('error', 'The contact number already registered. Please complete the payment');
            return redirect('/user_payment');

        } else if( empty(Service::where('service', $request->service)->where('connection', $request->connection)->where('speed', $request->speed)->where('time_limit', $request->time_limit)->first()) ) {
            Session::flash('error', 'Service, connection, speed not match as package!');
            return redirect('/registration');

        } else {

            // mac addr generator
            function GetMAC() {
                ob_start();
                system('getmac');
                $Content = ob_get_contents();
                ob_clean();
                return substr($Content, strpos($Content,'\\')-20, 17);
            }

            $service_id = Service::where('service', $request->service)->where('connection', $request->connection)->where('speed', $request->speed)->where('time_limit', $request->time_limit)->first()->id;

            //store in the database
            $user = new Users;
            $user->full_name    = $request->full_name;
            $user->username     = $request->contact;
            $user->email        = $request->email;
            $user->password     = bcrypt($request->contact);
            $user->int_password = $request->contact;
            $user->contact      = $request->contact;
            $user->mac_address  = GetMAC();
            $user->left_long    = '';
            $user->service_id   = $service_id;
            $user->location_id  = $request->area;
            $user->join_date    = date('Y-m-d');
            $user->save();

            $user_id = Users::orderBy('id', 'DESC')->first()->id;

            // create active service
            $service = new ActiveService;
            $service->reference     = 'cbtepay';
            $service->service_id    = $service_id;
            $service->location_id   = $request->area;
            $service->user_id       = $user_id;
            $service->password      = $request->contact;
            $service->creator_role  = 'user';
            $service->created_by    = $user_id;
            $service->status        = 0;

            //session flashing
            Session::flash('success', 'New account successfully created! <br> You will get a confirmation message to this mobile number: <b>'.$request->contact.'</b>');
            
            //return to the show page
            return redirect('/create/'.$user_id.'/payment/'.$service_id);
        }
    }

    public function create_payment($user, $service)
    {
        //
        $user = User::leftJoin('active_services', 'users.id', 'active_services.user_id')
        ->leftJoin('services', 'active_services.service_id', 'services.id')
        ->leftJoin('locations', 'active_services.location_id', 'locations.id')
        ->find($user);
        return view('users.create_payment')->withUser($user);
    }

    public function myOffer()
    {
        $offers = [];
        return view('users.view_offers')->withOffers($offers);
    }

    public function requestForOffer(Request $request)
    {
        $this->validate($request, array(
            'details' => 'required|max:500'
        ));

        $user = Auth::user();
        $users = User::where('join_date', date('Y-m-d'))->get();
        if($user->status != 0) {
            Session::flash('error', 'There have no any free offer for you. Please contact with service provider and get internet connection at your home where you are.');
            return redirect('/home');
        } else if (count($users) >= 5) {
            Session::flash('error', 'We are sorry! Free offer limit over. Please try again later. Thank you for your patient. We will increase free offer packages limit soon! You have to be wait or you can get internet connection at home. Please contact with us.');
            return redirect('/home');
        } else {

            $update = User::find($user->id);
            $update->status = 2;
            $update->save();

            $area = Location::find($user->location_id)->station;

            $data = array(
                'name'    => $user->full_name,
                'contact' => $user->contact,
                'email'   => $user->email,
                'area'    => $area,
                'details' => $request->details
            );

            Mail::send('emails.request_free_internet', $data, function($message) use ($data){
                $message->from($data['email']);
                $message->to('admin@chalanbeel.net');
                $message->subject('Free Internet Request | Chalan Beel Technology');
            });

            Session::flash('success', 'Thank you for your request. An email has been sent to Chalan Beel Technology support team. They will send you an SMS with login details after verify your information. Please be patient and connect with us.');
            return redirect('/home');

        }
    }

    public function packages()
    {
        $packages = Package::orderBy('id', 'DESC')->get();
        return view('users.view_packages')->withPackages($packages);
    }

    public function get_package($id)
    {
        $package = Package::find($id);
        if($package->status != 1) {
            Session::flash('error', 'Sorry! this package is not active. Please chose another package.');
            return redirect('/view_packages');
        } else {
            return view('users.get_package')->withPackage($package);
        }        
    }
}