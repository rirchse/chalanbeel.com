<?php $__env->startSection('title', 'Add Package'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-10">
        <div class="card">

            <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-6">
                        <h4 class="card-title">Create Package</h4>
                    </div>

                    <?php echo Form::open(['route' => 'package.store', 'method' => 'POST', 'id' => 'RegisterValidation']); ?>


                    <div class="row">
                        <div class=" col-md-6">
                            <div class="form-group label-floating">                                
                                <?php echo e(Form::label('service', 'Service Name', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::select('service', [ ''=>'', 'Internet' => 'Internet', 'Software' => 'Software'], null, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">                                
                                <?php echo e(Form::label('connection', 'Connection Mode', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::select('connection', [ ''=>'', 'Cable' => 'Cable', 'WiFi' => 'WiFi'], null, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">                                
                                <?php echo e(Form::label('speed', 'Speed [example: 1MB]', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::text('speed', null, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">                                
                                <?php echo e(Form::label('time_limit', 'Time Limit', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::select('time_limit', [ ''=>'', '1Day' => '1Day', '5Days' => '5Days', '10Days' => '10Days', '30Days' => '30Days'], null, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">                                
                                <?php echo e(Form::label('price', 'Price', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::number('price', null, ['class' => 'form-control border-input'])); ?>

                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group label-floating">                                
                                <?php echo e(Form::label('discount', 'Discount', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::number('discount', null, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <label>Status:</label><br>
                                <input type="radio" name="status" value="1"> Active &nbsp; 
                                <input type="radio" name="status" value="0"> Inactive
                            </div>
                            <div class="form-group label-floating">                                
                                <?php echo e(Form::label('details', 'Details', ['class' => 'control-label container-label'])); ?>

                                <?php echo e(Form::textarea('details', null, ['class' => 'form-control border-input', 'rows' => 6])); ?>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right"><i class="material-icons">save</i> Save</button>
                        </div>
                    </div>

                    <?php echo Form::close(); ?>

                    
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/packages/create_package.blade.php ENDPATH**/ ?>