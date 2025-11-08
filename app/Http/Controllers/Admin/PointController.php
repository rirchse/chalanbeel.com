<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SourceCtrl;
use Auth;
use App\Payment;
use App\Point;
use App\Notify;
use App\User;
use Session;
use DB;
use Image;
use File;

class PointController extends Controller
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
      $points = Point::orderBy('created_at', 'DESC')->get();
      return view('admins.points.index', compact('points'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admins.points.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $source = new SourceCtrl;
        $user_id = Auth::guard('admin')->user()->id;
        //validate the data
        $this->validate($request, array(
            'address'    => 'required|max:255',
            'lat_lon'    => 'nullable|max:255',
            'details'    => 'required|max:500',
            'image'      => 'image|mimes:jpg,jpeg,png|max:5000'
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

        if(isset($request->lat_lon))
        {
          $arr = explode(',', str_replace(' ', '', $request->lat_lon));

          $data['lat'] = $arr[0];
          $data['lng'] = $arr[1];
        }

        $data['created_by'] = auth()->id();

        if($request->hasFile('image'))
        {
          $data['image'] = $source->fileUpload($data['image'], 'points/');
        }

        try {
          $point = Point::create($data);
          
          //session flashing
          Session::flash('success', 'New point successfully created!');
          
          //return to the show page
          return redirect()->route('point.show', $point->id);
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
        $point = Point::find($id);
        return view('admins.points.read', compact('point'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $point = Point::find($id);
        return view('admins.points.edit', compact('point'));
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
      $source = new SourceCtrl;
      $user_id = Auth::guard('admin')->user()->id;
      //validate the data
      $this->validate($request, array(
          'address'    => 'required|max:255',
          'lat_lon'    => 'nullable|max:255',
          'details'    => 'required|max:500',
          'image'      => 'image|mimes:jpg,jpeg,png|max:5000'
      ));

      $point = Point::find($id);
      $ximage = public_path($point->image);

      $data = $request->all();

      if(isset($data['_token']))
      {
        unset($data['_token']);
      }

      if(isset($data['_method']))
      {
        unset($data['_method']);
      }

      if(isset($request->lat_lon))
      {
        $arr = explode(',', str_replace(' ', '', $request->lat_lon));

        $data['lat'] = $arr[0];
        $data['lng'] = $arr[1];
      }

      $data['updated_by'] = auth()->id();

      if($request->hasFile('image'))
      {
        $data['image'] = $source->fileUpload($data['image'], 'points/');
      }

      try {
        $point = Point::where('id', $id)->update($data);

        if($request->hasFile('image') && File::exists($ximage))
        {
          File::delete($ximage);
        }
        
        //session flashing
        Session::flash('success', 'New point successfully updated!');
        
        //return to the show page
        return redirect()->route('point.show', $id);
      }
      catch(\Exception $e)
      {
        return $e->getMessage();
      }
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

    public function onMap()
    {
      $points = Point::where('status', 'Active')->get();
      return view('admins.points.view-on-map', compact('points'));
    }
}
