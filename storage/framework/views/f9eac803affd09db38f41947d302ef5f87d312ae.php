
<?php $__env->startSection('title', 'Register'); ?>
<?php $__env->startSection('content'); ?>
<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple"><i class="material-icons">phone</i></div>
                        <div class="card-content">
                            <h4 class="card-title">Contact Verification</h4>
                            <div class="col-md-12">
                                <h3>Is this you?</h3>
                                <h4>Please verify your information.</h4>
                                <div class="panel panel-danger">
                                    <div class="panel-heading"><h2><?php echo e($exuser->full_name); ?></h2></div>
                                    <div class="panel-footer"> <h2><?php echo e($exuser->contact); ?></h2></div>
                                </div>
                                
                               

                                <label><input id="terms" type="checkbox" value="Yes" onclick="showbtn(this)"> Yes, this me and I am agree to the terms and condition.</label>

                                <?php echo Form::model($exuser, ['route' => ['register.sendsms', $exuser->remember_token], 'method' => 'PUT']); ?>

                                <div class="form-group">
                                    <a class="btn btn-warning" href="/package/<?php echo e(Session::get('_package_id')?Session::get('_package_id'):''); ?>/select">No, this is not me.</a>
                                    <?php if($exuser): ?>
                                    <a class="btn btn-success pull-right" href="/package/<?php echo e($exuser->id); ?>" id="sndbtn">Next</a>
                                    <?php else: ?>
                                    <input class="btn btn-success pull-right" type="submit" value="Next" id="sndbtn" disabled>
                                    <?php endif; ?>
                                </div>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div>
            </div> <!--/row-->
        </div> <!--/container-->
    </div> <!--/content-->
</div> <!--/full-page-->

<script type="text/javascript">

function showbtn(elm){
    var sndbtn = document.getElementById('sndbtn');
    if(elm.checked){
        sndbtn.removeAttribute('disabled');
    } else {
        sndbtn.setAttribute('disabled', 'disabled');
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/homes/register-confirm.blade.php ENDPATH**/ ?>