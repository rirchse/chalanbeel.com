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

class LocationController extends Controller
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
        $areas = Location::orderBy('id', 'DESC')->get();
        return view('admins.locations.view_areas')->withAreas($areas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.locations.create_new_area');
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

            'station'        => 'required|max:255',
            'area'           => 'max:255',
            'village'        => 'required|max:255',
            'address'        => 'required|max:255',
            'city'           => 'max:255',
            'state'          => 'max:255',
            'zip'            => 'max:255',
            'contact'        => 'max:255',
            'detail'         => 'max:500'

        ));

        //store in the database
        $area = new Location;
        $area->station        = $request->station;
        $area->area           = $request->area;
        $area->village        = $request->village;
        $area->address        = $request->address;
        $area->city           = $request->city;
        $area->state          = $request->state;
        $area->zip            = $request->zip;
        $area->contact        = $request->contact;
        $area->details        = $request->detail;
        $area->created_by     = $user_id;
        $area->status         = 1;

        $area->save();

        //session flashing
        Session::flash('success', 'New location area successfully created!');
        
        //return to the show page
        return redirect('/admin/location/create');
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
      $pop = Location::find($id);
      return view('admins.locations.edit', compact('pop'));
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
