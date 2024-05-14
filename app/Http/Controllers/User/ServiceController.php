<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Notify;
use App\Service;
use App\Location;
use App\Package;
use App\User;
use Session;
use DB;
use Image;

class ServiceController extends Controller
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
        $services = Service::leftJoin('packages', 'packages.id', 'services.package_id')
        ->where('user_id', $user->id)
        ->orderBy('services.id', 'DESC')
        ->select('services.*', 'packages.speed', 'packages.time_limit')
        ->get();
        return view('users.view_services')->withServices($services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::where('status', 1)->get();
        return view('users.create_service')->withLocations($locations);
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
            'service'       => 'required|max:255',
            'connection'    => 'required|max:255',
            'speed'         => 'required|max:255',
            'time_limit'    => 'required|max:255',
            'area'          => 'required|max:255',
            'discount'      => 'max:255',
            'mac'           => 'max:255',
            'device'        => 'max:255',
            'ip'            => 'max:255',
            'left_long'     => 'max:255',
            'status'        => 'max:255',
            'detail'        => 'max:1000'
        ));

        $package = Package::where('service', $request->service)->where('connection', $request->connection)->where('speed', $request->speed)->where('time_limit', $request->time_limit)->first();

        //store in the database
        $service = new Service;
        $service->package_id  = $package->id;
        $service->location_id = $request->area;
        $service->user_id     = $user->id;
        $service->password    = $user->contact;
        $service->device_mode = $request->device;
        $service->ip          = $request->ip;
        $service->mac         = $request->mac;
        $service->left_long   = $request->left_long;
        $service->discount    = $request->discount;
        $service->details     = $request->detail;
        $service->created_by  = 0;
        $service->status      = 0;

        $service->save();
        
        $new_service = Service::where('user_id', $user->id)->where('package_id', $package->id)->orderBy('id', 'DESC')->first();

        // session flashing
        Session::flash('success', 'New service successfully created!');

        //return to the show page
        return redirect('/'.$new_service->id.'/payment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = ActiveService::leftJoin('services', function($join) {
            $join->on('services.id', 'active_services.service_id');            
        })
        ->leftJoin('users', function ($join) {
            $join->on('users.id', 'active_services.user_id');
        })
        ->leftJoin('payment_receives', function ($join) {
            $join->on('payment_receives.id', 'active_services.payment_id');
        })
        ->leftJoin('payment_methods', function ($join) {
            $join->on('payment_methods.id', 'payment_receives.payment_method');
        })
        ->leftJoin('locations', function ($join) {
            $join->on('locations.id', 'active_services.location_id');
        })
        ->leftJoin('status', function ($join) {
            $join->on('status.value', 'active_services.status');
        })
        ->select('active_services.*',
            'services.package',
            'services.service_type',
            'services.time_limit',
            'services.price',
            'services.discount',
            'services.category',
            'users.first_name',
            'users.last_name',
            'users.username',
            'users.contact',
            'users.image',
            'payment_receives.receive_amount',
            'payment_receives.account_number',
            'payment_receives.transaction_id',
            'payment_methods.payment_system',
            'locations.station',
            'locations.village',
            'status.name',
            'status.value',
            'status.icon',
            'status.color',
            'status.image'
            )
        ->where('active_services.id', $id)
        ->first();
        return view('users.active_service_details')->withService($service);
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