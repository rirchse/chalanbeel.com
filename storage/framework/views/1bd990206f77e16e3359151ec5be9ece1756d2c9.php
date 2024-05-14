<?php $__env->startSection('title', 'Edit Payment Receive'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Edit Payment</h4>
                    <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="text-success" title="View Paid Bills" href="/admin/bill/paid/view"><i class="material-icons">assignment</i></a>
                        <a class="text-primary" title="View Due Bills" href="/admin/bill/due/view"><i class="material-icons">assignment</i></a>
                        <a class="text-info" title="View Details" href="/admin/payment/<?php echo e($payment->id); ?>"><i class="material-icons">dvr</i></a>
                        <a class="text-info" title="View Paid Bills of" href="/admin/payment/<?php echo e($payment->service_id); ?>/total_paid"><i class="material-icons">subject</i></a>
                        <a class="btn-simple btn-icon text-warning" title="View Due Bills of" href="/admin/payment/<?php echo e($payment->service_id); ?>/total_due"><i class="material-icons">subject</i></a>
                    </div>
                </div>
                    

                    <?php echo Form::model($payment, ['route' => ['payment.update', $payment->id], 'method' => 'PUT', 'id' => 'RegisterValidation']); ?>

                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group label-floating">
                                <div class="form-selct">
                                    <?php echo e(Form::label('payment_method', 'Payment Method', ['class' => 'control-label'])); ?>

                                    <select name="payment_method" class="form-control border-input" id="hide_ctrl">
                                        <option value=""></option>
                                        <?php $__currentLoopData = $paymethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($paymethod->id); ?>" <?php echo e($paymethod->id == $payment->paymethod_id? 'selected':''); ?>><?php echo e($paymethod->payment_system); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group label-floating">
                                <select name="service_id" id="" class="form-control">
                                    <option value="">Service</option>
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($service->id); ?>" <?php echo e($service->id == $payment->service_id? 'selected':''); ?>><?php echo e($service->contact.' - '.$service->full_name.' :: '.$service->speed.' - '.$service->connection); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('received_amount', 'Received Amount', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('received_amount', $payment->receive, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating hide_field">
                                <?php echo e(Form::label('account_number', 'Account Number', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('account_number', $payment->account_no, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating hide_field">
                                <?php echo e(Form::label('reference_number', 'Reference Number (Ref.)', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('reference_number', $payment->refer_no, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating hide_field">
                                <?php echo e(Form::label('trxid', 'Transaction ID (TrxID)', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('trxid', $payment->trxid, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('receive_date', 'Receive Date(Y-m-d)', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('receive_date', $payment->receive_date, ['class' => 'form-control border-input'])); ?>

                                <small style="color:red">Double check receive date!</small>
                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('billing_month', 'Billing Month(Y-m)', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('billing_month', $payment->billing_month, ['class' => 'form-control border-input'])); ?>

                                <small style="color:red">Double check billing month!</small>
                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('detail', 'Details', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::textarea('detail', $payment->details, ['class' => 'form-control border-input', 'rows' => '2'])); ?>

                            </div>

                        </div>
                    </div>
                    <a href="/admin/payment/<?php echo e($payment->id); ?>/delete" class="btn btn-simple btn-danger btn-icon" title="Delete this item." onclick="return confirm('Are you sure you want to delete this item?')"><i class="material-icons">delete</i></a>
                    <button type="submit" class="btn btn-rose btn-fill pull-right">Update</button> 
                    <?php echo Form::close(); ?>

                                     
                </div>
            </div>
        </div>
    </div><!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
    var hide_field = document.getElementsByClassName('hide_field');
    var hide_ctrl = document.getElementById('hide_ctrl');
    hide_ctrl.addEventListener('change', change);
    function change(){
        if(hide_ctrl.options[hide_ctrl.selectedIndex].innerHTML == 'Cash') {
            for(var x = 0; x < hide_field.length; x++){
                hide_field[x].style.display = 'none';
            }
        } else {
            for(var x = 0; x < hide_field.length; x++){
                hide_field[x].style.display = 'block';
            }
        }
    }
    change();
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/billings/edit_payment.blade.php ENDPATH**/ ?>