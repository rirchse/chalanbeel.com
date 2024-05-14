<?php $__env->startSection('title', 'Edit Container'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Edit Container</h4>
                    <?php echo Form::model($container, ['route' =>['update.container', $container->id], 'method' => 'PUT', 'id' => 'RegisterValidation']); ?>

                    <div class="col-md-12">

                        <div class="col-md-4">
                            <div class="form-group label-floating">
<?php echo e(Form::label('vessel', 'Vessel', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('vessel', $container->vessel, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
<?php echo e(Form::label('unit_number', 'Unit Number', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('unit_number', $container->container, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
<?php echo e(Form::label('weight', 'Container Weight', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('weight', $container->weight, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
<?php echo e(Form::label('seal', 'Seal #', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('seal', $container->seal, ['class' => 'form-control border-input'])); ?>

                            </div>                          
                        </div> 
                        <!--Next col-md4-->   
                        <div class="col-md-4">
                            <div class="form-group label-floating">
<?php echo e(Form::label('chassis', 'Chassis', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('chassis', $container->chassis, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
<?php echo e(Form::label('size', 'Trailer Size', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('size', $container->size, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
<?php echo e(Form::label('drive', 'Drive', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('drive', $container->drive, ['class' => 'form-control border-input'])); ?>

                            </div> 
                            <div class="form-group label-floating">
<?php echo e(Form::label('reference', 'Reference #', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('reference', $container->reference, ['class' => 'form-control border-input'])); ?>

                            </div>                         
                        </div>  
                        <!--Next col-md4-->   
                        <div class="col-md-4">
                            
                            <div class="form-group label-floating">
<?php echo e(Form::label('adtl_bol_1', 'Adtl. BOL', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('adtl_bol_1', $container->add_bol1, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
<?php echo e(Form::label('adtl_bol_2', 'Adtl. BOL', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('adtl_bol_2', $container->add_bol2, ['class' => 'form-control border-input'])); ?>

                            </div>
                            <div class="form-group label-floating">
<?php echo e(Form::label('adtl_bol_3', 'Adtl. BOL', ['class' => 'control-label container-label'])); ?>

<?php echo e(Form::text('adtl_bol_3', $container->add_bol3, ['class' => 'form-control border-input'])); ?>

                            </div>                       
                        </div>
                        <div class="clearfix"></div>

                    <?php echo e(Form::hidden('worder_id', $worder->id)); ?>

                    <?php echo e(Form::hidden('bol_id', $bol->id)); ?>


                    <button type="submit" class="btn btn-rose btn-fill pull-right">Update Container</button>
                    <a href="/work_order_details/<?php echo e($worder->id); ?>" class="btn btn-default btn-fill pull-right">Back to work order</a>
                    <?php echo Form::close(); ?>

                        
                </div>
            </div>
        </div>
    </div><!-- end row --> 
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
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/users/edit_container.blade.php ENDPATH**/ ?>