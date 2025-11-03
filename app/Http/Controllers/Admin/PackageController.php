<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Router;
use Auth;
use App\Service;
use App\Package;
use App\Device;
use App\Notify;
use App\User;
use Session;
use DB;
use Image;
use Mail;

class PackageController extends Controller
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
    public function routerpackage()
    {
        $user_id = Auth::guard('admin')->user()->id;
        $packages = Router::Connect()->setMenu('/ppp profile')->getAll();
        foreach($packages as $package){
            if(count(Package::where('speed', $package('name'))->where('service_mode', 'pppoe')->first()) < 1){
                // dd($package('name'));
                $package = new Package;
                $package->service        =   'Internet';
                $package->connection     =   'cable';
                $package->speed          =   '10MB';
                $package->time_limit     =   '30Days';
                $package->price          =   '1000';
                $package->discount       =   0;
                $package->details        =   '';
                $package->status         =   1;
                $package->created_by     =   $user_id;

                $package->save();
            }
        }
        Session::flash('success', 'Packages successfully created to the system.');
        return redirect('/admin/view_packages');
    }
    public function index()
    {
        $packages = Package::orderBy('id', 'DESC')->get();
        return view('admins.packages.view_packages')->withPackages($packages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        return view('admins.packages.create_package');
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

            'service'     => 'nullable|max:255',
            'connection'  => 'nullable|max:255',
            'speed'       => 'required|max:255',
            'time_limit'  => 'required|max:255',
            'price'       => 'required|min:1|max:255',
            'discount'    => 'max:3',
            'status'      => 'nullable',
            'details'     => 'max:255'
        ));

        $data = $request->all();

        if(isset($data['_token']))
        {
          unset($data['_token']);
        }

        if(isset($data['_method']))
        {
          unset($data['_method']);
        }

        //store in the database
        try{
          $package = Package::updateOrCreate([
            'speed' => $data['speed']
          ],
          $data);

        //session flashing
        Session::flash('success', 'New package successfully created!');

        //return to the show page
        return redirect()->route('package.show', $package->id);
        }
        catch(\Exception $e)
        {
          return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::find($id);

        return view('admins.packages.read_package')->withPackage($package);
    }


    public function activate(Request $request, $id)
    {
        $service = ActiveService::find($id);
        $duration = Duration::find($service->duration_id)->duration;
        
        //active the service
        if($service->status != 0){
            Session::flash('error', 'The service already activated.');
            return redirect('/admin/active_service_details/'.$id);
        }else{
            $active = ActiveService::find($id);
            $active->start_at = date('Y-m-d h:i:s');
            $active->end_at = date('Y-m-d h:i:s', strtotime("+".$duration." day"));
            $active->status   = 1;
            $active->save();        

            //set flash data with success message
            Session::flash('success', 'New service activated.');

            //redirect with flash data to posts.show
            return redirect('/admin/active_service_details/'.$id);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        return view('admins.packages.edit_package')->withPackage($package);
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
            'service'     => 'nullable|max:255',
            'service_mode'=> 'nullable|max:255',
            'server'      => 'max:255',
            'connection'  => 'nullable|max:255',
            'speed'       => 'required|max:255',
            'time_limit'  => 'required|max:255',
            'price'       => 'required|min:1|max:255',
            'discount'    => 'max:100',
            'status'      => 'nullable',
            'details'     => 'max:255',
            ));

        //save the data to the database
        $package = Package::find($id);
        $package->service        =   $request->input('service');
        $package->service_mode   =   $request->input('service_mode');
        $package->server         =   $request->input('server');
        $package->connection     =   $request->input('connection');
        $package->speed          =   $request->input('speed');
        $package->time_limit     =   $request->input('time_limit');
        $package->price          =   $request->input('price');
        $package->discount       =   $request->input('discount');
        $package->details        =   $request->input('details');
        $package->status         =   $request->input('status');
        $package->updated_by     =   $user_id;

        $package->save();

        //set flash data with success message
        Session::flash('success', 'The package was successfully updated.');

        //redirect with flash data to posts.show
        //return redirect('/admin/edit_service/'.$id.'/edit');
        return redirect('/admin/package/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find the container
        Package::find($id)->delete();

        //flash the message
        Session::flash('success', 'The package was successfully deleted.');

        //return to the index page
        return redirect()->route('package.index');
    }
}