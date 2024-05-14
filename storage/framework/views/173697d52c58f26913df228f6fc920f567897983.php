
<?php $__env->startSection('title', 'Register'); ?>
<?php $__env->startSection('content'); ?>
<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">edit</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Register User</h4>

                        <?php echo Form::open(['route' => 'package.store', 'method' => 'POST', 'files' => true, 'id' => 'RegisterValidation']); ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <?php echo e(Form::label('full_name', 'Your Full Name:', ['class' => 'control-label'])); ?>

                                        <?php echo e(Form::text('full_name', null, ['class' => 'form-control'])); ?>

                                    </div>
                                    <div class="form-group label-floating">
                                        <?php echo e(Form::label('contact', 'Mobile Number', ['class' => 'control-label'])); ?>

                                        <?php echo e(Form::text('contact', null, ['class' => 'form-control'])); ?>

                                    </div>
                                    <div class="form-group label-floating">
                                        <?php echo e(Form::label('contact_confirmation', 'Confirm Mobile Number', ['class' => 'control-label'])); ?>

                                        <?php echo e(Form::text('contact_confirmation', null, ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Next</button>
                            <div class="clearfix"></div>
                        <!--/form-->
                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/homes/register-user.blade.php ENDPATH**/ ?>