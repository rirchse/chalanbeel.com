<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Notify;
use App\Address;
use App\User;
use Session;
use DB;
use Image;

class UserController extends Controller
{
	public function index()
	{
		return $this->user();
	}
}