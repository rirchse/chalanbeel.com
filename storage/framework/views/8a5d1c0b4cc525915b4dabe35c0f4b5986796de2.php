<?php $__env->startSection('title', 'User Details'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">User Details</h4> 
                <div class="col-md-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="text-success" title="View Active Users" href="/admin/user/view_active_users"><i class="material-icons">assignment</i></a>
                        <a class="text-primary" title="View All Users" href="/admin/user"><i class="material-icons">assignment</i></a>
                        <a class="text-warning" title="Edit" href="/admin/user/<?php echo e($user->id); ?>/edit"><i class="material-icons">edit</i></a>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-responsive">
                        <tr>
                            <th>User Name</th>
                            <th><?php echo e($user->full_name); ?></th>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td><?php echo e($user->contact); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo e($user->email); ?></td>
                        </tr>
                        <tr>
                            <th>NID No.</th>
                            <td><?php echo e($user->nid_no); ?></td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td><?php echo e($user->date_of_birth); ?></td>
                        </tr>
                        <tr>
                            <th>Work At</th>
                            <td><?php echo e($user->work_at); ?></td>
                        </tr>
                        <tr>
                            <th>Join Date</th>
                            <td><?php echo e($user->join_date); ?></td>
                        </tr>
                        <tr>
                            <th>Devie MAC</th>
                            <td><?php echo e($user->mac_address); ?></td>
                        </tr>
                        <tr>
                            <th>Station</th>
                            <td><?php echo e($user->station); ?></td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td><?php echo e($user->area); ?></td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td><?php if($user->left_long): ?>
                            <a target="_blank" href="https://www.google.com/maps/place/<?php echo e($user->left_long); ?>">View On Map</a>
                            <?php else: ?>
                            Unavailable
                            <?php endif; ?></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?php echo e($user->created_at); ?></td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td><?php echo e($user->created_by); ?></td>
                        </tr>
                        <tr>
                            <th>Updated By</th>
                            <td><?php echo e($user->updated_by); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
      <div class="card card-profile">
        <div class="card-avatar">
          <a href="#pablo">
            <img src="/images/<?php echo e($user->image?'profile/'.$user->image:'avatar.png'); ?>" class="img">
          </a>
        </div>
        <div class="card-body">
          <h6 class="card-category text-gray"><?php echo e($user->profession); ?></h6>
          <h4 class="card-title"><?php echo e($user->full_name); ?></h4>
          <p class="card-description">details....</p>
          <img class="img-responsive" src="/images/<?php echo e($user->nid_image?'nid/'.$user->nid_image:'nid-sample.jpg'); ?>">
          <a class="btn btn-rose btn-round" href="#pablo">Follow</a>
        </div>
      </div>
    </div> <!-- end content-->
</div> <!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/users/read_user.blade.php ENDPATH**/ ?>