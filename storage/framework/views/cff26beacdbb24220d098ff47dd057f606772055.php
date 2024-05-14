<?php $__env->startSection('title', 'View Active Services'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Active Services</h4>
                <div class="toolbar" style="text-align:right">
                    <a class="btn btn-info btn-xs" href="/admin/view_active_services" title="View Active Service"><i class="material-icons">subject</i></a>
                    <a class="btn btn-success btn-xs" href="/admin/view_active_users" title="Add New Service"><i class="material-icons">add</i></a>
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                    
                    
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Bill</th>
                                <th>Billing Date</th>
                                <th>Last Pay At</th>
                                <th>Payable</th>
                                <th>Username</th>
                                <th>Location</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Bill</th>
                                <th>Billing Date</th>
                                <th>Last Pay At</th>
                                <th>Payable</th>
                                <th>Username</th>
                                <th>Location</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $r = 0;
                            $total_amount = 0;
                            $total_receive = 0;
                            $remember = 0;

                            function remember($date){
                                return $remember = (strtotime(date('Y-m-d'))- strtotime($date))/24/3600;
                            }
                            ?>

                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>
                                    <?php
                                    if($service->last_pay_at){
                                        $remember = remember($service->last_pay_at);
                                    }else{
                                        $remember = remember($service->billing_date);
                                    }

                                    ?>

                            <tr style="background:<?php echo e($remember > 30?'#fadbd8':''); ?>">
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($service->speed .' - '.$service->time_limit); ?></td>
                                <td><?php echo e($service->amount?'&#2547;'.$service->amount:''); ?></td>
                                <td><?php echo e($service->billing_date? date('d', strtotime($service->billing_date)).date(' M Y'):''); ?></td>
                                <td><?php echo e($service->receive_date?date('d M Y', strtotime(App\Payment::where('service_id', $service->id)->orderBy('id', 'DESC')->first()->receive_date)):''); ?></td>
                                <td><?php echo e($service->receive); ?></a></td>
                                <td title="<?php echo e($service->full_name); ?>"><?php echo e($service->username); ?></a></td>
                                <td><a href="/admin/view_active_services/location/<?php echo e($service->location_id); ?>"><?php echo e($service->station); ?></td>
                                <td class="text-right">
                                    <a class="btn btn-simple btn-icon btn-info" href="/admin/service/<?php echo e($service->id); ?>/details" class="text-info"><i class="material-icons">dvr</i></a>
                                    <a class="btn btn-simple btn-icon btn-warning" href="/admin/service/<?php echo e($service->id); ?>/edit" class="text-warning" title="Edit the record"><i class="material-icons">edit</i></a>
                                    <a href="/admin/payment/<?php echo e($service->id); ?>/add" class="btn btn-simple btn-success btn-icon" title="Add Payment"><i class="material-icons">payment</i></a>
                                </td>
                            </tr>

                            <?php 

                            $total_amount += $service->amount;
                            $total_receive += $service->receive;

                            ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                            <tr>
                                <th colspan="2">Total = </th>
                                <th>&#2547;<?php echo e($total_amount); ?></th>
                                <th colspan="2"></th>
                                <th>&#2547;<?php echo e($total_receive); ?></th>
                                <th colspan="4"></th>
                            </tr>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/services/view_active_services.blade.php ENDPATH**/ ?>