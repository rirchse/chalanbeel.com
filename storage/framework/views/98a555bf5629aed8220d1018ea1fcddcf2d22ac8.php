<?php $__env->startSection('title', 'Graph'); ?>
<?php $__env->startSection('content'); ?>

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
        <div class="card" style="width: <?php echo e($months*100); ?>px">
            <div class="card-header card-header-icon" data-background-color="blue">
                <i class="material-icons">timeline</i>
            </div>
            <div class="card-content">
                <h4 class="card-title"><span class="text-danger">Investments (<?php echo e($totalinvest); ?>)</span> and <span class="text-info">Sales (<?php echo e($totalsalse); ?>)</span> Graph <a href="/admin" class="label label-default">Back</a></h4>
            </div>
            <div id="colouredBarsChart" class="ct-chart"></div>
            <div class="col-md-12">
                
                    <table class="table">
                        <tr>
                            
                        </tr>
                        <tr style="color:#f00" title="Investments">
                            <?php echo $inivest_tally; ?>

                        </tr>
                        <tr style="color:#00bcd4" title="Sales">
                            <?php echo $salse_tally; ?>

                        </tr>
                    </table>
                
            </div>
        </div>
    </div>

    
</div>

<div class="row">
    
    

</div>


<br>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/graph_from_beginning.blade.php ENDPATH**/ ?>