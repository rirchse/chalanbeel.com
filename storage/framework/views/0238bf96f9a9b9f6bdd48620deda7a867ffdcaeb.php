<?php $__env->startSection('title', 'Showing all Payment Method'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Paymethod</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Bank Name</th>
                                <th>Payment System</th>
                                <th>Operator</th>
                                <th>Country Code</th>
                                <th>Account No</th>
                                <th>Creation Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Bank Name</th>
                                <th>Payment System</th>
                                <th>Operator</th>
                                <th>Country Code</th>
                                <th>Account No</th>
                                <th>Creation Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php $r = 0; ?>

                            <?php $__currentLoopData = $paymethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $r++; ?>

                            <tr>
                                <td><a href="/admin/paymethod/<?php echo e($paymethod->id); ?>/edit"><?php echo e($paymethod->bank_name); ?></a></td>
                                <td><a href="/admin/work_order_details/<?php echo e($paymethod->payment_system); ?>"><?php echo e($paymethod->payment_system); ?></a></td>
                                <td><?php echo e($paymethod->operator); ?></td>
                                <td><?php echo e($paymethod->country_code); ?></td>
                                <td><?php echo e($paymethod->account_number); ?></td>
                                <td title="<?php echo e(date('H:i:s', strtotime($paymethod->created_at))); ?>"><?php echo e(date('m/d/Y', strtotime($paymethod->created_at))); ?></td>
                                <td class="text-right">
                                    <a href="/admin/paymethod/<?php echo e($paymethod->id); ?>/edit" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/paymethod/<?php echo e($paymethod->id); ?>/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the record"><i class="material-icons">mode_edit</i></a>

                                    <a href="#" class="btn btn-simple btn-danger btn-icon" title="Delete bil of lading!" onclick="document.getElementById('target<?php echo e($r); ?>').style.display = 'block';"><i class="material-icons">delete</i></a>

    <?php echo e(Form::open(['route' => ['admin.paymethod.delete', $paymethod->id], 'method' => 'DELETE', 'class' => 'button-form pull-left'])); ?>

    <div id="target<?php echo e($r); ?>" class="swal2-modal swal2-show delete-alert">
        <h2>Are you sure?</h2>
        <div class="swal2-content" style="display: block;">You want to delete this!</div>
        <hr class="swal2-spacer" style="display: block;">
        <button type="submit" class="btn btn-success"><i class="material-icons">check</i></button>
        <button class="btn btn-danger" type="button" onclick="this.parentNode.style.display = 'none';"><i class="material-icons">close</i></button>
    </div>
    <?php echo e(Form::close()); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });


        var table = $('#datatables').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });

        $('.card .material-datatables label').addClass('form-group');
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/payment_methods/view_paymethod.blade.php ENDPATH**/ ?>