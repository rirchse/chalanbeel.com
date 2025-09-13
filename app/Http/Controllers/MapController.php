<?php
namespace App\Http\Controllers;

use App\Users;

class MapController extends Controller
{
    public function index()
    {
        // get all customers with lat/lng
        $customers = Users::whereNotNull('lat')->whereNotNull('lng')->get();
        // dd($customers);

        return view('map.index', compact('customers'));
    }
}
