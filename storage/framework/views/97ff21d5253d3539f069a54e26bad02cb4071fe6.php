<?php $__env->startSection('title', 'View Live Users'); ?>
<?php $__env->startSection('content'); ?>

<style type="text/css">
    .item-wrapper{margin-bottom: 15px;float: left;width: 15%;margin-right: 10px;}
    .item-box{border:1px solid #ddd; padding: 10px;text-align: center;}

</style>

<?php
$live = [];
foreach($liveusers as $liveuser){
    $live[] = $liveuser('name');
}

?>


    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h4 class="card-title text-success">Live Services [<b><?php echo e(count($live)); ?></b>]</h4>
                <div class="toolbar">
                    <span></span>
                </div>
                <div class="col-md-12">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item-wrapper">
                        <div class="item-box" style="background:#<?php echo e(in_array($service->username, $live)?'0f0':'ddd'); ?>">
                            <a href="/admin/service/<?php echo e($service->id); ?>/edit"><?php echo e($service->username); ?><br>
                            <?php echo e(substr($service->full_name, 0, 10)); ?></a><br>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <br><br>
                </div>
                <div class="clearfix"></div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/services/view_live_services.blade.php ENDPATH**/ ?>