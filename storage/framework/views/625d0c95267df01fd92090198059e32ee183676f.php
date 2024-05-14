<?php $__env->startSection('title', 'Payment Receive'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Payment For <b><?php echo e($service->full_name.' - '.$service->username); ?></b></h4>

                    <?php echo Form::open(['route' => 'payment.store', 'method' => 'POST', 'id' => 'RegisterValidation', 'name' => 'payment', ]); ?>

                    <input type="hidden" name="service_id" value="<?php echo e($service->id); ?>">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group label-floating">
                                <div class="form-selct">
                                    <?php echo e(Form::label('payment_method', 'Payment Method (*)', ['class' => 'control-label'])); ?>

                                    <select name="payment_method" class="form-control border-input" id="hide_ctrl" required>
                                        <option value=""></option>
                                        <?php $__currentLoopData = $paymethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($paymethod->id); ?>"><?php echo e($paymethod->payment_system); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            

                            
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('received_amount', 'Received Amount (*)', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('received_amount', $service->amount, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating hide_field">
                                <?php echo e(Form::label('account_number', 'Account Number', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('account_number', null, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('reference_number', 'Reference Number (Ref.)', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('reference_number', $service->username, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating hide_field">
                                <?php echo e(Form::label('trxid', 'Transaction ID (TrxID)', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('trxid', null, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('receive_date', 'Receive Date(Y-m-d) (*)', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::date('receive_date', date('Y-m-d'), ['class' => 'form-control border-input'])); ?>

                                <small style="color:red">Double check receive date!</small>
                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('billing_month', 'Billing Month(Y-m) (*)', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('billing_month', $billing_date, ['class' => 'form-control border-input', 'required' => ''])); ?>

                                <small style="color:red">Double check billing month!</small>
                            </div>

                            
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('details', 'Details', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::textarea('details', null, ['class' => 'form-control border-input', 'rows' => '2'])); ?>

                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-fill pull-right"><i class="material-icons">save</i> Save</button> 
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

    //form data confirmation
    // function validateForm(){
    //     var form = document.forms['payment'];
    //     if(form['receive_date'].value == moment().format("YYYY-MM-DD")){
    //         //
    //     }
    // }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/billings/create_payment.blade.php ENDPATH**/ ?>