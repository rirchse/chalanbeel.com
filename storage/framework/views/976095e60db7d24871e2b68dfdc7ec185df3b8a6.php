<?php $__env->startSection('title', 'Showing payments'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Payments</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Payment By</th>
                                <th>Account No</th>
                                <th>Amount</th>
                                <th>Payment On</th>
                                <th>Billing Month</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Payment By</th>
                                <th>Account No</th>
                                <th>Amount</th>
                                <th>Payment On</th>
                                <th>Billing Month</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 1; ?>

                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($payment->payment_system); ?></td>
                                <td><?php echo e($payment->refer_no); ?></td>
                                <td><?php echo e($payment->receive); ?></td>
                                <td title="<?php echo e(date('H:i:s', strtotime($payment->receive_date))); ?>"><?php echo e(date('d M Y', strtotime($payment->receive_date))); ?></td>
                                <td><?php echo e(date('M Y', strtotime($payment->billing_month))); ?></td>
                                <td><?php echo e($payment->speed.'bps-'.$payment->time_limit); ?></td>
                                <td>
                                    <?php if($payment->status == 0): ?>
                                    <span style="color:#d00">Pending
                                    <?php elseif($payment->status == 1): ?>
                                    <span style="color:#0d0">Active
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    
                                    
                                </td>
                            </tr>
                            <?php $r++; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/users/view_payments.blade.php ENDPATH**/ ?>