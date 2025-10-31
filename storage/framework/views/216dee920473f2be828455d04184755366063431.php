<?php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
    
?>


<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>

<?php $user = Auth::user(); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card card-stats">
            <table class="table table-bordered">
                <tr>
                    <th>Join Date</th>
                    <td><?php echo e($source->dtformat($user->join_date)); ?></td>
                </tr>
                <tr>
                    <th>Billing Date</th>
                    <td><?php echo e($source->dtformat($user->billing_date)); ?></td>
                </tr>
                <tr>
                    <th>Next Payment Date</th>
                    <td><?php echo e($source->dtformat($user->payment_date)); ?></td>
                </tr>
                <tr>
                    <th>Package</th>
                    <td>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($service->speed.' '.$service->time_limit); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php echo e($user->status); ?>

                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <form action="<?php echo e(route('bkash.pay')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-lg btn-warning btn-block" href="<?php echo e(App\Service::where('user_id', $user->id)->first()); ?>"> <img src="/images/icons/bkash.png" alt="" style="width:100px"> Pay Now</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="row">
    
    
    
    
</div>


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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/users/index.blade.php ENDPATH**/ ?>