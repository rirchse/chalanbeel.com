<?php $__env->startSection('title', 'Add New Area'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            <?php echo Form::open(['route' => 'location.store', 'method' => 'POST', 'id' => 'RegisterValidation']); ?>

                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Add New Area</b></h4>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('station', 'Station Name', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('station', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('area', 'Location', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('area', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('village', 'Village', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('village', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('address', 'Address', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('address', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('city', 'City', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('city', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('state', 'State', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('state', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('zip', 'ZIP Code', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('zip', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('contact', 'Contact Number', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('contact', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('detail', 'Details:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::textarea('detail', null, ['class' => 'form-control border-input', 'rows' => '2'])); ?>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right">Add</button>
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
        
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/locations/create_new_area.blade.php ENDPATH**/ ?>