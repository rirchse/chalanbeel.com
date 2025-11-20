<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\User;
use App\Admin;

class UnifiedLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }
    
    public function showLoginForm() 
    {
        return view('homes.login');
    }

    public function login(Request $request) 
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required|min:6'
        ]);

        $emailOrPhone = $request->email;
        $password = $request->password;
        $remember = $request->remember ?? false;

        // First, try to authenticate as Admin (using email)
        if (Auth::guard('admin')->attempt(['email' => $emailOrPhone, 'password' => $password], $remember)) {
            // Admin login successful
            return redirect()->intended(route('admin.dashboard'));
        }

        // If admin login fails, try to authenticate as User (using contact/phone)
        if (Auth::attempt(['contact' => $emailOrPhone, 'password' => $password], $remember)) {
            // User login successful
            return redirect()->intended('/home');
        }

        // If both fail, show error
        Session::flash('error', __('messages.login.error'));
        
        // Redirect back to login with form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        // Logout from both guards
        Auth::guard('admin')->logout();
        Auth::guard()->logout();
        
        return redirect('/');
    }
}

