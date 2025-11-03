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
                <th>Name:</th>
                <th><?php echo e($user->name); ?></th>
              </tr>
              <tr>
                <th>Contact:</th>
                <th><?php echo e($user->contact); ?></th>
              </tr>
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
                    <td><?php echo e($user->package->speed); ?></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><?php echo e($user->package->price); ?> Taka</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                      <?php if($user->status == 'Active'): ?>
                      <span class="label label-success"><?php echo e($user->status); ?></span>
                      <?php else: ?>
                      <span class="label label-danger"><?php echo e($user->status); ?></span>
                      <?php endif; ?>  
                    </td>
                </tr>
                <tr>
                    <th>Username:</th>
                    <td><?php echo e($user->username); ?></td>
                </tr>
                <tr>
                    <th>PPPoE Password:</th>
                    <td><?php echo e($user->service_password); ?></td>
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