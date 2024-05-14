<?php $__env->startSection('title', 'Packages for User'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Packages</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Connection</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Connection</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 1; ?>

                            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($package->service); ?></td>
                                <td><?php echo e($package->connection); ?></td>
                                <td><?php echo e($package->speed); ?></td>
                                <td><?php echo e($package->time_limit); ?></td>
                                <td>&#x9f3;<?php echo e(number_format($package->price, 0)); ?></td>
                                <td><?php echo e($package->discount? number_format($package->discount,0).'%':''); ?> </td>
                                <td>
                                    <?php if($package->status == 0): ?>
                                    <span style="color:#d00">Inactive
                                    <?php elseif($package->status == 1): ?>
                                    <span style="color:#0d0">Active
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <a href="/package/<?php echo e($package->id); ?>/edit" class="btn btn-simple btn-info btn-icon" title="View details"><i class="material-icons">dvr</i></a>
                                    <a href="/package/<?php echo e($package->id); ?>/get" class="btn btn-xs btn-warning btn-icon" title="Get internet package">Get<i class="material-icons">arrow_right</i></a>
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
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/users/view_packages.blade.php ENDPATH**/ ?>