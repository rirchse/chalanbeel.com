<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function graph()
    {
      return view('admins.graph_from_beginning');
    }

    public function index(Request $request)
    {
      $this->validate($request, [
        'service_type' => 'nullable'
      ]);

      $serviceType = $request->service_type;

      $intuser = [
        'total' => 0,
        'static' => 0,
        'active' => 0,
        'expire' => 0,
        'cancel' => 0,
        'today_expire' => 0,
      ];

      $invest = [
        'total' => 0
      ];

      $bill = [
        'thismonth' => 0,
        'prevmonth' => 0,
      ];

      $users = User::query()
      ->when($serviceType, function($query, $serviceType)
      {
        $query->where('service_type', $serviceType);
      })
      ->get();

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

        if($user->payment_date == date('Y-m-d'))
        {
          $intuser['today_expire'] ++;
        }
      }
      
      $bills = Payment::orderBy('id', 'DESC');
      $bill['thismonth'] = $bills->where('receive_date', 'like', '%'.date('Y-m').'%')->sum('receive');
      $bill['prevmonth'] = Payment::where('receive_date', 'like', '%'.date('Y-m', strtotime('- 1 month')).'%')->sum('receive');


      $monthlyPayments = Payment::leftJoin('invests', function($join)
      {
        $join->on(DB::raw("DATE_FORMAT(payments.receive_date, '%Y-%m')"), '=', DB::raw("DATE_FORMAT(invests.date, '%Y-%m')"));
      })
      ->select(
        DB::raw("DATE_FORMAT(payments.receive_date, '%Y-%m') as month_year"),
        DB::raw("SUM(payments.receive) as sale"),
        DB::raw("SUM(invests.amount) as cost")
      )
      ->whereYear('receive_date', Carbon::now()->year)
      ->groupBy('month_year')
      ->orderBy('month_year', 'desc')
      ->get();

      // dd($monthlyPayments);

      $sales = $cost = $dates = $saleStr = $costStr = '';
      $max = $min = 0;
      $salesArr = $costsArr = [];

      foreach ($monthlyPayments as $value)
      {
        // For the standard approach:
        $dates .= "'".$value->month_year."',"; 
        $sales .= "'".($value->sale ?? 0)."',";
        $cost .= "'".($value->cost ?? 0)."',";

        $saleStr .= '<td>'.$value->sale.'</td>';
        $costStr .= '<td>'.$value->cost.'</td>';

        //
        array_push($salesArr, $value->sale);
        array_push($costsArr, $value->cost);
      }

      $max = max(array_merge($salesArr, $costsArr));
      $min = min(array_merge($salesArr, $costsArr));

      $salesCostGraph = [
        'sales' => $sales,
        'cost' => $cost,
        'dates' => $dates,
        'max' => $max,
        'min' => $min,
        'salestr' => $saleStr,
        'coststr' => $costStr,
      ];

      // dd( $salesCostGraph ) ;
      
      return view('admins.index', compact('intuser', 'bill', 'invest', 'salesCostGraph', 'serviceType'));
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