
<?php $__env->startSection('title', 'User Profile'); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Create New Users</h4>

    <?php echo Form::open(['route' => 'user.store', 'method' => 'POST', 'files' => true]); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <?php echo e(Form::select('user_type', ['' => '--------- Select One -------', 'user' => 'User', 'admin' => 'Admin'], null, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('first_name', 'First Name:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('first_name', null, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('last_name', 'Last Name:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('last_name', null, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('email', 'Email Address:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::email('email', null, ['class' => 'form-control'])); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="fileinput fileinput-new text-center pull-right" data-provides="fileinput" style="width:250px;">
                    <div class="fileinput-new thumbnail" style="width:160px;">
                        <img class="img-responsive" src="/images/avatar.png" alt="">
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
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('password', 'Password', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::password('password', ['class' => 'form-control'])); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('password_confirmation', 'Confirm Password', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::password('password_confirmation', ['class' => 'form-control'])); ?>

                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('contact', 'Contact No.', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('contact', null, ['class' => 'form-control'])); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('dob', 'Date of Birth', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::date('dob', null, ['class' => 'form-control datepicker'])); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('job_title', 'Designation', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('job_title', null, ['class' => 'form-control'])); ?>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-rose pull-right">Create User</button>
        <div class="clearfix"></div>
    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/users/create_new_user.blade.php ENDPATH**/ ?>