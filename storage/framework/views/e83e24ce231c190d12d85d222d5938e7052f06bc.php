<?php $__env->startSection('title', 'Add New Invest'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">add</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Add New Invest</h4>

                <?php echo Form::open(['route' => 'invest.store', 'method' => 'POST', 'id' => 'RegisterValidation']); ?>

                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="form-group label-floating">                                
                            <?php echo e(Form::label('amount', 'Invest Amount', ['class' => 'control-label container-label'])); ?>

                            <?php echo e(Form::text('amount', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="col-md-4" style="padding-left:0">
                            <div class="form-group label-floating">
                                <select name="day" id="" class="form-control">
                                    <option value="">Day</option>
                                    <?php for($x = 1; $x <= 31; $x++): ?>
                                    <option value="<?php echo e($x); ?>"><?php echo e($x); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <select name="month" id="" class="form-control">
                                    <option value="">Month</option>
                                    <?php for($x = 1; $x <= 12; $x++): ?>
                                    <option value="<?php echo e($x); ?>"><?php echo e($x); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-right:0">
                            <div class="form-group label-floating">
                                <select name="year" id="" class="form-control">
                                    <option value="">Year</option>
                                    <?php for($x = date('Y'); $x >= 2016 ; $x--): ?>
                                    <option value="<?php echo e($x); ?>"><?php echo e($x); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('whats_for', 'What\'s for', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('whats_for', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('vendor', 'Vendor Name', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('vendor', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('details', 'Details', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::textarea('details', null, ['class' => 'form-control border-input', 'rows' => '3'])); ?>

                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-rose btn-fill pull-right">ADD</button> 
                <?php echo Form::close(); ?>

                                 
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">list</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Recent Invests</h4>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>What's For</th>
                            <th>Vendor</th>
                            <th>Details</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        <tbody>
                            <?php $r = 0; $total_amount = 0; ?>

                            <?php $__currentLoopData = $invests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td>&#2547;<?php echo e($invest->amount); ?></td>
                                <td title="<?php echo e(date('H:i:s', strtotime($invest->billing_date))); ?>"><?php echo e(date('d M Y', strtotime($invest->date))); ?></td>
                                <td><?php echo e($invest->whats_for); ?></td>
                                <td><?php echo e($invest->vendor); ?></a></td>
                                <td><?php echo e($invest->details); ?></td>
                                <td class="text-right">
                                    <a href="/admin/invest/<?php echo e($invest->id); ?>/edit" class="text-warning btn-simple" title="Edit the record"><i class="material-icons">edit</i></a>
                                </td>
                            </tr>

                            <?php $total_amount += $invest->amount; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <tr><th colspan="7"><a href="/admin/view_invests">View More...</a></th></tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- end row -->
<script type="text/javascript">
    $(document).ready(function() {
        md.initSliders()
        demo.initFormExtendedDatetimepickers();
    });
</script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/invests/create_invest.blade.php ENDPATH**/ ?>