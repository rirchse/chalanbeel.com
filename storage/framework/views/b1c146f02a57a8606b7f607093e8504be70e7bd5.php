<?php $__env->startSection('title', 'View Users'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing <?php echo e(ucfirst($type)); ?> Users <b>(<?php echo e(count($users)); ?>)</b></h4>
                <div class="toolbar">
                    
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Location</th>
                                <th>Join Date</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Location</th>
                                <th>Join Date</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php $r = 0; ?>

                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($user->full_name); ?></td>
                                <td><?php echo e($user->contact); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->station); ?></td>
                                <td title="<?php echo e(date('h:i:s', strtotime($user->join_date))); ?>"><?php echo e(date('d M Y', strtotime($user->join_date))); ?></td>
                                <td>
                                    <?php if($user->status == 1): ?>
                                    <i class="material-icons text-success">check</i>
                                    <?php else: ?>
                                    <i class="material-icons text-warning">close</i>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <a href="/admin/user/<?php echo e($user->id); ?>/details" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/user/<?php echo e($user->id); ?>/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the record"><i class="material-icons">mode_edit</i></a>
                                    <a href="/admin/create/<?php echo e($user->id); ?>/service" class="btn btn-simple btn-success btn-icon" title="Add New Servcie"><i class="material-icons">add_circle</i></a>
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
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/users/view_all_type_users.blade.php ENDPATH**/ ?>