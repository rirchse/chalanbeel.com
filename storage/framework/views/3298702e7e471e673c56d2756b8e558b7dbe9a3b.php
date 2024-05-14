<?php $__env->startSection('title', 'Add New Invest'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">edit</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Edit Invest</h4>

                <?php echo Form::model($invest, ['route' => ['invest.update', $invest->id], 'method' => 'PUT', 'id' => 'RegisterValidation']); ?>

                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="form-group label-floating">                                
                            <?php echo e(Form::label('amount', 'Invest Amount', ['class' => 'control-label container-label'])); ?>

                            <?php echo e(Form::text('amount', $invest->amount, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('date', 'Invest Date', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('date', $invest->date, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('whats_for', 'What\'s for', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('whats_for', $invest->whats_for, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('vendor', 'Vendor Name', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('vendor', $invest->vendor, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('details', 'Details', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::textarea('details', $invest->details, ['class' => 'form-control border-input', 'rows' => '3'])); ?>

                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-rose btn-fill pull-right">Update</button> 
                <?php echo Form::close(); ?>

                                 
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
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/invests/edit_invest.blade.php ENDPATH**/ ?>