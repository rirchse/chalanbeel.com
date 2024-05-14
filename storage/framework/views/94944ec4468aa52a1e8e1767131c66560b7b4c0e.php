
<?php $__env->startSection('title', 'Verify'); ?>
<?php $__env->startSection('content'); ?>
<div class="full-page login-page" filter-color="black" data-image="<?php echo e($GBURL); ?>/images/login.jpg">
    <div class="content">
        <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Customer Registration</h4>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Attension!</div>
                            <div class="panel-body">
                                <span style="color:#f00;font-size:16px;border;1px solid #ddd;">Please register with real information and double check your contact number. You have to be verify your information to complete the registration. You will get username and password by SMS to your registered mobile number when you will request for 1Day free package.</span>
                            </div>
                        </div>
                        
                    </div>
                </div>

    <?php echo Form::open(['route' => 'contact.verify', 'method' => 'PUT', 'files' => true, 'id' => 'RegisterValidation']); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('full_name', 'Your Full Name:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('full_name', null, ['class' => 'form-control', 'required' => ''])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('contact', 'Mobile Number', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('contact', null, ['class' => 'form-control', 'required' => ''])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('contact_confirmation', 'Confirm Mobile Number', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('contact_confirmation', null, ['class' => 'form-control', 'required' => ''])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('email', 'Email Address:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::email('email', null, ['class' => 'form-control', 'required' =>''])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('area', 'Location:', ['class' => 'control-label'])); ?>

                    <select name="area" id="area" class="form-control" required>
                        <option value=""></option>
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($area->id); ?>"><?php echo e($area->station); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/homes/contact-verify.blade.php ENDPATH**/ ?>