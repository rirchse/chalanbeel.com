<?php $__env->startSection('title', 'Create Payment'); ?>
<?php $__env->startSection('content'); ?>

<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
                <div class="col-md-12">
            <div class="card">

            <?php echo Form::open(['route' => 'user.create.payment', 'method' => 'POST', 'id' => 'RegisterValidation']); ?>

                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">subject</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10"><h4 class="card-title">Create Payment</h4></div>
                    <div class="col-md-12">
                        <h4>You have choosen the package:<br> <b><?php echo e($user->service); ?></b> by <b><?php echo e($user->connection); ?></b> connection speed <b><?php echo e($user->speed); ?></b> for <b><?php echo e($user->time_limit); ?></b> price <b><?php echo e($user->price); ?></b> taka for the location <b><?php echo e($user->station); ?></b></h4>
                        <h5>Please use the reference number  <?php echo e($user->reference); ?>at the payment
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('bol_no', 'BOL Number', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('bol_no', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('containers', 'Total Containers', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('containers', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('weight', 'Total Weight', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('weight', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">

                            <?php echo e(Form::label('vessel', 'Vessel', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('vessel', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        
                        <div class="form-group label-floating">

                            <?php echo e(Form::label('cross_dock_no', 'Cross Dock Number', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('cross_dock_no', null, ['class' => 'form-control border-input'])); ?>

                        </div>

                        <div class="form-group label-floating">
                            <?php echo e(Form::label('detail', 'Notes', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::textarea('detail', null, ['class' => 'form-control border-input', 'rows' => '7'])); ?>

                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-rose btn-fill pull-right">Confirm BOL</button>
                </div>
            </div>
            </div>
        </div><!-- container -->
            <?php echo Form::close(); ?>


        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/homes/create_payment.blade.php ENDPATH**/ ?>