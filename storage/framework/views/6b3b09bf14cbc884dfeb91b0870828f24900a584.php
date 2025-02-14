<?php $__env->startSection('title', 'Showing Services'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Services</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Bill</th>
                                <th>Billing Date</th>
                                <th>Status</th>
                                <th>Closed Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Bill</th>
                                <th>Billing Date</th>
                                <th>Status</th>
                                <th>Closed Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 1; ?>

                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($service->username); ?></td>
                                <td><?php echo e($service->speed); ?></td>
                                <td><?php echo e($service->time_limit); ?></td>
                                <td><?php echo e($service->amount); ?></td>
                                <td><?php echo e(date('d M Y', strtotime($service->billing_date))); ?></td>
                                <td>
                                    <?php if($service->status == 0): ?>
                                    <span style="color:#d00">Unpaid
                                    <?php elseif($service->status == 1): ?>
                                    <span style="color:#0d0">Active
                                    <?php else: ?>
                                    <span style="color:#d00">Closed
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($service->end_at?date('d M Y', strtotime($service->end_at)):'On Going'); ?></td>
                                <td class="text-right">
                                    
                                    
                                </td>
                            </tr>
                            <?php $r++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end content-->
        </div> <!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/users/view_services.blade.php ENDPATH**/ ?>