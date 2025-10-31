@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
    
@endphp

@extends('user')
@section('title', 'Home')
@section('content')

<?php $user = Auth::user(); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card card-stats">
            <table class="table table-bordered">
                <tr>
                    <th>Join Date</th>
                    <td>{{$source->dtformat($user->join_date)}}</td>
                </tr>
                <tr>
                    <th>Billing Date</th>
                    <td>{{$source->dtformat($user->billing_date)}}</td>
                </tr>
                <tr>
                    <th>Next Payment Date</th>
                    <td>{{$source->dtformat($user->payment_date)}}</td>
                </tr>
                <tr>
                    <th>Package</th>
                    <td>
                        @foreach($services as $service)
                        {{$service->speed.' '.$service->time_limit}}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        {{$user->status}}
                    </td>
                </tr>
                {{-- <tr>
                    <th>Total Payments</th>
                    <td>
                        <a href="/view_payments">Total Payments</a>
                    </td>
                </tr>
                <tr>
                    <th>Due Bills</th>
                    <td>
                        <a href="/view_due_bills">Due Payments</a>
                    </td>
                </tr> --}}
                <tr>
                    <td colspan="2">
                        <form action="{{ route('bkash.pay') }}" method="POST">
                            @csrf
                        <button type="submit" class="btn btn-lg btn-warning btn-block" href="{{App\Service::where('user_id', $user->id)->first()}}"> <img src="/images/icons/bkash.png" alt="" style="width:100px"> Pay Now</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="row">
    {{-- <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body" data-background-color="purple">
                <i class="material-icons">equalizer</i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="purple">
                <i class="material-icons">equalizer</i>
            </div>
            <div class="card-content">
                <p class="category">Service</p>
                <h3 class="card-title">{{count($services)}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">local_offer</i>
                    <a href="/view_services">View Services</a>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="orange">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <p class="category">Due Bill</p>
                <h3 class="card-title">
                    {{App\Service::where('user_id', Auth::id())->first()->billing_date}}
                    
                    {{App\Payment::orderBy('id', 'DESC')->first()->billing_month}}
                </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="/view_due_bills">View Due Bills</a>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="green">
                <i class="material-icons">store</i>
            </div>
            <div class="card-content">
                <p class="category">Total Paid</p>
                <h3 class="card-title">{{count($payments)}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i>
                    <a href="/view_payments">View Payments</a>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="blue">
                <i class="fa fa-twitter"></i>
            </div>
            <div class="card-content">
                <p class="category">Services</p>
                <h3 class="card-title">{{count(DB::table('services')->get())}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">update</i> Just Updated
                </div>
            </div>
        </div>
    </div> --}}
</div>

{{-- <div class="row">
    <div class="col-md-4">
        <div class="card card-chart">
            <div class="card-header" data-background-color="green" data-header-animation="true">
                <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-content">
                <div class="card-actions">
                    <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                        <i class="material-icons">build</i> Fix Header!
                    </button>
                    <button type="button" class="btn btn-info btn-simple" rel="tooltip" data-placement="bottom" title="Refresh">
                        <i class="material-icons">refresh</i>
                    </button>
                    <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="Change Date">
                        <i class="material-icons">edit</i>
                    </button>
                </div>
                <h4 class="card-title">Website Views</h4>
                <p class="category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i> campaign sent 2 days ago
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-chart">
            <div class="card-header" data-background-color="green" data-header-animation="true">
                <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-content">
                <div class="card-actions">
                    <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                        <i class="material-icons">build</i> Fix Header!
                    </button>
                    <button type="button" class="btn btn-info btn-simple" rel="tooltip" data-placement="bottom" title="Refresh">
                        <i class="material-icons">refresh</i>
                    </button>
                    <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="Change Date">
                        <i class="material-icons">edit</i>
                    </button>
                </div>
                <h4 class="card-title">Daily Sales</h4>
                <p class="category">
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i> updated 4 minutes ago
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-chart">
            <div class="card-header" data-background-color="blue" data-header-animation="true">
                <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-content">
                <div class="card-actions">
                    <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                        <i class="material-icons">build</i> Fix Header!
                    </button>
                    <button type="button" class="btn btn-info btn-simple" rel="tooltip" data-placement="bottom" title="Refresh">
                        <i class="material-icons">refresh</i>
                    </button>
                    <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="Change Date">
                        <i class="material-icons">edit</i>
                    </button>
                </div>
                <h4 class="card-title">Completed Tasks</h4>
                <p class="category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i> campaign sent 2 days ago
                </div>
            </div>
        </div>
    </div>
</div> --}}
<?php

$users = DB::table('users')->get();
$monthly_user = 0;
foreach($users as $user){
    //
    if($user->join_date == date('Y-m-d')){
        //
    }
}

?>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        md.initSliders()
        demo.initFormExtendedDatetimepickers();
    });

    //this codes for chart controller

    var dataWebsiteViewsChart = {
          labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
          series: [
            [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]

          ]
        };
        var optionsWebsiteViewsChart = {
            axisX: {
                showGrid: false
            },
            low: 0,
            high: <?php echo count($users); ?>,
            chartPadding: { top: 0, right: 5, bottom: 0, left: 0}
        };
</script>
@endsection