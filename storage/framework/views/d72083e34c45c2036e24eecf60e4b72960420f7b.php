<?php $__env->startSection('title', 'Showing Search Result'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Search Results</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>

                <?php if(!empty($search_worders)): ?>

                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Work Order</th>
                                <th>Account Name</th>
                                <th>Total Containers</th>
                                <th>Total Weight</th>                                
                                <th>Enter Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Work Order</th>
                                <th>Account Name</th>
                                <th>Total Containers</th>
                                <th>Office</th>
                                <th>Enter Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php $__currentLoopData = $search_worders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workorder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><a href="/work_order_details/<?php echo e($workorder->id); ?>"><?php echo e($workorder->id); ?></a></td>
                                <td><a href="/work_order_details/<?php echo e($workorder->id); ?>"><?php echo e($workorder->client); ?></a></td>
                                <td><?php echo e($workorder->container); ?></td>
                                <td><?php echo e($workorder->weight); ?></td>
                                <td title="<?php echo e(date('h:i:s', strtotime($workorder->created_at))); ?>"><?php echo e(date('m/d/Y', strtotime($workorder->created_at))); ?></td>
                                <td class="text-right">
                                    <a href="/work_order_details/<?php echo e($workorder->id); ?>" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvrl</i></a>
                                    <a href="/work_order/<?php echo e($workorder->id); ?>/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the work order"><i class="material-icons">mode_edit</i></a>

                                    <?php if($workorder->status == 1): ?>

                                    <a href="/finished_work_order/<?php echo e($workorder->id); ?>" class="btn btn-simple btn-warning btn-icon" title="Mark the Work Order as finished!"><i class="material-icons">check</i></a>

                                    <?php elseif($workorder->status == 2): ?>

                                    <a href="/active_work_order/<?php echo e($workorder->id); ?>" class="btn btn-simple btn-success btn-icon" title="Move to active work order"><i class="material-icons">replay</i></a>

                                    <?php endif; ?>

                                </td>
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>

                <?php else: ?>

                <h3 class="text-warning">Searching value Doesn\'t match!</h3>

                <?php endif; ?>

            </div><!-- end content-->


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
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/users/search_result.blade.php ENDPATH**/ ?>