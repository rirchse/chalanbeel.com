<?php $__env->startSection('title', 'Received Payment'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple"><i class="material-icons">assignment</i></div>
            <div class="card-content">
                <h4 class="card-title">Received Payments</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Amount Tk.</th>
                                <th>PayMethod</th>
                                <th>Date</th>
                                <th>Billing Month</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Amount</th>
                                <th>PayMethod</th>
                                <th>Date</th>
                                <th>Billing Month</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 0; $total = 0; ?>

                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td title="<?php echo e($payment->full_name.' - '.$payment->station); ?>"><?php echo e($payment->username); ?></td>
                                <td><?php echo e($payment->receive?$payment->receive:'Due'); ?></td>
                                <td><?php echo e($payment->payment_system); ?></td>
                                <td><?php echo e($payment->receive_date?date('d M Y', strtotime($payment->receive_date)):''); ?></td>
                                <td><?php echo e($payment->billing_month); ?></td>
                                <td class="text-right">
                                    <a href="/admin/payment/<?php echo e($payment->id); ?>" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/payment/<?php echo e($payment->id); ?>/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the record"><i class="material-icons">mode_edit</i></a>
                                </td>
                            </tr>

                            <?php $total += $payment->receive; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th></th>
                                <th>Total = </th>
                                <th><?php echo e($total); ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/billings/view_payments.blade.php ENDPATH**/ ?>