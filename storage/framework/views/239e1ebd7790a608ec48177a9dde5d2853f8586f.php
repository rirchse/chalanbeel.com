<?php $__env->startSection('title', 'Device Details'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content" style="">
                <div class="col-md-5">
                    <h4 class="card-title">Device Details</h4>
                </div>
                <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="text-info" title="Add New Device" href="/admin/device/create"><i class="material-icons">add</i></a>
                        <a class="text-success" title="View Devices" href="/admin/device"><i class="material-icons">assignment</i></a>
                        <a class="text-warning" title="Edit" href="/admin/device/<?php echo e($device->id); ?>/edit"><i class="material-icons">edit</i></a>
                        <?php if(count(App\Device::where('parent_id', $device->id)->get()) > 0): ?>
                        <a href="/admin/device/<?php echo e($device->id); ?>/childs" class="text-primary" title="View Child Devices"><i class="material-icons">assignment</i></a>
                        <?php endif; ?>
                        <?php if($device->parent_id): ?>
                        <a class="text-info" title="Parent Device" href="/admin/device/<?php echo e($device->parent_id); ?>"><i class="material-icons">assignment</i></a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-content">
                            <div class="table-responsive table-space">
                                <table class="table table-bordered table-space">
                                        <tbody>
                                            <tr>
                                                <th>Device Name</th>
                                                <td><?php echo e($device->device_name); ?></td>
                                            </tr>
                                            <?php if($device->parent_id): ?>
                                            <tr>
                                                <th>Parent Device</th>
                                                <th><?php echo e(App\Device::find($device->parent_id)->device_name); ?><br><?php echo e(App\Device::find($device->parent_id)->mac); ?><br><?php echo e(App\Device::find($device->parent_id)->ip); ?></th>
                                            </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td>IP Address</td>
                                                <td><?php echo e($device->ip); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td><?php echo e($device->username); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td><?php echo e($device->password); ?></td>
                                            </tr>
                                            <tr>
                                                <td>MAC Address</td>
                                                <td><?php echo e($device->mac); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Model No.</td>
                                                <td><?php echo e($device->model_no); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Device Mode</td>
                                                <td><?php echo e($device->wireless_mode); ?></td>
                                            </tr>
                                            <tr>
                                                <td>SSID</td>
                                                <td><?php echo e($device->ssid); ?></td>
                                            </tr>
                                            <tr>
                                                <td>security</td>
                                                <td><?php echo e($device->security); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td><?php echo e($device->status); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Created By</td>
                                                <td><?php echo e($device->first_name.' '.$device->last_name); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Created On</td>
                                                <td><?php echo e($device->created_at); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Config File</td>
                                                <td>
                                                    <?php if($device->config_file): ?>
                                                    <a href="/uploads/configs/<?php echo e($device->config_file); ?>" download>Download [ <?php echo e(date('d M Y', strtotime(substr($device->config_file, 0, 6)))); ?> ]</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ScreenShot:</td>
                                                <td>
                                                    <a target="_blank" href="/uploads/device_images/<?php echo e($device->image); ?>"><img style="max-width:100px" src="/uploads/device_images/<?php echo e($device->image); ?>"></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/devices/read_device.blade.php ENDPATH**/ ?>