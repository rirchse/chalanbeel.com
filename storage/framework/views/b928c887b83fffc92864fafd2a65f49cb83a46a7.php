<?php $__env->startSection('title', 'Create Payment'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">dvr</i>
            </div>
            <div class="card-content">
                <div class="col-md-8">
                    <h4 class="card-title">Package Details</h4>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <style type="text/css">
                        .package-table tr td{padding: 5px!important}
                        </style>
                        <table class="package-table table table-bordered">
                            <tr>
                                <td>Package</td>
                                <td><?php echo e($service->service); ?></td>
                            </tr>
                            <tr>
                                <td>Speed</td>
                                <td><?php echo e($service->speed.'bps'); ?></td>
                            </tr>
                            <tr>
                                <td>Time Limit </td>
                                <td><?php echo e($service->time_limit); ?></td>
                            </tr>
                            <tr>
                                <td>Price </td>
                                <td><?php echo e($service->price); ?> taka</td>
                            </tr>
                            <tr>
                                <td>VAT </td>
                                <td>0%</td>
                            </tr>
                            <tr>
                                <td>Discount </td>
                                <td><span>0</span>%</td>
                            </tr>
                            <tr>
                                <td>Total Price </td>
                                <td><b><span><?php echo e($service->price); ?></span></b> taka</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            
            <?php echo Form::open(['route' => 'user.create.payment', 'method' => 'POST', 'id' => 'RegisterValidation']); ?>

                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Create Payment</h4>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('payment_method', 'Payment Type', ['class' => 'control-label'])); ?>

                            <select name="payment_method" class="form-control">
                                <option value=""></option>
                                <option value="bKash">bKash</option>
                                <option value="Sure Cash">Sure Cash</option>
                                <option value="Rocket">Rocket</option>
                            </select>
                            <input type="hidden" value="<?php echo e($service->service_id); ?>" name="service_id">
                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('transaction_id', 'Transaction ID', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('transaction_id', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('account_number', 'Transacted Mobile Number', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('account_number', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('paid_amount', 'Paid Amount', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('paid_amount', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-rose btn-fill pull-right">Submit</button>
                    </div>
                    
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/users/create_payment.blade.php ENDPATH**/ ?>