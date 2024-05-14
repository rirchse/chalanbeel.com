<?php $__env->startSection('title', 'edit Payment Method'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            
            <?php echo Form::model($paymethod, ['route' => ['paymethod.update', $paymethod->id], 'method' => 'PUT', 'id' => 'RegisterValidation']); ?>

                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Edit Payment Method</h4>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('bank_name', 'Bank Name:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('bank_name', $paymethod->bank_name, ['class' => 'form-control border-input'])); ?>

                        </div>

                        <div class="form-group label-floating">
                            <?php echo e(Form::label('payment_system', 'Payment System', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('payment_system', $paymethod->payment_system, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('operator', 'Mobile Operator', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('operator', $paymethod->operator, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">

                            <?php echo e(Form::label('country_code', 'Country Code', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('country_code', $paymethod->country_code, ['class' => 'form-control border-input'])); ?>

                        </div>

                        
                    </div>

                    <div class="col-md-6">
                        
                        <div class="form-group label-floating">

                            <?php echo e(Form::label('account_no', 'Account Number:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('account_no', $paymethod->account_number, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">

                            <?php echo e(Form::label('details', 'Details', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::textarea('details', $paymethod->detail, ['class' => 'form-control border-input', 'rows' => '7'])); ?>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right"><i class="material-icons">save</i> Save</button>
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/payment_methods/edit_paymethod.blade.php ENDPATH**/ ?>