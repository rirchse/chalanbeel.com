@extends('admin')
@section('title', 'Service Details')
@section('content')
	
<div class="row">
		<div class="col-md-7">
			<div class="card">
				<div class="card-header card-header-icon" data-background-color="rose">
					<i class="material-icons">assignment</i>
				</div>
				<div class="card-content" style="">
					<div class="col-md-5">
						<h4 class="card-title">Service Details</h4>
					</div>
					<div class="col-sm-12">
						<div class="action-tools" style="text-align:right; margin-bottom:10px">
							{!! Form::open(['route' => 'anual_report.print', 'method' => 'POST', 'class' => 'pull-left']) !!}
							<input type="hidden" name="service_id" value="{{$service->id}}">
							<select class="" name="year">
								<?php
								$a = 0;
								$billing_year = date('Y', strtotime($service->billing_date));
								for($x = date('Y'); $x >= $billing_year; $x-- ){
								?>
								<option>{{date('Y', strtotime('-'.$a.' Year'))}}</option>
								<?php
								$a++;
								if($a >= 5){
									break;
								}
								}
								?>
							</select>
							{{-- <button>{{$billing_year}}</button> --}}
							<input type="submit" value="print" class="text-info">
							{{-- <button type="submit" class=" btn btn-info btn-simple btn-inline text-info"><i class="material-icons">print</i></button> --}}
							{!! Form::close() !!}
							{{-- <a  title="Print Anual Report" href="/admin/service/{{$service->id}}/anual/print" target="_blank"></a> --}}
							<a class="text-success" title="View Active Services" href="/admin/service/active/view"><i class="material-icons">assignment</i></a>
							<a class="text-primary" title="View All Services" href="/admin/service/all/view"><i class="material-icons">assignment</i></a>
							<a class="text-warning" title="Edit" href="/admin/service/{{$service->id}}/edit"><i class="material-icons">edit</i></a>

							<a class="text-info" title="View Bills" href="/admin/payment/{{$service->id}}/total_paid"><i class="material-icons">subject</i></a>
							<a class="btn-simple btn-icon text-warning" title="View Due Bills" href="/admin/payment/{{$service->id}}/total_due"><i class="material-icons">subject</i></a>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="card-content">
								<div class="table-responsive table-space">
									<table class="table">
											<tbody>
												<tr>
													<th width=100>Service Type:</th>
													<th>{{ $service->service }}</th>
												</tr>
												<tr>
													<td>Speed</td>
													<td>{{ $service->speed }}bps</td>
												</tr>
												<tr>
													<td>Time Limit</td>
													<td>{{ $service->time_limit }}</td>
												</tr>
												<tr>
													<th>Service Plans: <a class="label label-info" title="Add New Plan" href="/admin/service_plan/create/{{$service->id}}"><i class="material-icons">add</i></a></th>
													<td>
														@foreach( App\ServicePlan::where('service_id', $service->id)->get() as $plan)
														{!!'<b>'.$plan->amount.' Tk.</b> : '.$plan->billing_date.' - '.$plan->closed_at. '<a href="/admin/service_plan/'.$plan->id.'/edit"> <span class="material-icons text-warning">edit</span></a>
														<a href="/admin/service_plan/'.$plan->id.'/delete" onclick="return confirm(\'Are you sure you want to delete?\')" title="Delete"><b class="text-danger btn-simple">  <span class="material-icons text-danger">delete</span> </b></a>' !!}<br>
														@endforeach
													</td>
												</tr>
												<tr>
													<td>Closed At</td>
													<td>{{ $service->end_at }}</td>
												</tr>
												<tr>
													<td>Billing Date</td>
													<td>{{$service->billing_date}}</td>
												</tr>
												<tr>
													<td>Billing Plan</td>
													<th>{{$service->billing_plan}}</th>
												</tr>
												<tr>
													<td>Time Left</td>
													<td>{{ $service->end_at }}</td>
												</tr>
												<tr>
													<td>Price</td>
													<th>{{ $service->amount }}</th>
												</tr>
												<tr>
													<td>Service</td>
													<td>{{ $service->service_mode }}</td>
												</tr>
												<tr>
													<td>Status</td>
													<td>
														@if($service->status == 1)
														<label class="label label-success">Active</label>
														@else
														<label class="label label-success">Inactive</label>
														@endif
													</td>
												</tr>
												<tr>
													<th>Customer/Organization:</th>
													<td>{{ $service->full_name }}</td>
												</tr>
												<tr>
													<td>Contact</td>
													<td>{{$service->contact}}</td>
												</tr>
												<tr>
													<td>Device Information:</td>
													<td>{{ $service->device_id }}</td>
												</tr>
												<tr>
													<td>Payments?</td>
													<td>{{ count(DB::table('payments')->where('service_id', $service->id)->get()) }}</td>
												</tr>
												<tr>
													<td colspan=2><b>Note: </b> {{$service->details}}</td>
												</tr>

												<tr>
													<td>Created At</td>
													<td>{{$service->created_at}}</td>
												</tr>
												<tr>
													<td>Updated At</td>
													<td>{{$service->updated_at}}</td>
												</tr>
												<tr>
													<td>Created By</td>
													<td>{{$service->created_by?App\Admin::find($service->created_by)->first_name:''}}</td>
												</tr>
												<tr>
													<td>Updated By</td>
													<td>{{$service->updated_by?App\Admin::find($service->updated_by)->first_name:''}}</td>
												</tr>
											</tbody>
										</table>
										<a href="/admin/service/{{$service->id}}/delete" style="color:#f00;font-size:16px" onclick="return confirm('Are you sure you want to delete this service? Be sure that it will not back later.')">&times;</a>
									</div>
								</div>
						</div>
					</div>
				  </div>
			</div>
		</div>
	</div><!-- end row --> 
@endsection