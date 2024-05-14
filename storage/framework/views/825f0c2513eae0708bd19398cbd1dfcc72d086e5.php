<?php $__env->startSection('title', 'All Packages'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">All Packages</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Connection</th>
                                <th>Service</th>
                                <th>Created At</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Connection</th>
                                <th>Service</th>
                                <th>Created At</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 0; ?>

                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($service->speed); ?></td>
                                <td><?php echo e($service->time_limit); ?></a></td>
                                <td><?php echo e($service->price); ?></td>
                                <td><?php echo e($service->discount); ?></td>
                                <td><?php echo e($service->connection); ?></td>
                                <td><?php echo e($service->service); ?></td>
                                <td title="<?php echo e(date('H:i:s', strtotime($service->created_at))); ?>"><?php echo e(date('d M Y', strtotime($service->created_at))); ?></td>
                                <td class="text-right">
                                    <a href="/admin/create/<?php echo e($service->id); ?>/service/<?php echo e($user->id); ?>" class="btn btn-xs btn-warning">Get<i class="material-icons"></i></a>
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
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/services/create_service_select.blade.php ENDPATH**/ ?>