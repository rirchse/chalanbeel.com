<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserLoginController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest', ['except' => ['logout']]);
	}
    
    public function getLogin () 
    {
    	return view('homes.login');
    }

    public function login(Request $request) 
    {
    	
    	// validate the form data
    	$this->validate($request, [
    		'email' => 'required|max:50',
    		'password' => 'required|min:8'
    		]);

    	// attempt to the log the user in
    	if (Auth::attempt(['contact' => $request->email, 'password' => $request->password], $request->remember)) {
    		// if successful, then redirect to their intended location
        return redirect()->intended('/home');
    	}

    	// if unsuccessful, then redirect back to the login with form data
    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard()->logout();
        return redirect('/');
    }
}
