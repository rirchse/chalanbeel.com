<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Notify;
use App\Address;
use App\Service;
use App\ActiveService;
use App\ServiceCat;
use App\Location;
use App\Payment;
use App\User;
use Session;
use DB;
use Image;

class AdminHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function graph(){
        return view('admins.graph_from_beginning');
    }


    public function index()
    {
      $intuser = [
        'total' => 0,
        'static' => 0,
        'active' => 0,
        'expire' => 0,
        'cancel' => 0,
      ];

      $invest = [
        'total' => 0
      ];

      $bill = [
        'thismonth' => 0,
        'prevmonth' => 0,
      ];

      $users = User::where('service_type', 'Static')->get();
      $intuser['total'] = $users->count();
      foreach($users as $user)
      {
        if($user->status == 'Active')
        {
          $intuser['active'] ++;
        }
        elseif($user->status == 'Expire')
        {
          $intuser['expire'] ++;
        }
        elseif($user->status == 'Cancel')
        {
          $intuser['cancel'] ++;
        }
      }
      
      $bills = Payment::orderBy('id', 'DESC');
      $bill['thismonth'] = $bills->where('receive_date', 'like', '%'.date('Y-m').'%')->sum('receive');
      $bill['prevmonth'] = Payment::where('receive_date', 'like', '%'.date('Y-m', strtotime('- 1 month')).'%')->sum('receive');
      // dd($prevmonth);

      
      return view('admins.index', compact('intuser', 'bill', 'invest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $pick, $deli)
    {
        //
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
        //
    }

    public function delete($id)
    {
        //
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