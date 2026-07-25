@extends('admin')
@section('title', 'Home')
@section('content')

{{-- {{dd($intuser)}} --}}

<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6">
    <a href="{{route('user.search').'?service_type=Static'}}">
      <div class="card card-stats">
          <div class="card-header" data-background-color="blue">
            <i class="fa fa-users"></i>
          </div>
          <div class="card-content">
              <p class="category">Total</p>
              <h3 class="card-title">{{$intuser['total']}}</h3>
          </div>
      </div>
    </a>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <a href="{{route('user.search').'?service_type=Static&status=Active'}}">
    <div class="card card-stats">
        <div class="card-header" data-background-color="green">
            <i class="material-icons">people</i>
        </div>
        <div class="card-content">
            <p class="category">Active</p>
            <h3 class="card-title">{{$intuser['active']}}</h3>
        </div>
    </div>
    </a>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <a href="{{route('user.search').'?service_type=Static&date='.date('Y-m-d')}}">
      <div class="card card-stats">
          <div class="card-header" data-background-color="orange">
              <i class="material-icons">people</i>
          </div>
          <div class="card-content">
              <p class="category">Today Expired</p>
              <h3 class="card-title">{{$intuser['today_expire']}}</h3>
          </div>
        </div>
      </a>
    </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <a href="{{route('user.search').'?service_type=Static&status=Expire'}}">
      <div class="card card-stats">
          <div class="card-header" data-background-color="red">
            <i class="fa fa-users"></i>
          </div>
          <div class="card-content">
              <p class="category">Expired</p>
              <h3 class="card-title">{{$intuser['expire']}}</h3>
          </div>
      </div>
    </a>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <a href="{{route('user.search').'?service_type=Static&status=Cancel'}}">
      <div class="card card-stats">
        <div class="card-header" data-background-color="gray">
            <i class="material-icons">people</i>
        </div>
        <div class="card-content">
            <p class="category">Cancel</p>
            <h3 class="card-title">{{$intuser['cancel']}}</h3>
        </div>
      </div>
    </a>
  </div>

<div class="col-lg-3 col-md-6 col-sm-6">
  <a href="{{route('payment.index').'?start_date='.date('Y-m-01').'&end_date='.date('Y-m-t')}}">
    <div class="card card-stats">
        <div class="card-header" data-background-color="green">
            <i class="fa fa-money"></i>
        </div>
        <div class="card-content">
            <p class="category">Bill: {{date('M Y')}}</p>
            <h3 class="card-title">{{number_format($bill['thismonth'])}}</h3>
        </div>
    </div>
  </a>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <a href="{{route('payment.index').'?start_date='.date('Y-m-01', strtotime('-1 Month')).'&end_date='.date('Y-m-t', strtotime('-1 Month'))}}">
    <div class="card card-stats">
        <div class="card-header" data-background-color="purple">
            <i class="fa fa-money"></i>
        </div>
        <div class="card-content">
            <p class="category">Bill: {{date('M Y', strtotime('- 1 Month'))}}</p>
            <h3 class="card-title">{{number_format($bill['prevmonth'])}}</h3>
        </div>
      </div>
    </a>
  </div>
</div>

<div class="row">
    <div class="" style="overflow:auto">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="blue">
                <i class="material-icons">timeline</i>
            </div>
            <div class="card-content">
                <h4 class="card-title"><span class="text-danger">Investments ({{$invest['total']}})</span> and <span class="text-info">Sales ({{$invest['total']}})</span> Graph <a href="/admin/graph_from_beginning" class="label label-info">All</a></h4>
            </div>
            <div id="colouredBarsChart" class="ct-chart"></div>
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <td></td>
                        0
                    </tr>
                    <tr style="color:#f00">
                        <td>Investments</td>
                        0
                    </tr>
                    <tr style="color:#00bcd4">
                        <td>Sales</td>
                        0
                    </tr>
                </table>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-6">
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
                <h4 class="card-title">User Joined</h4>
                <p class="category">
                    //
                </p>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">peoples</i> User joined Graph
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
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

</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">language</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Service Locations</h4>
                <div class="row">
                    <div class="col-md-5">
                        <div class="table-responsive table-sales">
                            <table class="table">
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-1">
                        <div id="worldMap" class="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@php

$dates = 'Jan, Feb, Mar';
$investasdate = '';
$salesasdate = '';
$salsemax = [1000];
$investmax = [5000];

@endphp

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        md.initSliders()
        demo.initFormExtendedDatetimepickers();
    });

    //this codes for chart controller
    var dataWebsiteViewsChart = {
        labels: @json($salesCostGraph['dates']),
        series: [
          ['100', '200', '300']
        ]
      };
    var optionsWebsiteViewsChart = {
      axisX: {
          showGrid: true
      },
      low: 0,
      high: '<?php echo 1200; ?>',
      chartPadding: { top: 0, right: 5, bottom: 0, left: 0}
    };
</script>

<script>
    $(document).ready(function() {
        demo.initCharts();
    });
</script>


<script type="text/javascript">
        dataColouredBarsChart = {
          labels: ['<?php echo $dates; ?>'],
          series: [
            ['<?php echo $salesasdate; ?>'],
            ['<?php echo $investasdate; ?>']
          ]
        };

        optionsColouredBarsChart = {
          lineSmooth: Chartist.Interpolation.cardinal({
              tension: 10
          }),
          axisY: {
              showGrid: true,
              offset: 40
          },
          axisX: {
              showGrid: false,
          },
          low: 0,
          high: '<?php echo max(array_merge($salsemax, $investmax)); ?>',
          showPoint: true,
          height: '300px'
        };


        var colouredBarsChart = new Chartist.Line('#colouredBarsChart', dataColouredBarsChart, optionsColouredBarsChart);

        md.startAnimationForLineChart(colouredBarsChart);
</script>
@endsection