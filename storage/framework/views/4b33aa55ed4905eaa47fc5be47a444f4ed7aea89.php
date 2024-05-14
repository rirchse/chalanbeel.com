<?php $__env->startSection('title', 'Create User Payment'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Create User Payment</h4>

                    <?php echo Form::open(['route' => 'payment.store', 'method' => 'POST', 'id' => 'RegisterValidation']); ?>

                    <?php echo e(Form::hidden('cust_id', $customer->id)); ?>

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <div class="form-selct">
                                    <?php echo e(Form::label('payment_method', 'Payment Method', ['class' => 'control-label'])); ?>

                                    <select name="payment_method" class="form-control border-input">
                                        <option value=""></option>
                                        <option value="Cash">Cash</option>
                                        <?php $__currentLoopData = $paymethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($paymethod->id); ?>"><?php echo e($paymethod->payment_system); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group label-floating">                                
                                <?php echo e(Form::label('received_amount', 'Received Amount', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('received_amount', null, ['class' => 'form-control border-input'])); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating">                                
                                <?php echo e(Form::label('account_number', 'Account Number', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('account_number', null, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('trxid', 'Transaction ID (TrxID)', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('trxid', 'cbtcpay', ['class' => 'form-control border-input'])); ?>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('detail', 'Details', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::textarea('detail', null, ['class' => 'form-control border-input', 'rows' => '5'])); ?>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-rose btn-fill pull-right">Create</button> 
                    <?php echo Form::close(); ?>

                                     
                </div>
            </div>
        </div><!--main-column-8 -->
        <div class="col-md-4">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="#pablo">
                    <img src="<?php echo e($base_url); ?>/images/<?php echo e(($customer->image? $customer->image:'avatar.png')); ?>" class="img">
                </a>
            </div>

            <div class="card-body"><br>
                <h4 class="card-title"><b><?php echo e($customer->first_name.' '.$customer->last_name); ?></b></h4>
                <h6 class="card-category text-gray"></b><?php echo e($customer->contact); ?></b></h6>
                <a class="btn btn-rose btn-round" href="#pablo">details</a>
            </div>
        </div>
    </div>
    </div><!-- end row --> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/billings/create_user_payment.blade.php ENDPATH**/ ?>