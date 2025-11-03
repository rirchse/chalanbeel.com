<?php $__env->startSection('title', 'Edit Package'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">

            <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-6">
                        <h4 class="card-title">Edit Package</h4>
                    </div>
                    <div class="toolbar">
                        <a class="btn-simple btn-icon text-info" href="/admin/package/<?php echo e($package->id); ?>" title="Details"><i class="material-icons">dvr</i></a>
                        <a class="btn-simple btn-icon text-success" href="/admin/package" title="View"><i class="material-icons">subject</i></a>
                    </div>
                    
                    <form action="<?php echo e(route('package.update', $package->id)); ?>" method="POST" id="RegisterValidation">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PUT'); ?>

                    <div class="row">
                      <div class=" col-md-12">
                          <div class="form-group label-floating">
                              <label for="">Speed(*):</label>
                              <input type="text" class="form-control" name="speed" required value="<?php echo e($package->speed); ?>">
                          </div>
                          <div class="form-group label-floating">
                              <label for="">Time Limit in Days(*):</label>
                              <input type="number" class="form-control" name="time_limit" required value="<?php echo e($package->time_limit); ?>">
                          </div>
                          <div class="form-group label-floating">
                              <label for="">Price(*):</label>
                              <input type="number" class="form-control" name="price" required step="0.1" value="<?php echo e($package->price); ?>">
                          </div>
                          <div class="form-group label-floating">
                              <label>Status:</label>
                              <br>
                              <input type="radio" name="status" value="Active" <?php echo e($package->status == 'Active'? 'checked': ''); ?>> Active &nbsp; 
                              <input type="radio" name="status" value="Inactive" <?php echo e($package->status == 'Inactive'? 'checked': ''); ?>> Inactive
                          </div>
                          <div class="form-group label-floating">
                              <label for="">Details:</label>
                              <textarea class="form-control" name="details" id="" rows="3" ><?php echo e($package->details); ?></textarea>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <button type="submit" class="btn btn-primary pull-right"><i class="material-icons">save</i> Save</button>
                      </div>
                  </div>

                    
                </form>
                    
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/packages/edit_package.blade.php ENDPATH**/ ?>