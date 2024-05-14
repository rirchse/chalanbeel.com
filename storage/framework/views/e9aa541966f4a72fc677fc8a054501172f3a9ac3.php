
<?php $__env->startSection('title', 'Register'); ?>
<?php $__env->startSection('content'); ?>
<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple"><i class="material-icons">payment</i></div>
                        <div class="card-content">
                            <h4 class="card-title">Payment</h4>
                            <div class="col-md-12">
                                <h4>Thank you for choice our services.</h4>
                                <h2><?php echo e($package->speed.'bps, '.$package->time_limit); ?></h2>
                                <h3>Your total payment: <b><?php echo e($package->price); ?>Tk.</b></h3>

                                <?php echo Form::open(['route' => 'package.store', 'method' => 'PUT']); ?>

                                <div class="form-group label-floating">
                                    <?php echo e(Form::label('bkash_mobile', 'bKash Mobile Number', ['class' => 'control-label'])); ?>

                                    <?php echo e(Form::text('bkash_mobile', null, ['class'=> 'form-control'])); ?>

                                </div>
                                <div class="form-group label-floating">
                                    <?php echo e(Form::label('trxid', 'bKash Payment TrxID', ['class' => 'control-label'])); ?>

                                    <?php echo e(Form::text('trxid', null, ['class'=> 'form-control'])); ?>

                                </div>
                                <div class="form-group">
                                    <label class="text-warning"><input id="terms" type="checkbox" value="Yes" onclick="showbtn(this)"> Yes, I have paid <b><?php echo e($package->price); ?>Tk.</b>.</label>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-success pull-right" type="submit" value="Submit" id="sndbtn" disabled>
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
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/homes/package-details.blade.php ENDPATH**/ ?>