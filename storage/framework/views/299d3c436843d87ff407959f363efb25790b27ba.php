<?php $__env->startSection('title', 'Edit device'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            <?php echo Form::model($device, ['route' => ['device.update', $device], 'method' => 'PUT', 'id' => 'RegisterValidation', 'files' => true]); ?>

                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Edit device</b></h4>
                    </div>
                    <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="text-info" title="Edit" href="/admin/device/<?php echo e($device->id); ?>"><i class="material-icons">dvr</i></a>
                        <a class="text-success" title="View Devices" href="/admin/device"><i class="material-icons">assignment</i></a>
                    </div>
                </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('ip', 'IP Address (*)', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('ip', $device->ip, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('mac', 'MAC Address (*)', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('mac', $device->mac, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('device_name', 'Device Name/Identity (*)', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('device_name', $device->device_name, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('model', 'Device Model/Platform (*)', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('model', $device->model_no, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('parent', 'Parent Device:', ['class' => 'control-label'])); ?>

                            <select name="parent" id="parent" class="form-control">
                                <option value=""></option>
                                <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $device->parent_id?'selected':''); ?>><?php echo e($value->device_name); ?> [<?php echo e($value->mac); ?> / <?php echo e($value->ip); ?>]</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('location', 'Location:', ['class' => 'control-label'])); ?>

                            <select name="location" id="location" class="form-control">
                                <option value=""></option>
                                <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($location->id); ?>" <?php echo e($location->id == $device->location_id?'selected':''); ?>><?php echo e($location->station); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('username', 'Username', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('username', $device->username, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('password', 'Password', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('password', $device->password, ['class' => 'form-control border-input'])); ?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('brand', 'Device Brand', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('brand', $device->brand, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('wireless_mode', 'Wireless Mode', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::select('wireless_mode', [''=>'', 'AccessPoint'=>'AccessPoint', 'Station'=>'Station', 'Repeater'=>'Repeater'], $device->wireless_mode, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('ssid', 'SSID', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('ssid', $device->ssid, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('security', 'SSID Security', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('security', $device->security, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('frequency', 'Frequency', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::text('frequency', $device->frequency, ['class' => 'form-control border-input'])); ?>

                        </div>
                        <div class="" style="border-bottom:1px solid #ddd;">
                            <?php echo e(Form::label('config_file', 'Upload Configuration File:')); ?>

                            <?php echo e(Form::file('config_file')); ?>

                        </div><br>
                        <div class="" style="border-bottom:1px solid #ddd;">
                            <?php echo e(Form::label('image', 'Upload ScreenShot:')); ?>

                            <?php echo e(Form::file('image')); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <?php echo e(Form::label('detail', 'Details:', ['class' => 'control-label'])); ?>

                            <?php echo e(Form::textarea('detail', $device->details, ['class' => 'form-control border-input', 'rows' => '2'])); ?>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right">update</button>
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
        
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/devices/edit_device.blade.php ENDPATH**/ ?>