<?php $__env->startSection('title', 'Update Address'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
        <div class="col-md-12">
            <div class="card">

                <?php echo e(Form::model($address, ['route' => ['address.update', $address->id], 'method' => 'PUT', 'id' => 'RegisterValidation'])); ?>

                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">edit</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Edit Address</h4>

                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                
                                <?php echo e(Form::label('stop', 'Pickup/Delivery Title', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::text('stop', $address->stop, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('first', 'First', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::text('first', $address->first, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('last', 'Last', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::text('last', $address->last, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('address', 'Address', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::text('address', $address->address, ['class' => 'form-control border-input'])); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('city', 'City', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::text('city', $address->city, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('state', 'State', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::text('state', $address->state, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('zip', 'ZIP', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::text('zip', $address->zip, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
                                <?php echo e(Form::label('telephone', 'Telephone', ['class' => 'control-label'])); ?>

                                <?php echo e(Form::text('telephone', $address->contact, ['class' => 'form-control border-input'])); ?>

                            </div>
                        </div>
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-rose btn-fill">Update Address</button>
                        </div>
                    </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
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
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/locations/edit_address.blade.php ENDPATH**/ ?>