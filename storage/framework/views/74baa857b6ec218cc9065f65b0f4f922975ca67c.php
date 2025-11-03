<?php $__env->startSection('title', 'View all Packages'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing all Packages (<?php echo e(count($packages)); ?>)</h4>
                <div class="toolbar" style="text-align:right">
                    <a class="btn btn-info btn-xs" href="<?php echo e(route('package.create')); ?>" title="Add New package"><i class="material-icons">add</i> Add</a>
                    
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($package->speed); ?></td>
                                <td><?php echo e($package->time_limit); ?></a></td>
                                <td>&#2547;<?php echo e($package->price); ?></a></td>
                                <td>
                                    <?php if($package->status == 'Active'): ?>
                                    <span class="text-success text-simple" title="Active"><i class="material-icons">check</i> <?php echo e($package->status); ?></span>
                                    <?php else: ?>
                                    <span class="text-warning text-simple" title="Inactive"><i class="material-icons">close</i><?php echo e($package->status); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <a href="/admin/package/<?php echo e($package->id); ?>" class="btn btn-simple btn-icon btn-info"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/package/<?php echo e($package->id); ?>/edit" class="btn btn-simple btn-icon btn-warning" title="Edit the record"><i class="material-icons">edit</i></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/packages/view_packages.blade.php ENDPATH**/ ?>