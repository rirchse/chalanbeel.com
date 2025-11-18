<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Location;
use App\Package;
use Image;
use Session;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($package_id = null)
    {
        $locations = Location::where('status', 1)->get();
        $package = null;
        
        if ($package_id) {
            $package = Package::find($package_id);
            if ($package) {
                Session::put('selected_package_id', $package_id);
            }
        }
        
        return view('homes.register', compact('locations', 'package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request, array(

            'full_name'     => 'required|min:2|max:32',
            'email'         => 'unique:users|email|max:50|nullable',
            'contact'       => 'required|confirmed|min:11|max:11',
            'area'          => 'max:255',
            'profession'    => 'max:255',
            'join_date'     => 'max:255',
            'details'       => 'max:500',
            'profile_image' => 'image'

        )); 

        if( !empty(User::where('contact', $request->contact)->orderBy('id', 'DESC')->first()) || !empty(User::where('email', $request->email)->orderBy('id', 'DESC')->first()) ) {

        //session flashing
        Session::flash('error', 'You are already registered. Please login to the account using your mobile number as username and password. Otherwise, contact with service provider.');

        //return to the show page
        return redirect('/login');

        } else {
        
            //store in the database
            $user = new User;
            $user->full_name    = $request->full_name;
            $user->contact      = $request->contact;
            $user->email        = $request->email;
            $user->username     = $request->contact;
            $user->password     = bcrypt($request->contact);
            $user->work_at      = $request->work_at;
            $user->profession   = $request->profession;
            $user->join_date    = date('Y-m-d');
            $user->details      = $request->details;
            // $user->mac_address  = $mac;
            $user->location_id  = $request->area;
            $user->created_by   = 0;
            $user->status       = 0;
            
            // Store package ID if selected
            if ($request->package_id) {
                $user->package_id = $request->package_id;
                Session::forget('selected_package_id');
            }

            //save image//
            if($request->hasFile('profile_image')){
                $image = $request->file('profile_image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = ('images/' . $filename);
                Image::make($image)->resize(400, 400)->save($location);

                $user->image = $filename;
            }
            $user->save();

            //session flashing
            Session::flash('success', 'Thank you for Sign up! <br> Please login to your account using your mobile number and password and get full free access of 1Day free package.');

            //return to the show page
            return redirect('/contact/verify');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $register = User::where('remember_token', $token)->first();
        return view('homes.register-details', compact('register'));
    }

    public function sendSMS(Request $request, $token)
    {
        $register = User::where('remember_token', $token)->first();

        if($register){
            $update = User::find($register->id);
            $update->token = rand('999999', '11111');
            $update->save();

            return redirect('/register/'.$token.'/edit');
        }

        Session::flash('error', 'We could not find your accoutn.');
        return redirect('/register/'.$token);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($token)
    {
        $register = User::where('remember_token', $token)->first();
        return view('homes.register-check-token', compact('register'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $token)
    {
        $this->validate($request, [
            'verification_code' => 'required|max:999999|numeric'
            ]);

        $register = User::where('remember_token', $token)->where('token', $request->verification_code)->first();
        if($register) {
            $update = User::find($register->id);
            $update->remember_token = '';
            $update->token = '';
            $update->status = 1;
            $update->save();

            //auto login to the user account
            if(Auth::loginUsingId($register->id)){
                return redirect('/home');
            }

        }

        Session::flash('error', 'We could not find your accoutn.');
        return redirect('/register/create');
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

    public function verify($contact)
    {
        $user = User::where('contact', $contact)->first();
        return view('homes.contact-verify');
        // $update->token = rand(999999, 111111);
        // $update->save();

        // Session::flash('success', 'Contact number successfully verified.');
        // return redirect('/register/verify/confirm');
    }
}
