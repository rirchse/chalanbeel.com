<?php $__env->startSection('title', 'Showing Services'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Your Offers</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="com-md-12">
                    <?php if(Auth::user()->status == 0): ?>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title"><h2>1Day Free Package</h2></h3>
                      </div>
                      <div class="panel-body"> 
                        <form action="<?php echo e(route('user.requestOffer')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <textarea class="form-control" name="details" placeholder="Please write down here why you want to do this?" required rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning btn-lg btn-right">Get Package</button>
                        </form>
                            
                      </div>
                    </div>
                    <?php else: ?>
                    <h2>Stay connect... We will offer you very soon. Thank you <a class="btn btn-warning" href="/view_packages">Get Internet</a></h2>
                    <?php endif; ?>
                </div>
                <!--
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Connection</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Connection</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 1; ?>

                            <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($service->service); ?></td>
                                <td><?php echo e($service->connection); ?></td>
                                <td><?php echo e($service->speed); ?></td>
                                <td><?php echo e($service->time_limit); ?></td>
                                <td><?php echo e($service->price); ?></td>
                                <td><?php echo e($service->discount); ?></td>
                                <td>
                                    <?php if($service->service_status == 0): ?>
                                    <span style="color:#d00">Unpaid
                                    <?php elseif($service->service_status == 1): ?>
                                    <span style="color:#0d0">Paid
                                    <?php endif; ?>
                                </td>
                                <td title="<?php echo e(date('H:i:s', strtotime($service->created_at))); ?>"><?php echo e(date('d M Y', strtotime($service->created_at))); ?></td>
                                <td class="text-right">
                                    <a href="/service/<?php echo e($service->id); ?>/edit" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a>
                                    <a href="/service/<?php echo e($service->id); ?>/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the record"><i class="material-icons">mode_edit</i></a>
                                </td>
                            </tr>
                            <?php $r++; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </tbody>
                    </table>
                </div>
            -->
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/users/view_offers.blade.php ENDPATH**/ ?>