
<?php $__env->startSection('title', 'Create Customer'); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Create User</h4>

    <?php echo Form::open(['route' => 'user.store', 'method' => 'POST', 'files' => true]); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('name', 'Full Name:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('name', null, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('contact', 'Contact Number:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('contact', null, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('email', 'Email Address:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::email('email', null, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('work_at', 'Work At', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('work_at', null, ['class' => 'form-control datepicker'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('profession', 'Profession', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('profession', null, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('join_date', 'Join Date', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::date('join_date', date('Y-m-d'), ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <select name="location" id="" class="form-control">
                        <option value="">Select Location</option>
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($location->id); ?>"><?php echo e($location->station); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group label-floating">
                    <input type="text" name="lat_long" id="lat_long" class="form-control" placeholder="Lat Long">
                </div>
                <div class="form-group label-floating">
                    <select name="status" id="" class="form-control">
                      <option value="">Select One</option>
                      <option value="New">New</option>
                      <option value="Active">Active</option>
                      <option value="Expire">Expire</option>
                      <option value="Cancel">Cancel</option>
                    </select>
                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('date_of_birth', 'Date of Birth (Y-m-d)', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::date('date_of_birth', null, ['class' => 'form-control datepicker'])); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('NID', 'NID Card Number', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('NID', null, ['class' => 'form-control'])); ?>

                </div>
                <div class="fileinput fileinput-new text-center pull-right" data-provides="fileinput" style="width:100%;margin-bottom:15px;border:1px solid #eee">
                    <div class="fileinput-new thumbnail" style="width:100%;">
                        <img class="img-responsive" src="/images/nid-sample.jpg" alt="">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn-round btn-rose btn-file btn-small">
                            <span class="btn btn-xs btn-info fileinput-new">Upload NID</span>
                            <span class="fileinput-exists">Change NID</span>
                            <input type="file" name="nid_image" />
                        </span>
                        <br />
                    </div>
                </div>
                <div class="fileinput fileinput-new text-center pull-right" data-provides="fileinput" style="width:100%;border:1px solid #eee">
                    <div class="fileinput-new thumbnail" style="width:160px;">
                        <img class="img-responsive" src="/images/avatar.png" alt="">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn-round btn-rose btn-file btn-small">
                            <span class="btn btn-xs btn-info fileinput-new">Add Photo</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="profile_image" />
                        </span>
                        <br />
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('details', 'Details:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::textarea('details', null, ['class' => 'form-control', 'rows' => '4'])); ?>

                </div>
                <div class="form-group">
                  <div id="map" style="width:100%; height:400px; margin-top:0"></div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Save</button>
        <div class="clearfix"></div>
    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e('/js/open-map.js'); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/users/create_user.blade.php ENDPATH**/ ?>