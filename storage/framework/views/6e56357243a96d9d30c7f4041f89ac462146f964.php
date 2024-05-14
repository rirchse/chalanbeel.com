<?php $__env->startSection('title', 'package Details'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content" style="">
                <div class="col-md-8">
                    <h4 class="card-title">package Details</h4>
                </div>
                <div class="toolbar">
                    <a class="btn-simple btn-icon text-warning" href="/admin/package/<?php echo e($package->id); ?>/edit"><i class="material-icons">edit</i></a>
                    <a class="btn-simple btn-icon text-info" href="/admin/package"><i class="material-icons">subject</i></a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-content">
                            <div class="table-responsive table-space">
                                <table class="table table-bordered table-space">
                                        <tbody>
                                            <tr>
                                                <th>Package</th>
                                                <td><?php echo e($package->service_mode); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Speed</td>
                                                <td><?php echo e($package->speed); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Time Limit</td>
                                                <td><?php echo e($package->time_limit); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td><?php echo e($package->price); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>
                                                    <?php if($package->status == 1): ?>
                                                    <label class="label label-success">Active</label>
                                                    <?php else: ?>
                                                    <label class="label label-success">Inactive</label>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="/admin/package/<?php echo e($package->id); ?>/delete" style="color:#f00;font-size:16px" onclick="return confirm('Are you sure you want to delete this package? Be sure that it will not back later.')">&times;</a>
                                </div>
                            </div>
                    </div>
                </div>
              </div>
        </div>
    </div>
</div><!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/packages/read_package.blade.php ENDPATH**/ ?>