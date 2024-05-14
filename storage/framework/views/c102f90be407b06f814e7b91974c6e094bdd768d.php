<?php $__env->startSection('title', 'Add Payment Method'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            
            <?php echo Form::open(['route' => 'paymethod.store', 'method' => 'POST', 'id' => 'RegisterValidation']); ?>

                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Create Payment Method</h4>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('bank_name', 'Bank Name:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('bank_name', null, ['class' => 'form-control border-input'])); ?>

                        </div>

                        <div class="form-group label-floating">
                            <?php echo e(Form::label('payment_system', 'Payment System', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::select('payment_system', [''=>'', 'Cash'=>'Cash', 'bKash'=>'bKash', 'Rocket'=>'Rocket', 'Sure Cash'=>'Sure Cash'], null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('operator', 'Mobile Operator', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('operator', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">

                            <?php echo e(Form::label('country_code', 'Country Code', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('country_code', null, ['class' => 'form-control border-input'])); ?>

                        </div>

                        
                    </div>

                    <div class="col-md-6">
                        
                        <div class="form-group label-floating">

                            <?php echo e(Form::label('account_no', 'Account Number:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('account_no', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">

                            <?php echo e(Form::label('detail', 'Details', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::textarea('detail', null, ['class' => 'form-control border-input', 'rows' => '7'])); ?>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right">Create Payment Method</button>
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/payment_methods/create_paymethod.blade.php ENDPATH**/ ?>