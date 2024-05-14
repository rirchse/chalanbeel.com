<?php $__env->startSection('title', 'Add New Service'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            <?php echo Form::open(['route' => 'service.store', 'method' => 'POST', 'id' => 'RegisterValidation']); ?>

                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Add New Service for <b><?php echo e($user->full_name); ?></b></h4>
                    </div>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <style type="text/css">
                                .table td{padding: 5px!important}
                                </style>
                                <table class="table table-bordered">
                                    <tr>
                                        <th colspan="4">Selected Package</th>
                                    </tr>
                                    <tr>
                                        <td>Service</td>
                                        <td><?php echo e($package->service); ?></td>
                                        <td>Connection</td>
                                        <td><?php echo e($package->connection); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Speed</td>
                                        <td><?php echo e($package->speed); ?></td>
                                        <td>Limit</td>
                                        <td><?php echo e($package->time_limit); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <th><span id="amount"><?php echo e($package->price); ?></span> Taka</th>
                                        <td>Payable</td>
                                        <th><span id="payable">00</span> Taka</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <input type="hidden" value="<?php echo e($user->id); ?>" name="user_id">
                        <input type="hidden" value="<?php echo e($package->id); ?>" name="package_id">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('discount', 'Discount %', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('discount', $package->discount, ['class' => 'form-control border-input', 'id' => 'discount'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('amount', 'Amount', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('amount', null, ['class' => 'form-control border-input', 'id' => 'bill', 'onkeyup' => 'amountTodiscount()'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('area', 'Location:', ['class' => 'control-label'])); ?>

                            <select name="area" id="area" class="form-control" required>
                                <option value=""></option>
                                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($area->id); ?>" <?php echo e($user->location_id == $area->id? 'selected':''); ?>><?php echo e($area->station); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('billing_plan', 'Billing Plan', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::select('billing_plan', ['Prepaid' => 'Prepaid', 'Postpaid' => 'Postpaid'], null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('billing_date', 'Billing Date', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::date('billing_date', date('Y-m-d', strtotime($user->created_at)), ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('mac', 'MAC Address', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('mac', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('ip', 'IP Address', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('ip', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('left_long', 'Latitude Longitude.', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('left_long', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Information will submit to the Router</h4>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('name', 'Username:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('name', $user->contact, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('password', 'Password:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('password', $user->contact, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('service', 'Service:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('service', $package->service_mode, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('profile', 'Profile:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('profile', $package->speed, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('comment', 'Comment:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('comment', $user->full_name, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::checkbox('status', 1, null, ['class' => 'form-check-input', 'checked'=>''])); ?>

                            <?php echo e(Form::label('status', 'Active', ['class' => 'form-check-label'])); ?> &nbsp; 
                            <?php echo e(Form::checkbox('router', 1, null, ['class' => 'form-check-input', 'checked'=>''])); ?>

                            <?php echo e(Form::label('router', 'Create On Router', ['class' => 'form-check-label'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('device', 'User Device', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::textarea('device', null, ['class' => 'form-control border-input', 'rows' => 2])); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('details', 'Details:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::textarea('details', null, ['class' => 'form-control border-input', 'rows' => '2'])); ?>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right">Save</button>
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
        
    </div>

    <script type="text/javascript">
    var amount = document.getElementById('amount');
    var bill = document.getElementById('bill');
    var payable = document.getElementById('payable');
    var discount = document.getElementById('discount');
    discount.addEventListener('keyup', change);
    function change(){
        //
        var pay = Number(amount.innerHTML) - (Number(amount.innerHTML)/100*discount.value);
        payable.innerHTML = pay;
        bill.value = pay;
    }
    change();

    function amountTodiscount(){
        discount.value = bill.value/Number(amount.innerHTML)*100;
    }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/services/create_service.blade.php ENDPATH**/ ?>