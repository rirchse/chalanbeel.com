<?php $__env->startSection('title', 'View Invests'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Invests</h4>
                <div class="toolbar" style="text-align:right">
                    <a class="btn btn-success btn-xs" href="/admin/create_invest" title="Add New invest"><i class="material-icons">add</i></a>
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>What's For</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Vendor</th>
                                <th>Details</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>What's For</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Vendor</th>
                                <th>Details</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 0; $total_amount = 0; ?>

                            <?php $__currentLoopData = $invests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($invest->whats_for); ?></a></td>
                                <td>&#2547;<?php echo e($invest->amount); ?></td>
                                <td title="<?php echo e(date('H:i:s', strtotime($invest->date))); ?>"><?php echo e(date('d M Y', strtotime($invest->date))); ?></td>
                                <td><?php echo e($invest->vendor); ?></td>
                                <td><?php echo e($invest->details); ?></td>
                                <td class="text-right">
                                    <a href="/admin/invest_details/<?php echo e($invest->id); ?>" class="text-info"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/invest/<?php echo e($invest->id); ?>/edit" class="text-warning" title="Edit the record"><i class="material-icons">edit</i></a>
                                </td>
                            </tr>

                            <?php $total_amount += $invest->amount; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            

                        </tbody>
                        <tr>
                            <th></th>
                            <th>Total = </th>
                            <th>&#2547;<?php echo e($total_amount); ?></th>
                            <th colspan="4"></th>
                        </tr>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/invests/view_invests.blade.php ENDPATH**/ ?>