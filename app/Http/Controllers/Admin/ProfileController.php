<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SourceCtrl;
use App\User;
use App\Admin;
use Auth;
use Image;
use Session;

class ProfileController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::guard('admin')->user();
        $profile = $user;
        return view('admins.profile')->withProfile($profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$profile = Auth::user();
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $source = new SourceCtrl;
        $user_id = Auth::guard('admin')->user()->id;
        //validate the data        
        $this->validate($request, array(
            'first_name'    => 'required|min:2|max:32',
            'last_name'     => 'required|min:2|max:32',
            'contact'       => 'max:18',
            'dob'           => 'max:10',
            'job_title'     => 'max:50',
            'profile_image' => 'image'

        ));

        //save the data to the database
        $update = Admin::find($user_id);
        $update->first_name   = $request->input('first_name');
        $update->last_name    = $request->input('last_name');
        $update->contact      = $request->input('contact');
        $update->dob          = $request->input('dob');
        $update->job_title    = $request->input('job_title');
        $update->updated_by   = $user_id;

        //save image//
        if($request->hasFile('profile_image'))
        {
          $update->image = $source->fileUpload($request->file('profile_image'), 'profile/');
            // $image = $request->file('profile_image');
            // $filename = time() . '.' . $image->getClientOriginalExtension();
            // $location = (public_path().'/images/profile/' . $filename);
            // Image::make($image)->resize(600, 600)->save($location);

            // $update->image = $location;
        }

        $update->save();

        //set flash data with success message
        Session::flash('success', 'Information successfully updated.');

        //redirect with flash data to posts.show
        return redirect('/admin/profile');
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