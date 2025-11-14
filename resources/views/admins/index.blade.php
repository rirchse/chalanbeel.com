@extends('admin')
@section('title', 'Home')
@section('content')

{{-- {{dd($intuser)}} --}}

<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
        <div class="card-header" data-background-color="orange">
            <i class="material-icons">people</i>
        </div>
        <div class="card-content">
            <p class="category">Total</p>
            <h3 class="card-title">{{$intuser['total']}}</h3>
        </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
        <div class="card-header" data-background-color="blue">
            <i class="material-icons">people</i>
        </div>
        <div class="card-content">
            <p class="category">Active</p>
            <h3 class="card-title">{{$intuser['active']}}</h3>
        </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
        <div class="card-header" data-background-color="green">
            <i class="material-icons">people</i>
        </div>
        <div class="card-content">
            <p class="category">Expired</p>
            <h3 class="card-title">{{$intuser['expire']}}</h3>
        </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header" data-background-color="green">
          <i class="material-icons">people</i>
      </div>
      <div class="card-content">
          <p class="category">Users</p>
          <h3 class="card-title">{{$intuser['expire']}}</h3>
      </div>
  </div>
  </div>
  </div>

<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="green">
          <i class="fa fa-user"></i>
      </div>
      <div class="card-content">
          <p class="category">Paid Services</p>
          <h3 class="card-title">{{$intuser['expire']}}</h3>
      </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="purple">
          <i class="fa fa-user"></i>
      </div>
      <div class="card-content">
          <p class="category">Free Services</p>
          <h3 class="card-title">{{$intuser['expire']}}</h3>
      </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="rose">
          <i class="fa fa-user"></i>
      </div>
      <div class="card-content">
          <p class="category">Cancel Services</p>
          <h3 class="card-title">{{$intuser['expire']}}</h3>
      </div>
  </div>
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
    {{-- <div class="col-md-4">
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
    </div> --}}
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
                                    {{-- @foreach($locations as $location)
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="../assets/img/flags/US.png">
                                            </div>
                                        </td>
                                        <td>{{ $location->station}}</td>
                                        <td class="text-right">
                                            {{ count($location->services) }}
                                        </td>
                                        <td class="text-right">
                                            53.23%
                                        </td>
                                    </tr>
                                    @endforeach --}}
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
{{-- <h3>Manage Listings</h3> --}}
<br>
{{-- <div class="row">
    <div class="col-md-4">
        <div class="card card-product">
            <div class="card-image" data-header-animation="true">
                <a href="#pablo">
                    <img class="img" src="../assets/img/card-2.jpg">
                </a>
            </div>
            <div class="card-content">
                <div class="card-actions">
                    <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                        <i class="material-icons">build</i> Fix Header!
                    </button>
                    <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="View">
                        <i class="material-icons">art_track</i>
                    </button>
                    <button type="button" class="btn btn-success btn-simple" rel="tooltip" data-placement="bottom" title="Edit">
                        <i class="material-icons">edit</i>
                    </button>
                    <button type="button" class="btn btn-danger btn-simple" rel="tooltip" data-placement="bottom" title="Remove">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <h4 class="card-title">
                    <a href="#pablo">Cozy 5 Stars Apartment</a>
                </h4>
                <div class="card-description">
                    The place is close to Barceloneta Beach and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Barcelona.
                </div>
            </div>
            <div class="card-footer">
                <div class="price">
                    <h4>$899/night</h4>
                </div>
                <div class="stats pull-right">
                    <p class="category"><i class="material-icons">place</i> Barcelona, Spain</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-product">
            <div class="card-image" data-header-animation="true">
                <a href="#pablo">
                    <img class="img" src="../assets/img/card-3.jpg">
                </a>
            </div>
            <div class="card-content">
                <div class="card-actions">
                    <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                        <i class="material-icons">build</i> Fix Header!
                    </button>
                    <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="View">
                        <i class="material-icons">art_track</i>
                    </button>
                    <button type="button" class="btn btn-success btn-simple" rel="tooltip" data-placement="bottom" title="Edit">
                        <i class="material-icons">edit</i>
                    </button>
                    <button type="button" class="btn btn-danger btn-simple" rel="tooltip" data-placement="bottom" title="Remove">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <h4 class="card-title">
                    <a href="#pablo">Office Studio</a>
                </h4>
                <div class="card-description">
                    The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the night life in London, UK.
                </div>
            </div>
            <div class="card-footer">
                <div class="price">
                    <h4>$1.119/night</h4>
                </div>
                <div class="stats pull-right">
                    <p class="category"><i class="material-icons">place</i> London, UK</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-product">
            <div class="card-image" data-header-animation="true">
                <a href="#pablo">
                    <img class="img" src="../assets/img/card-1.jpg">
                </a>
            </div>
            <div class="card-content">
                <div class="card-actions">
                    <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                        <i class="material-icons">build</i> Fix Header!
                    </button>
                    <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="View">
                        <i class="material-icons">art_track</i>
                    </button>
                    <button type="button" class="btn btn-success btn-simple" rel="tooltip" data-placement="bottom" title="Edit">
                        <i class="material-icons">edit</i>
                    </button>
                    <button type="button" class="btn btn-danger btn-simple" rel="tooltip" data-placement="bottom" title="Remove">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <h4 class="card-title">
                    <a href="#pablo">Beautiful Castle</a>
                </h4>
                <div class="card-description">
                    The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Milan.
                </div>
            </div>
            <div class="card-footer">
                <div class="price">
                    <h4>$459/night</h4>
                </div>
                <div class="stats pull-right">
                    <p class="category"><i class="material-icons">place</i> Milan, Italy</p>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection

<?php
// if(App\User::where('status', 1)->get()){
//     foreach(App\User::where('status', 1)->get() as $user_join){
//         //
//     }
// }

$dates = '';
$investasdate = '';
$salesasdate = '';
$salsemax = [1,2,3];
$investmax = [2,3,4];
?>

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        md.initSliders()
        demo.initFormExtendedDatetimepickers();
    });

    //this codes for chart controller
    var dataWebsiteViewsChart = {
          labels: [<?php echo $dates; ?>],
          series: [
            [<?php echo $investasdate; ?>]
            [1,2,3,4,5,6,7,8,9,10,11,12]

          ]
        };
        var optionsWebsiteViewsChart = {
            axisX: {
                showGrid: true
            },
            low: 0,
            high: <?php echo 12; ?>,
            chartPadding: { top: 0, right: 5, bottom: 0, left: 0}
        };
</script>

<script>
    $(document).ready(function() {
        demo.initCharts();
    });
</script>

<?php // ?>
<script type="text/javascript">
        dataColouredBarsChart = {
          labels: [<?php echo $dates; ?>],
          series: [
            [<?php echo $salesasdate; ?>],
            [<?php echo $investasdate; ?>]
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
          high: <?php echo max(array_merge($salsemax, $investmax)); ?>,
          showPoint: true,
          height: '300px'
        };


        var colouredBarsChart = new Chartist.Line('#colouredBarsChart', dataColouredBarsChart, optionsColouredBarsChart);

        md.startAnimationForLineChart(colouredBarsChart);
</script>
@endsection