<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Router;
use App\Notify;
use App\Service;
use App\ServicePlan;
use App\Location;
use App\Package;
use App\Payment;
use App\User;
use Auth;
use Session;
use DB;
use Image;

class apiServiceCtrl extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function printAnualServices(Request $request)
    {
        $this->validate($request, [
            'year' => 'required',
            'service_id' => 'required'
            ]);
        $year = $request->year;
        $service_plan = ServicePlan::where('service_id', $request->service_id)->orderBy('id', 'ASC')->first();
        if(date('Y', strtotime($service_plan->billing_date)) > $request->year){
            Session::flash('error', 'Billing Year does not match!.');
            return redirect('/admin/service/'.$service->id);
        }

        $service = Service::leftJoin('packages', 'packages.id', 'services.package_id')
        ->leftJoin('users', 'users.id', 'services.user_id')
        // ->leftJoin('service_plans', 'services.id', 'service_plans.service_id')
        ->select('services.*','users.full_name', 'users.contact', 'packages.speed', 'packages.time_limit')
        ->find($request->service_id);

        $payments = Payment::where('service_id', $request->service_id)->select('billing_month', 'receive')->get();
        return view('admins.services.print_anual_report', compact('service', 'payments', 'year'));
    }

    public function printUnpaidServices()
    {
        $services = Service::leftJoin('users', 'users.id', 'services.user_id')
        ->leftJoin('locations', 'users.location_id', 'locations.id')
        ->orderBy('services.last_pay_at', 'ASC')
        ->where('services.status', 1)
        ->select('services.*', 'users.full_name', 'users.contact', 'users.status', 'users.join_date', 'locations.station')
        ->get();
        return view('admins.services.print_due_services')->withServices($services);
    }

    public function unpaidServices()
    {
        $services = Service::leftJoin('users', 'users.id', 'services.user_id')
        // ->leftJoin('payments', 'services.id', 'payments.service_id')
        ->leftJoin('locations', 'users.location_id', 'locations.id')
        ->orderBy('services.last_pay_at', 'ASC')
        ->where('users.status', 1)
        ->select('services.*', 'users.full_name', 'users.contact', 'users.status', 'locations.station')
        // ->limit(1)
        ->get();
        return view('admins.services.view_unpaid_services')->withServices($services);
    }

    public function liveServices()
    {
        $services = Service::leftJoin('users', 'users.id', 'services.user_id')
        ->where('services.status', 1)->select('services.*', 'users.full_name')->get();
        $liveusers = Router::pppActiveUsers();
        return view('admins.services.view_live_services')->withServices($services)->withLiveusers($liveusers);
    }

    public function activeServices()
    {
        $services = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->leftJoin('users', 'services.user_id', 'users.id')
        ->leftJoin('locations', 'locations.id', 'services.location_id')
        ->orderBy('services.id', 'DESC')
        ->where('services.status', 1)
        ->select('services.*', 'packages.service', 'packages.speed', 'packages.time_limit', 'packages.connection', 'users.full_name', 'locations.station', 'locations.id as location_id')
        ->get();
        return view('admins.services.view_active_services')->withServices($services);
    }

    public function activeServicesLocation($id)
    {
        $services = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->leftJoin('users', 'services.user_id', 'users.id')
        ->leftJoin('locations', 'locations.id', 'services.location_id')
        ->orderBy('services.id', 'DESC')
        ->where('services.status', 1)->where('services.location_id', $id)
        ->select('services.*', 'packages.service', 'packages.speed', 'packages.time_limit', 'packages.connection', 'users.full_name', 'locations.station', 'locations.id as location_id')
        ->get();
        return view('admins.services.view_active_services')->withServices($services);
    }

    public function index()
    {
        // return redirect('/admin/service/all/view');
        return Service::all();
    }

    public function view($type)
    {
        $status = 0;
        if($type == 'active'){
            $status = 1;
        }elseif($type == 'free'){
            $status = 2;
        }elseif($type == 'cancelled'){
            $status = 3;
        }

        $services = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->leftJoin('users', 'services.user_id', 'users.id')
        // ->leftJoin('payments', 'payments.service_id', 'services.id')
        ->orderBy('services.id', 'DESC')->where('services.status', $status)
        ->select('services.*', 'packages.service', 'packages.speed', 'packages.time_limit', 'packages.connection', 'users.full_name')
        ->get();
        if($type == 'all'){
            $services = Service::leftJoin('packages', 'services.package_id', 'packages.id')
        ->leftJoin('users', 'services.user_id', 'users.id')
        ->orderBy('services.id', 'DESC')
        ->select('services.*', 'packages.service', 'packages.speed', 'packages.time_limit', 'packages.connection', 'users.full_name')
        ->get();
        }
        return view('admins.services.view_services')->withServices($services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $packages = Package::orderBy('id', 'DESC')->where('status', 1)->get();
        $locations = Location::where('status', 1)->get();
        $user = User::find($id);
        return view('admins.services.create_service_select')->withLocations($locations)->withUser($user)->withServices($packages);
    }
    public function create2($id, $user){
        $user = User::find($user);
        $package = Package::find($id);
        $locations = Location::where('status', 1)->get();

        // dd(count(Router::hpuser('01755194754')));
        // dd(Router::Connect()->setMenu('/ppp secret')->getAll(array(), RouterOS\Query::where('name', '01755194754')));

        return view('admins.services.create_service')->withUser($user)->withPackage($package)->withLocations($locations);

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
            'package_id'    => 'required|max:255',
            'area'          => 'required|max:255',
            'amount'        => 'max:99999',
            'billing_date'  => 'max:18',
            'billing_plan'  => 'required|max:255',
            'discount'      => 'max:255',
            'mac'           => 'max:255',
            'device'        => 'max:255',
            'ip'            => 'max:255',
            'left_long'     => 'max:255',
            'status'        => 'max:255',
            'details'       => 'max:1000',
            'name'          => 'required|max:32',
            'password'      => 'required|max:32',
            'service'       => 'required|max:32',
            'server'        => 'max:32',
            'profile'       => 'required|max:32',
            'status'        => 'max:32',
            'comment'       => 'required|max:500'
        ));
        $user = User::find($request->user_id);
        $package = Package::find($request->package_id);

        //check service exists on the system
        $existing_service = Service::where('username', $request->name)->first();
        if(!empty($existing_service)){
            // session flashing
            Session::flash('error', 'This service already exists on the system.');
            //return to the show page
            return redirect('/admin/create/'.$package->id.'/service/'.$user->id);
        }

        if($request->router == 1){
            //create user on router
            if( $package->service_mode == 'pppoe' && count(Router::pppuser($request->name)) < 1 ){
                //create pppoe user
                Router::connect()->setMenu('/ppp secret')->add(array(
                    'name'         => $request->name,
                    'password'     => $request->password,
                    'service'      => $request->service,
                    'profile'      => $request->profile,
                    'comment'      => $request->comment
                ));
            } elseif ($package->service_mode == 'hotspot' && count(Router::hpuser($request->name)) < 1 ) {
                //create hotspot user
                Router::connect()->setMenu('/ip hotspot user')->add(array(
                    'server'       => $package->server,
                    'name'         => $request->name,
                    'password'     => $request->password,
                    'profile'      => $request->profile,
                    'comment'      => $request->comment
                ));
            } else {
                 // session flashing
                Session::flash('error', 'This service already exists on the system.');
                //return to the show page
                return redirect('/admin/create/'.$package->id.'/service/'.$user->id);
            }
        }

        //store in the database
        $service = new Service;
        $service->package_id  = $request->package_id;
        $service->location_id = $request->area;
        $service->user_id     = $request->user_id;
        $service->amount      = $request->amount;
        $service->billing_date= $request->billing_date;
        $service->billing_plan= $request->billing_plan;
        $service->username    = $request->name;
        $service->password    = $request->password;
        $service->device_mode = $request->device;
        $service->ip          = $request->ip;
        $service->mac         = $request->mac;
        $service->left_long   = $request->left_long;
        $service->discount    = $request->discount;
        $service->details     = $request->user_id;
        $service->created_by  = $user_id;
        $service->status      = $request->status;

        //user status update
        $service->save();
        $userupdate = User::find($user->id);
        $userupdate->status = 1;
        $userupdate->save();

        $lastentry = Service::orderBy('id', 'DESC')->first()->id;

        /* create service plan */
        $store = New ServicePlan;
        $store->service_id     = $lastentry;
        $store->amount         = $request->amount;
        $store->billing_date   = $request->billing_date;
        // $store->closed_at      = $service->closed_at;
        $store->billing_status = 'Open';
        $store->save();

        // session flashing
        Session::flash('success', 'New service successfully created!');

        //return to the show page
        return redirect('/admin/service/'.$lastentry);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::leftJoin('packages', 'packages.id', 'services.package_id')
        ->leftJoin('users', 'users.id', 'services.user_id')
        ->select('services.*', 'packages.service', 'packages.time_limit', 'packages.service_mode', 'packages.speed', 'users.full_name')
        ->find($id);
        return view('admins.services.read_service')->withService($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::orderBy('id', 'DESC')->get();
        $packages = Package::orderBy('id', 'DESC')->get();
        // $locations = Location::where('status', 1)->get();
        $service = Service::leftJoin('users', 'services.user_id', 'users.id')->where('services.id',$id)->select('services.*', 'users.full_name')->first();
        $locations = Location::where('status', 1)->get();
        return view('admins.services.edit_service')->withUsers($users)->withPackages($packages)->withService($service)->withLocations($locations);
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
            'package'       => 'required|max:255',
            'username'      => 'required|max:255',
            'password'      => 'required|max:255',
            'amount'        => 'max:99999',
            'billing_date'  => 'max:18',
            'billing_plan'  => 'required|max:255',
            'last_pay_at'   => 'max:18',
            'discount'      => 'max:255',
            'mac'           => 'max:255',
            'device'        => 'max:255',
            'ip'            => 'max:255',
            'left_long'     => 'max:255',
            'location'      => 'max:255',
            'status'        => 'max:255',
            'details'       => 'max:1000',
            'close_date'    => 'max:50'
        ));

        $user = User::find($request->user);

        //store in the database
        $service = Service::find($id);
        $service->package_id  = $request->input('package');
        $service->end_at      = $request->status == 3? $request->close_date:NULL;
        // $service->user_id     = $request->input('user');
        $service->amount      = $request->input('amount');
        $service->billing_date= $request->input('billing_date');
        $service->billing_plan= $request->input('billing_plan');
        $service->last_pay_at = $request->input('last_pay_at');
        $service->username    = $request->input('username');
        $service->password    = $request->input('password');
        $service->device_mode = $request->input('device');
        $service->ip          = $request->input('ip');
        $service->mac         = $request->input('mac');
        $service->left_long   = $request->input('left_long');
        $service->location_id = $request->input('location');
        $service->discount    = $request->input('discount');
        $service->details     = $request->input('details');
        $service->updated_by  = $user_id;
        $service->status      = $request->input('status');

        $service->save();

        // session flashing
        Session::flash('success', 'Service successfully updated!');

        //return to the show page
        return redirect('/admin/service/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find and delete service
        Service::find($id)->delete();

        //flash the message
        Session::flash('success', 'The service was successfully deleted.');

        //return to the index page
        return redirect('/admin/view_services/cancelled');
    }
}