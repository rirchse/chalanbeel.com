<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('content'); ?>

<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                    <form role="form" method="POST" action="<?php echo e(route('user.login')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="card card-login card-hidden">
                            <div class="card-header text-center" data-background-color="purple">
                                <h4 class="card-title">User Login</h4>
                            </div>
                            
                            <div class="card-content">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">phone</i>
                                    </span>
                                    <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?> label-floating">
                                        <label class="control-label">Mobile Number</label>
                                        <input type="text" class="form-control" name="email" autofocus value="<?php echo e(old('email')); ?>"/>
                                        <?php if($errors->has('email')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> label-floating">
                                        <label class="control-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                        <?php if($errors->has('password')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align:right">
                                <div class="col-md-12"><a href="#">Forgot your password?</a></div>
                            </div>
                            
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/homes/login.blade.php ENDPATH**/ ?>