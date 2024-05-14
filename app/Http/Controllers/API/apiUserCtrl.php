<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Notify;
use App\Address;
use App\User;
use Session;
use DB;
use Image;

class apiUserCtrl extends Controller
{
	public function index()
	{
		return User::where('status', 1)->get();
	}
}