<?php $__env->startSection('title', 'View Active Users'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Active Users</h4>
                <div class="toolbar text-right">
                    <a class="btn btn-info btn-simple btn-icon" href="/admin/active/users/mikrotik">chek on mikrotik</a>
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Caller ID</th>
                                <th>Address</th>
                                <th>Uptime</th>
                                <th>Service</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Caller ID</th>
                                <th>Address</th>
                                <th>Uptime</th>
                                <th>Service</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php $r = 0; ?>

                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($user('name')); ?></td>
                                <td><?php echo e($user('caller-id')); ?></td>
                                <td><?php echo e($user('address')); ?></td>
                                <td><?php echo e($user('uptime')); ?></td>
                                <td><?php echo e($user('service')); ?></td>
                                <td class="text-right">
                                    
                                    <a href="/admin/user/<?php echo e($user('id')); ?>/edit" class="btn btn-xs btn-danger btn-icon" title="Edit the record"><i class="material-icons" onclick="return confirm('Are you sure you want to disconnect this user!')">close</i></a>
                                    
                                </td>
                            </tr>

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
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/users/view_active_users_mikrotik.blade.php ENDPATH**/ ?>