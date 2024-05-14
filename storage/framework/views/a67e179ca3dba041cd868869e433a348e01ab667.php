
<?php $__env->startSection('title', 'User Profile'); ?>
<?php $__env->startSection('content'); ?>

<?php $admin = Auth::guard('admin')->user() ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Edit Admin Detail</h4>

    <?php echo Form::model($user,['route' => ['admin.update', $user->id], 'method' => 'PUT', 'files' => true]); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('first_name', 'First Name:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('first_name', $user->first_name, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('last_name', 'Last Name:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('last_name', $user->last_name, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('email', 'Email Address:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::email('email', $user->email, ['class' => 'form-control', 'disabled' => ''])); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="fileinput fileinput-new text-center pull-right" data-provides="fileinput" style="width:250px;">
                    <div class="fileinput-new thumbnail" style="width:160px;">
                        <img class="img-responsive" src="/images/<?php echo e(($user->image)? 'profile/'.$user->image : 'avatar.png'); ?>" alt="">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn-round btn-rose btn-file btn-small">
                            <span class="fileinput-new">Add Photo</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="profile_image" />
                        </span>
                        <br />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('contact', 'Contact No.', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('contact', $user->contact, ['class' => 'form-control'])); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('dob', 'Date of Birth', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('dob', $user->dob, ['class' => 'form-control datepicker'])); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('job_title', 'Designation', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('job_title', $user->job_title, ['class' => 'form-control'])); ?>

                </div>
            </div>
        </div>
        <?php if($admin->user_role == 'ADMIN'): ?>
        <a href="/admin/password/<?php echo e($user->id); ?>/edit" class="btn btn-warning pull-left">Change Password</a>
        <?php endif; ?>
        <button type="submit" class="btn btn-rose pull-right">Update User</button>
<?php echo Form::close(); ?>


        <div class="clearfix"></div>
        

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/edit_admin.blade.php ENDPATH**/ ?>