<?php $__env->startSection('title', 'View Unpaid Users'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Unpaid Services</h4>
                <div class="toolbar">
                    
                    <a href="/admin/print_unpaid_services"><i class="material-icons">print</i> Print</a>
                </div>
                <div class="material-datatables" id="table" width="8.5in">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Location</th>
                                <th>Last Pay at</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Location</th>
                                <th>Last Pay at</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 0; ?>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $r ++; ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($service->full_name); ?></td>
                                <td><?php echo e($service->contact); ?></td>
                                <td><?php echo e($service->email); ?></td>
                                <td><?php echo e($service->station); ?></td>
                                <td><?php echo e($service->last_pay_at); ?></td>
                                <td>
                                    <?php if($service->status == 1): ?>
                                    <i class="material-icons text-success">check</i>
                                    <?php else: ?>
                                    <i class="material-icons text-warning">close</i>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <a href="/admin/service/<?php echo e($service->id); ?>/details" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/service/<?php echo e($service->id); ?>/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the record"><i class="material-icons">mode_edit</i></a>
                                </td>
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row -->

<script type="text/javascript">
    function printDiv() {
        var divToPrint = document.getElementById('table');
        var htmlToPrint = '' +
            '<style type="text/css">' +
            '.pageheader{font-size:14px}'+
            'table { border-collapse:collapse; font-size:16px; width:100%}' +
            'table th, table td { border:1px solid #666; padding: 5px;font-size:22px}' +
            '</style>';
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }
    // setTimeout(function(){
    //     printDiv();
    // }, 1000);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/services/view_unpaid_services.blade.php ENDPATH**/ ?>