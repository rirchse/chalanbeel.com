<?php $__env->startSection('title', 'View Devices'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Devices</h4>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Device Name</th>
                                <th>IP Address</th>
                                <th>User/Pass</th>
                                <th>Frequency</th>
                                <th>Location</th>
                                <th>MAC Address</th>
                                <th>Device Model</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Device Name</th>
                                <th>IP Address</th>
                                <th>User/Pass</th>
                                <th>Frequency</th>
                                <th>Location</th>
                                <th>MAC Address</th>
                                <th>Device Model</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 0;?>

                            <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>

                            <tr>
                                <td><?php echo e($device->device_name); ?></td>
                                <td><a target="_blank" href="http://<?php echo e($device->ip); ?>"><?php echo e($device->ip); ?></a></td>
                                <td value="<?php echo e($device->username.'/'.$device->password); ?>" onclick="showPassword(this);">*****</td>
                                <td><?php echo e($device->frequency); ?></td>
                                <td><?php echo e($device->station); ?></td>
                                <td><?php echo e($device->mac); ?></a></td>
                                <td><?php echo e($device->model_no); ?></td>
                                <td class="text-right">
                                    <a href="/admin/device/<?php echo e($device->id); ?>" class="text-info"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/device/<?php echo e($device->id); ?>/edit" class="text-warning" title="Edit the record"><i class="material-icons">edit</i></a>
                                    <?php if(count(App\Device::where('parent_id', $device->id)->get()) > 0): ?>
                                    <a href="/admin/device/<?php echo e($device->id); ?>/childs" class="text-success" title="View Child Devices"><i class="material-icons">assignment</i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row -->
<script type="text/javascript"> function showPassword(element){if(element.innerHTML != '*****'){element.innerHTML = '*****'; }else{ element.innerHTML=element.getAttribute('value'); }}</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/devices/view_devices.blade.php ENDPATH**/ ?>