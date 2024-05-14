<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Payment;
use App\Location;
use App\Device;
use App\Notify;
use App\User;
use Session;
use DB;
use Image;
use File;

class DeviceController extends Controller
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
        $devices = Device::leftJoin('locations', 'devices.location_id', 'locations.id')->orderBy('devices.ip', 'ASC')->select('devices.*', 'locations.station')->get();
        return view('admins.devices.view_devices')->withDevices($devices);
    }

    public function childs($id)
    {
        $devices = Device::leftJoin('locations', 'locations.id', 'devices.location_id')
        ->orderBy('devices.ip', 'ASC')->where('parent_id', $id)->select('devices.*', 'locations.station')->get();
        $parent = Device::find($id);
        return view('admins.devices.view_device_childs', compact('devices', 'parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Location::orderBy('id', 'DESC')->get();
        $devices = Device::orderBy('id', 'DESC')->whereIn('wireless_mode', ['AccessPoint','Repeater'])->get();
        return view('admins.devices.create_new_device', compact('devices', 'areas'));
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
            'ip'             => 'required|max:255',
            'mac'            => 'required|max:255',
            'device_name'    => 'required|max:255',
            'model'          => 'required|max:255',
            'parent'         => '',
            'location'       => 'max:255',
            'username'       => 'max:255',
            'password'       => 'max:255',
            'brand'          => 'max:255',
            'wireless_mode'  => 'max:255',
            'ssid'           => 'max:255',
            'security'       => 'max:255',
            'frequency'      => 'max:255',
            'detail'         => 'max:500',
            'config_file'    => 'file|max:2000',
            'image'          => 'image|max:2000'
        ));

        if(count(Device::where('ip', $request->ip)->where('mac', $request->mac)->get()) > 0){

            Session::flash('error', 'This device alread exist or duplicate IP, MAC assining to the system.');
            return redirect('/admin/device/create');
        }

        //store in the database
        $device = new Device;
        $device->parent_id        = $request->parent;
        $device->ip               = $request->ip;
        $device->subnet_mask      = '';
        $device->username         = $request->username;
        $device->password         = $request->password;
        $device->mac              = $request->mac;
        $device->device_name      = $request->device_name;
        $device->latitude         = '';
        $device->longitude        = '';
        $device->on_location      = '';
        $device->direction        = '';
        $device->location_for     = '';
        $device->wireless_mode    = $request->wireless_mode;
        $device->device_mode      = '';
        $device->ssid             = $request->ssid;
        $device->security         = $request->security;
        $device->device_type      = '';
        $device->brand            = $request->brand;
        $device->model_no         = $request->model;
        $device->serial_no        = '';
        $device->hw_version       = '';
        $device->channel          = '';
        $device->frequency        = $request->frequency;
        $device->channel_width    = '';
        $device->frequency_brand  = '';
        $device->tx_power         = '';
        $device->antenna_gain     = '';
        // $device->install_date     = '';
        $device->input_voltage    = '';
        $device->input_current    = '';
        $device->location_id      = $request->location;
        // $device->buy_date         = '';
        $device->buy_from         = '';
        $device->warranty         = '';
        $device->details          = $request->detail;
        $device->created_by       = $user_id;
        $device->status           = 1;

        /* config file upload */
        if($request->hasFile('config_file')){
            $config = $request->file('config_file');
            $filename = date('Ymd-His') . '.' . $config->getClientOriginalExtension();
            $location = ('uploads/configs/');
            $config->move($location, $filename);

            $device->config_file = $filename;
        }

        /* image upload */
        if($request->hasFile('image')){
            $config = $request->file('image');
            $filename = $request->device_name.date('Ymd-His') . '.' . $config->getClientOriginalExtension();
            $location = ('uploads/device_images/');
            $config->move($location, $filename);

            $device->image = $filename;
        }

        $device->save();

        $last_entry = Device::orderBy('id', 'DESC')->first()->id;

        //session flashing
        Session::flash('success', 'New device successfully created!');
        
        //return to the show page
        return redirect('/admin/device/'.$last_entry);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = Auth::guard('admin')->user()->id;
        $device = Device::leftJoin('admins', 'admins.id', 'devices.created_by')->select('devices.*', 'admins.first_name', 'admins.last_name')->find($id);
        return view('admins.devices.read_device')->withDevice($device);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device = Device::find($id);
        $areas = Location::all();
        $devices = Device::orderBy('id', 'DESC')->whereIn('wireless_mode', ['AccessPoint','Repeater'])->get();
        return view('admins.devices.edit_device', compact('devices', 'device', 'areas'));
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
            'location'       => 'required|max:255',
            'parent'         => '',
            'mac'            => 'max:255',
            'ip'             => 'required|max:255',
            'username'       => 'required|max:255',
            'password'       => 'required|max:255',
            'device_name'    => 'required|max:255',
            'model'          => 'required|max:255',
            'brand'          => 'required|max:255',
            'wireless_mode'  => 'max:255',
            'ssid'           => 'max:255',
            'security'       => 'max:255',
            'frequency'      => 'max:255',
            'detail'         => 'max:500',
            'config_file'    => 'file|max:2000',
            'image'          => 'image|max:2000'
            ));

        //find exist device
        $exist_device = Device::find($id);

        //save the data to the database
        $device = Device::find($id);
        $device->ip               = $request->ip;
        $device->parent_id        = $request->parent;
        $device->subnet_mask      = '';
        $device->username         = $request->username;
        $device->password         = $request->password;
        $device->mac              = $request->mac;
        $device->device_name      = $request->device_name;
        $device->latitude         = '';
        $device->longitude        = '';
        $device->on_location      = '';
        $device->direction        = '';
        $device->location_for     = '';
        $device->wireless_mode    = $request->wireless_mode;
        $device->device_mode      = '';
        $device->ssid             = $request->ssid;
        $device->security         = $request->security;
        $device->device_type      = '';
        $device->brand            = $request->brand;
        $device->model_no         = $request->model;
        $device->serial_no        = '';
        $device->hw_version       = '';
        $device->channel          = '';
        $device->frequency        = $request->frequency;
        $device->channel_width    = '';
        $device->frequency_brand  = '';
        $device->tx_power         = '';
        $device->antenna_gain     = '';
        // $device->install_date     = '';
        $device->input_voltage    = '';
        $device->input_current    = '';
        $device->location_id      = $request->location;
        // $device->buy_date         = '';
        $device->buy_from         = '';
        $device->warranty         = '';
        $device->details          = $request->detail;
        $device->updated_by       = $user_id;
        $device->status           = 1;

        if($request->hasFile('config_file')){
            $config = $request->file('config_file');
            $filename = date('Ymd-His') . '.' . $config->getClientOriginalExtension();
            $location = ('uploads/configs/');
            $config->move($location, $filename);

            $device->config_file = $filename;
        }

        /* image upload */
        if($request->hasFile('image')){
            $config = $request->file('image');
            $filename = $request->device_name.date('Ymd-His') . '.' . $config->getClientOriginalExtension();
            $location = ('uploads/device_images/');
            $config->move($location, $filename);

            $device->image = $filename;
        }

        $device->save();

        //delete exists image
        // if($request->hasFile('image')){
        //     $ex_img = 'uploads/device_images/'.$exist_device->image;
        //     if(File::exists($ex_img)){
        //         File::delete($ex_img);
        //     }
        // }

        //set flash data with success message
        Session::flash('success', 'The device successfully updated.');

        //redirect with flash data to posts.show
        return redirect('/admin/device/'.$id.'/edit');
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
