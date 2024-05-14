
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
                    <h4 class="card-title">Customer Registration</h4>

    <?php echo Form::open(['route' => 'check.payment', 'method' => 'POST', 'files' => true, 'id' => 'RegisterValidation']); ?>

    <!--form ng-submit="register()"-->
        <div class="row">
            <div class="col-md-12">
                <h4>Payment <span style="color:#f00;font-weight:bold;float:right"><img src="/images/icons/bkash.png" style="width:120px"> 016 21 57 55 17</span></h4>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('payment_method', '--- Payment Method ---', ['class' => 'control-label'])); ?>

                    <select name="payment_method" class="form-control border-input">
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($paymethod->id); ?>"><b><?php echo e($paymethod->payment_system); ?> &nbsp;&nbsp;&nbsp; - <?php echo e($paymethod->bank_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('paid_mobile_no', 'Paid Mobile Number.', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('paid_mobile_no', null, ['class' => 'form-control', 'ng-model' => 'mobile_no'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('transaction_id', 'Transaction ID (TrxID)', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('transaction_id', null, ['class' => 'form-control'])); ?>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-rose pull-right">Payment Check</button>
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
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/homes/check_payment.blade.php ENDPATH**/ ?>