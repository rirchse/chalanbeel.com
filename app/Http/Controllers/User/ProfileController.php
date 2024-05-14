<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Image;
use Session;
use File;

class ProfileController extends Controller
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
        $id = Auth::user()->id;
        $profile = User::find($id);
        return view('users.profile')->withProfile($profile);
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
        $user_id = Auth::user()->id;

        //validate the data        
        $this->validate($request, array(

            'first_name'    => 'required|min:2|max:32',
            'last_name'     => 'max:32',
            'contact'       => 'required|min:10|max:18',
            'dob'           => 'max:10',
            'job_title'     => 'max:50',
            'profile_image' => 'image'

        ));

        $update = User::find($user_id);
        $exist_image = public_path('images/profile/'.$update->image);
        
        //save the data to the database
        $update->full_name     = $request->input('first_name');
        $update->contact       = $request->input('contact');
        $update->date_of_birth = $request->input('dob');
        $update->profession    = $request->input('job_title');
        $update->updated_by    = $user_id;

        //save image//
        if($request->hasFile('profile_image')){
            $image    = $request->file('profile_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = ('images/profile/' . $filename);
            Image::make($image)->save($location);

            $update->image = $filename;
        }

        $update->save();

        //delete existing image
        if($request->hasFile('profile_image') && File::exists($exist_image)){
            File::delete($exist_image);
        }

        //set flash data with success message
        Session::flash('success', 'Information successfully updated.');

        //redirect with flash data to posts.show
        return redirect('/profile');
    }

    public function changePassword()
    {
        $user_id = Auth::user()->id;
        $user    = User::find($user_id);
        return view('users.change_my_password')->withProfile($user);
    }

    public function updatePassword(Request $request)
    {
        $user_id = Auth::user()->id;
        //validate the data        
        $this->validate($request, array(

            'old_password' => 'required|min:2|max:32',
            'password'     => 'required|min:2|max:32|confirmed'

        ));

        //save the data to the database
        $update = User::find($user_id);
        $update->password     = bcrypt($request->input('password'));
        $update->updated_by   = $user_id;

        $update->save();

        //set flash data with success message
        Session::flash('success', 'Password successfully updated.');

        //redirect with flash data to posts.show
        return redirect('/profile');
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
