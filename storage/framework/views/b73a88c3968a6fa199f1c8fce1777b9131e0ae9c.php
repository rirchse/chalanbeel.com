<?php $__env->startSection('title', 'Show Users'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title">Showing User List</h4>
        <div class="card-content">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Contact</th>
                            <th>Job Position</th>
                            <th>Since</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $r = 0; ?>

                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php $r++ ?>

                        <tr>
                            <td class="text-center"><?php echo e($r); ?></td>
                            <td><?php echo e($user->first_name. ' ' .$user->last_name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->contact); ?></td>
                            <td><?php echo e($user->job_title); ?></td>
                            <td><?php echo e(date('m/d/Y', strtotime($user->created_at))); ?></td>
                            <td class="td-actions text-right">
                                <a href="/admin/user/<?php echo e($user->id); ?>" rel="tooltip" class="btn btn-info btn-simple">
                                    <i class="material-icons">person</i>
                                </a>
                                <a href="/admin/user/<?php echo e($user->id); ?>" rel="tooltip" class="btn btn-success btn-simple">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="button" rel="tooltip" class="btn btn-danger btn-simple">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>

                        

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/users/users.blade.php ENDPATH**/ ?>