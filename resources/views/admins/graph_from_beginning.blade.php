@extends('print')
@section('title', 'Graph')
@section('content')

<?php
//get all users and process as type
$allusers = DB::table('services')->get();
$new_user = $paid_user = $free_user = $cancel_user = 0;
foreach($allusers as $user){
    if($user->status == 0){
        $new_user ++;
    }elseif($user->status == 1){
        $paid_user ++;
    }elseif($user->status == 2){
        $free_user ++;
    }elseif($user->status == 3){
        $cancel_user ++;
    }
}
?>

<?php
  $investasdate = $salesasdate = $inivest_tally = $salse_tally = $dates = $dates_tally = '';
  $totalinvest = $totalsalse = 0;
  $mindate = DB::table('invests')->min('date');
  $months = number_format((strtotime(date('Y-m-d')) - strtotime($mindate))/24/3600/30);
  // dd($months);
  for($rs = $months; $rs >= 0; $rs--){
    //invest calc as date
    $invests = DB::table('invests')->where('date', 'like', '%'.date('Y-m', strtotime('-'.$rs.' month')).'%')->sum('amount');
    $totalinvest += $invests; //total invests
    $investmax[] = $invests; // max invest
    $investasdate .= $invests.', ';
    $inivest_tally .='<td width="100">'.$invests.'</td>';


    //salse calc as date
    $payments = DB::table('payments')->where('receive_date', 'like', '%'.date('Y-m', strtotime('-'.$rs.' month')).'%')->sum('receive');
    $totalsalse += $payments;
    $salsemax[] = $payments;
    $salesasdate .= $payments.', ';
    $salse_tally .='<td>'.$payments.'</td>';

    // $users = count(DB::table('users')->where('status', 0)->where('created_at', 'like', '%'.date('Y-m', strtotime('-'.$rs.' month')).'%')->get());
    // $total_inactusers += $users;
    // $inactusers .= $users.', ';

    $dates .= "'".date('M y', strtotime('-'.$rs.' month'))."', ";
    $dates_tally .= '<td>'.date('M y', strtotime('-'.$rs.' month')).'</td>';
  }

// dd(max(array_merge($salsemax, $investmax)));

?>

<div class="row">
    <div class="" style="margin:30px">
        <div class="card" style="width: {{$months*100}}px">
            <div class="card-header card-header-icon" data-background-color="blue">
                <i class="material-icons">timeline</i>
            </div>
            <div class="card-content">
                <h4 class="card-title"><span class="text-danger">Investments ({{$totalinvest}})</span> and <span class="text-info">Sales ({{$totalsalse}})</span> Graph <a href="/admin" class="label label-default">Back</a></h4>
            </div>
            <div id="colouredBarsChart" class="ct-chart"></div>
            <div class="col-md-12">
                {{-- <div class="col-md-12"> --}}
                    <table class="table">
                        <tr>
                            {{-- {!!$dates_tally!!} --}}
                        </tr>
                        <tr style="color:#f00" title="Investments">
                            {!!$inivest_tally!!}
                        </tr>
                        <tr style="color:#00bcd4" title="Sales">
                            {!!$salse_tally!!}
                        </tr>
                    </table>
                {{-- </div> --}}
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="green">
                <i class="fa fa-server"></i>
            </div>
            <div class="card-content">
                <p class="category">Paid Services</p>
                <h3 class="card-title">{{$paid_user}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-success">peoples</i>
                    <a href="/admin/view_active_services">View Paid Services</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="purple">
                <i class="fa fa-server"></i>
            </div>
            <div class="card-content">
                <p class="category">Free Services</p>
                <h3 class="card-title">{{$free_user}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-primary">peoples</i>
                    <a href="/admin/view_free_services">View Free Services</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="rose">
                <i class="fa fa-server"></i>
            </div>
            <div class="card-content">
                <p class="category">Cancel Services</p>
                <h3 class="card-title">{{$cancel_user}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-danger">peoples</i>
                    <a href="/admin/view_cancel_services">View Canceled Services</a>
                </div>
            </div>
        </div>
    </div> --}}
</div>
{{-- <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="orange">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <p class="category">New Users</p>
                <h3 class="card-title">{{$new_user}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-warning">peoples</i>
                    <a href="/admin/view/new/users">View New Users</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="blue">
                <i class="material-icons">people</i>
            </div>
            <div class="card-content">
                <p class="category">Users</p>
                <h3 class="card-title">{{count(DB::table('users')->get())}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">list</i>
                    <a href="/admin/view/all/users">View Users</a>
                </div>
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
                <h3 class="card-title">{{count(DB::table('users')->get())}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">list</i>
                    <a href="/admin/view/active/users">View Users</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="row">
    {{-- <div class="col-md-6">
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
    </div> --}}
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
    </div> --}}

</div>
{{-- <div class="row">
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
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="../assets/img/flags/US.png">
                                            </div>
                                        </td>
                                        <td>Chanchkoir</td>
                                        <td class="text-right">
                                            2.920
                                        </td>
                                        <td class="text-right">
                                            53.23%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="../assets/img/flags/DE.png">
                                            </div>
                                        </td>
                                        <td>Nazirpur</td>
                                        <td class="text-right">
                                            1.300
                                        </td>
                                        <td class="text-right">
                                            20.43%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="../assets/img/flags/AU.png">
                                            </div>
                                        </td>
                                        <td>Bildahar</td>
                                        <td class="text-right">
                                            760
                                        </td>
                                        <td class="text-right">
                                            10.35%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="../assets/img/flags/GB.png">
                                            </div>
                                        </td>
                                        <td>Gurudaspur</td>
                                        <td class="text-right">
                                            690
                                        </td>
                                        <td class="text-right">
                                            7.87%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="../assets/img/flags/RO.png">
                                            </div>
                                        </td>
                                        <td>Khubjipur</td>
                                        <td class="text-right">
                                            600
                                        </td>
                                        <td class="text-right">
                                            5.94%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="../assets/img/flags/BR.png">
                                            </div>
                                        </td>
                                        <td>Kanchikata</td>
                                        <td class="text-right">
                                            550
                                        </td>
                                        <td class="text-right">
                                            4.34%
                                        </td>
                                    </tr>
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
</div> --}}
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

          ]
        };
        var optionsWebsiteViewsChart = {
            axisX: {
                showGrid: true
            },
            low: 0,
            high: <?php echo 200; ?>,
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

    /*  **************** Coloured Rounded Line Chart - Line Chart ******************** */
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