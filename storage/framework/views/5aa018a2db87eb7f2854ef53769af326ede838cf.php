<?php $__env->startSection('title', 'View all Services'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Services</h4>
                <div class="toolbar text-right">
                    <a class="text-success" href="/admin/user" title="Add New Service"><i class="material-icons">add</i></a>
                    <a class="text-info" href="/admin/print_due_services" title="Print"><i class="material-icons">print</i></a>
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Bill(Tk.)</th>
                                <th>Date</th>
                                <th>User+Contact</th>
                                <th>Username</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right" width="100">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Bill(Tk.)</th>
                                <th>Date</th>
                                <th>User+Contact</th>
                                <th>Username</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $r = 0;
                            $total_amount = 0;
                            $total_receive = 0;
                            ?>

                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($service->speed .' - '.$service->time_limit); ?></td>
                                <td><?php echo e($service->amount?$service->amount:''); ?></td>
                                <td><?php echo e($service->billing_date? date('d M Y', strtotime($service->billing_date)):''); ?></td>
                                <td><?php echo e($service->full_name); ?></a></td>
                                <td><?php echo e($service->username); ?></a></td>
                                <td><?php echo e($service->billing_plan); ?></a></td>
                                <td>
                                    <?php if($service->status == 1): ?>
                                    <span class="label label-success">Active</span>
                                    <?php else: ?>
                                    <span class="label label-warning">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-simple btn-icon btn-info" href="/admin/service/<?php echo e($service->id); ?>" class="text-info"><i class="material-icons">dvr</i></a>
                                    <a class="btn btn-simple btn-icon btn-warning" href="/admin/service/<?php echo e($service->id); ?>/edit" class="text-warning" title="Edit the record"><i class="material-icons">edit</i></a>
                                    
                                </td>
                            </tr>

                            <?php 

                            $total_amount += $service->amount;
                            $total_receive += $service->receive;

                            ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                            <tr>
                                <th colspan="2">Total = </th>
                                <th>&#2547;<?php echo e($total_amount); ?></th>
                                <th colspan="2"></th>
                                <th>&#2547;<?php echo e($total_receive); ?></th>
                                <th colspan="3"></th>
                            </tr>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/services/view_services.blade.php ENDPATH**/ ?>