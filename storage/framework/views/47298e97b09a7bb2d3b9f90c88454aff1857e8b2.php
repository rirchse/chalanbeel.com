<?php $__env->startSection('title', 'Bill Details'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Bill Details</h4>
                <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="text-success" title="View Active Services" href="/admin/bill/paid/view"><i class="material-icons">assignment</i></a>
                        <a class="text-primary" title="View All Services" href="/admin/bill/due/view"><i class="material-icons">assignment</i></a>
                        <a class="text-warning" title="Edit" href="/admin/payment/<?php echo e($bill->id); ?>/edit"><i class="material-icons">edit</i></a>

                        <a class="text-info" title="View Bills" href="/admin/payment/<?php echo e($bill->service_id); ?>/total_paid"><i class="material-icons">subject</i></a>
                        <a class="btn-simple btn-icon text-warning" title="View Due Bills" href="/admin/payment/<?php echo e($bill->service_id); ?>/total_due"><i class="material-icons">subject</i></a>
                        <a class="btn-simple btn-icon text-warning" title="View Due Bills" href="/admin/payment/<?php echo e($bill->service_id); ?>/total_due"><i class="material-icons">print</i></a>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <th>Billing Method</th>
                        <th><?php echo e($bill->payment_system); ?></th>
                    <tr>
                        <th>Account No.</th>
                        <td><?php echo e($bill->account_no); ?></td>
                    </tr>
                    <tr>
                        <th>Referer</th>
                        <td><?php echo e($bill->refer_no); ?></td>
                    </tr>
                    <tr>
                        <th>TrxID</th>
                        <td><?php echo e($bill->trxid); ?></td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td><?php echo e($bill->receive); ?></td>
                    </tr>
                    <tr>
                        <th>Receive Date</th>
                        <td><?php echo e($bill->receive_date); ?></td>
                    </tr>
                    <tr>
                        <th>Billing Month</th>
                        <td><?php echo e($bill->billing_month); ?></td>
                    </tr>
                    <tr>
                        <th>Service Details</th>
                        <td><a href="/admin/service/<?php echo e($bill->service_id); ?>">View Service Details</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <th><?php echo e($bill->status == 1? 'Paid':'Due'); ?></th>
                    </tr>
                    <tr>
                        <td>Details: </td>
                        <td><?php echo e($bill->details); ?></td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td><?php echo e($bill->created_at); ?></td>
                    </tr>
                    <tr>
                        <th>Created By</th>
                        <td><?php echo e($bill->first_name.' '.$bill->last_name); ?></td>
                    </tr>
                    <tr>
                        <th>Updated By</th>
                        <td><?php echo e($bill->first_name.' '.$bill->last_name); ?></td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div> <!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/billings/read_payment.blade.php ENDPATH**/ ?>