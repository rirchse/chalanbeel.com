<?php $__env->startSection('title', 'Add New Service'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            <?php echo Form::open(['route' => 'user.create.service', 'method' => 'POST', 'id' => 'RegisterValidation']); ?>

                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Add New Service</h4>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('service', 'Service:', ['class' => 'control-label'])); ?>

                            <select name="service" id="" class="form-control">
                                <?php $__currentLoopData = DB::table('packages')->groupBy('service')->select('service')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($service->service); ?>"><?php echo e($service->service); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('connection', 'Connection:', ['class' => 'control-label'])); ?>

                            <select name="connection" id="" class="form-control">
                                <option value=""></option>
                                <?php $__currentLoopData = DB::table('packages')->groupBy('connection')->select('connection')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($service->connection); ?>"><?php echo e($service->connection); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('speed', 'Speed:', ['class' => 'control-label'])); ?>

                            <select name="speed" id="" class="form-control">
                                <option value=""></option>
                                <?php $__currentLoopData = DB::table('packages')->groupBy('speed')->select('speed')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($service->speed); ?>"><?php echo e($service->speed); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('time_limit', 'Time Limit:', ['class' => 'control-label'])); ?>

                            <select name="time_limit" id="" class="form-control">
                                <option value=""></option>
                                <?php $__currentLoopData = DB::table('packages')->groupBy('time_limit')->select('time_limit')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($service->time_limit); ?>"><?php echo e($service->time_limit); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('area', 'Location:', ['class' => 'control-label'])); ?>

                            <select name="area" id="area" class="form-control">
                                <option value=""></option>
                                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($area->id); ?>"><?php echo e($area->station); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('device', 'User Device', ['class' => 'control-label'])); ?>

                            <select name="device" class="form-control">
                                <option value=""></option>
                                <option value="Computer">Computer</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Router">Router</option>
                                <option value="Wireless Router">Wireless Router</option>
                                <option value="Mobile Wifi">Mobile Wifi</option>
                                <option value="Smart TV">Smart TV</option>
                                <option value="Smart TV Box">Smart TV Box</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('mac', 'MAC Address', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('mac', null, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('left_long', 'Latitude Longitude.', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('left_long', null, ['class' => 'form-control border-input'])); ?>

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
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/users/create_service.blade.php ENDPATH**/ ?>