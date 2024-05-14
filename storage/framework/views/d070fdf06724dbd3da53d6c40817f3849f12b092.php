<?php $__env->startSection('title', 'View Areas'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Areas</h4>
                <div class="toolbar" style="text-align:right">
                    <a class="btn btn-success btn-xs" href="/admin/add_new_area" title="Add New area"><i class="material-icons">add</i></a>
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Station</th>
                                <th>Area</th>
                                <th>Village</th>
                                <th>Contact</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Station</th>
                                <th>Area</th>
                                <th>Village</th>
                                <th>Contact</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 0; $total_amount = 0; ?>

                            <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($area->station); ?></td>
                                <td><?php echo e($area->area); ?></a></td>
                                <td><?php echo e($area->village); ?></td>
                                <td><?php echo e($area->contact); ?></td>
                                <td class="text-right">
                                    <a href="/admin/area_details/<?php echo e($area->id); ?>" class="text-info"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/edit_area/<?php echo e($area->id); ?>/edit" class="text-warning" title="Edit the record"><i class="material-icons">edit</i></a>
                                </td>
                            </tr>

                            <?php $total_amount += $area->amount; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>

                            <tr>
                                <th colspan="3"></th>
                                <th>Total = </th>
                                <th>&#2547;<?php echo e($total_amount); ?></th>
                                <th colspan="2"></th>
                            </tr>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/locations/view_areas.blade.php ENDPATH**/ ?>