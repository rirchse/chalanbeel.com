<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Admin;
use Auth;
use Image;
use Session;

class AdminsController extends Controller
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
    public function profile()
    {
        $user_id = Auth::guard('admin')->user()->id;
        $user = User::find($user_id);
        return view('admins.profile')->withUser($user);
    }

    public function changePassword()
    {
        $user_id = Auth::guard('admin')->user()->id;
        $user = Admin::find($user_id);
        return view('admins.change_my_password')->withProfile($user);
    }

    public function updatePassword(Request $request)
    {
        $user_id = Auth::guard('admin')->user()->id;
        //validate the data        
        $this->validate($request, array(

            'old_password' => 'required|min:2|max:32',
            'password'     => 'required|min:2|max:32|confirmed'

        ));

        //save the data to the database
        $update = Admin::find($user_id);
        $update->password     = bcrypt($request->input('password'));
        $update->updated_by   = $user_id;

        $update->save();

        //set flash data with success message
        Session::flash('success', 'Password successfully updated.');

        //redirect with flash data to posts.show
        return redirect('/admin/profile');
    }


    public function index()
    {
        $user_id = Auth::guard('admin')->user()->id;
        // Get all users from database
        $users = Admin::orderBy('id', 'DESC')->where('id', '!=', $user_id)->get();
        return view('admins.view_all_admins')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create_new_admin');
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

            'first_name'    => 'required|min:2|max:32',
            'last_name'     => 'required|min:2|max:32',
            'email'         => 'required|unique:users|email|max:50',
            'password'      => 'required|min:8|max:32',
            'contact'       => 'max:18',
            'dob'           => 'max:10',
            'job_title'     => 'max:32',
            'profile_image' => 'image'

        ));

        //store in the database
        $createAdmin = new Admin;
        $createAdmin->first_name   = $request->first_name;
        $createAdmin->last_name    = $request->last_name;
        $createAdmin->email        = $request->email;
        $createAdmin->password     = bcrypt($request->password);
        $createAdmin->contact      = $request->contact;
        $createAdmin->dob          = $request->dob;
        $createAdmin->job_title    = $request->job_title;
        $createAdmin->created_by   = $user_id;

        //save image//
        if($request->hasFile('profile_image')){
            $image    = $request->file('profile_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = ('images/profile/' . $filename);
            Image::make($image)->resize(600, 600)->save($location);

            $createAdmin->image = $filename;
        }
        $createAdmin->save();

        //session flashing
        Session::flash('success', 'New Admin successfully created!');

        //return to the show page
        return redirect('/admin/create_new_admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Grab user data by id
        $user = User::find($id);
        return view('admins.user_profile')->withProfile($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Admin::find($id);
        return view('admins.edit_admin')->withUser($user);
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
        //validate the data        
        $this->validate($request, array(

            'first_name'    => 'required|min:2|max:32',
            'last_name'     => 'required|min:2|max:32',
            'contact'       => 'max:18',
            'dob'           => 'max:10',
            'job_title'     => 'max:32',
            'profile_image' => 'image'

        ));

        //save the data to the database
        $update = Admin::find($id);
        $update->first_name   = $request->input('first_name');
        $update->last_name    = $request->input('last_name');
        $update->contact      = $request->input('contact');
        $update->dob          = $request->input('dob');
        $update->job_title    = $request->input('job_title');
        $update->updated_by   = $user_id;

        //save image//
        if($request->hasFile('profile_image')){
            $image    = $request->file('profile_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = ('images/profile/' . $filename);
            Image::make($image)->resize(600, 600)->save($location);

            $update->image = $filename;
        }

        $update->save();

        //set flash data with success message
        Session::flash('success', 'User Information successfully updated.');

        //redirect with flash data to posts.show
        return redirect('/admin/admin/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();

        Session::flash('success', 'The successfully deleted!');

        return redirect('/admin/show_admins');
    }

    public function editpassword($id)
    {
        $admin = Admin::find($id);
        return view('admins.edit_admin_password')->withAdmin($admin);
    }

    public function updatePass(Request $request)
    {
        $user_id = Auth::guard('admin')->user()->id;
        //validate the data        
        $this->validate($request, array(
            'user_id'  => 'required',
            'password' => 'required|min:8|max:32|confirmed'
        ));

        //save the data to the database
        $update = Admin::find($request->user_id);
        $update->password     = bcrypt($request->input('password'));
        $update->updated_by   = $user_id;
        $update->save();

        //set flash data with success message
        Session::flash('success', 'Password successfully updated.');

        //redirect with flash data to posts.show
        return redirect('/admin/password/'.$request->user_id.'/edit');
    }
}