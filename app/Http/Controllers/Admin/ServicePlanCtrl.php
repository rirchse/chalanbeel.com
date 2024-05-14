<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Service;
use App\ServicePlan;
use Session;

class ServicePlanCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create($id)
    {
    	$service = Service::find($id);
    	return view('admins.service_plans.create_service_plan', compact('service'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'service_id'     => 'required',
    		'amount'         => 'required',
    		'billing_date'   => 'required',
    		'closed_at'      => '',
    		'billing_status' => 'required'
    		]);

    	$plan = ServicePlan::find($request->service_id);
    	if($plan && $plan->billing_date == date('Y-m-d', strtotime($request->billing_date))){
    		Session::flash('error', 'This Service Plan already created.');
    		return redirect('/admin/service/'. $request->service_id);
    	}

    	$store = New ServicePlan;
    	$store->service_id     = $request->service_id;
    	$store->amount         = $request->amount;
    	$store->billing_date   = $request->billing_date;
    	$store->closed_at      = $request->closed_at;
    	$store->billing_status = $request->billing_status;
    	$store->save();

    	Session::flash('success', 'New Service Plan successfully created.');
    	return redirect('/admin/service/'. $request->service_id);
    }

    public function edit($id)
    {
    	$plan = ServicePlan::find($id);
    	$service = Service::find($plan->service_id);
    	return view('admins.service_plans.edit_service_plan', compact('plan', 'service'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
    		'service_id'     => 'required',
    		'amount'         => 'required',
    		'billing_date'   => 'required',
    		'closed_at'      => '',
    		'billing_status' => 'required'
    		]);

    	$store = ServicePlan::find($id);
    	$store->service_id     = $request->input('service_id');
    	$store->amount         = $request->input('amount');
    	$store->billing_date   = $request->input('billing_date');
    	$store->closed_at      = $request->input('closed_at');
    	$store->billing_status = $request->input('billing_status');
    	$store->save();

    	Session::flash('success', 'The Service Plan successfully updated.');
    	return redirect('/admin/service/'. $request->service_id);
    }

    public function delete($id)
    {
    	$plan = ServicePlan::find($id);
    	$plan->delete();
    	Session::flash('success', 'The Service Plan successfully deleted.');
    	return redirect('/admin/service/'. $plan->service_id);
    }

    //temporary method
    public function createExisting()
    {
    	$count = 0;
    	$services = Service::where('status', 1)->get();
    	foreach($services as $service){
    		$plans = ServicePlan::where('service_id', $service->id)->get();
    		
    		if(count($plans) <= 0){

    			$store = New ServicePlan;
		    	$store->service_id     = $service->id;
		    	$store->amount         = $service->amount;
		    	$store->billing_date   = $service->billing_date;
		    	// $store->closed_at      = $service->closed_at;
		    	$store->billing_status = 'Open';
		    	$store->save();

		    	$count++;

    		}
    	}
    	return 'Service Plans successfully created. Total='.$count;
    }
}