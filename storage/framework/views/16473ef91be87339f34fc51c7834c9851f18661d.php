
<?php $__env->startSection('title', 'Edit User'); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Edit User</h4>
                    <div class="toolbar">
                        <a class="btn btn-simple btn-icon btn-info" href="/admin/user/<?php echo e($user->id); ?>/details" title="User details"><i class="material-icons">dvr</i></a>
                        <a href="/admin/view_users"><i class="material-icons">peoples</i></a>
                    </div>

    <?php echo Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT', 'files' => true]); ?>

    <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('full_name', 'Full Name:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('full_name', $user->full_name, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('contact', 'Contact Number:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('contact', $user->contact, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('email', 'Email Address:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::email('email', $user->email, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('work_at', 'Work At', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('work_at', $user->work_at, ['class' => 'form-control datepicker'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('profession', 'Profession', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('profession', $user->profession, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('join_date', 'Join Date', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('join_date', $user->join_date, ['class' => 'form-control'])); ?>

                </div>
                <div class="form-group label-floating">
                    <select name="location" id="" class="form-control">
                        <option value="">Select Location</option>
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($location->id); ?>" <?php echo e($user->location_id == $location->id?'selected':''); ?>><?php echo e($location->station); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Lat Lang</label>
                  <input type="text" name="lat_long" class="form-control" placeholder="00.00000, 00.00000" value="<?php echo e($user->lat ? $user->lat.', '.$user->lng:''); ?>">
                </div>
                <div class="form-group label-floating">
                    <?php echo e(Form::label('date_of_birth', 'Date of Birth (Y-m-d)', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('date_of_birth', $user->date_of_birth, ['class' => 'form-control datepicker'])); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('NID', 'NID Card Number', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::text('NID', $user->nid_no, ['class' => 'form-control'])); ?>

                </div>
                <div class="fileinput fileinput-new text-center pull-right" data-provides="fileinput" style="width:100%;margin-bottom:15px;border:1px solid #eee">
                    <div class="fileinput-new thumbnail" style="width:100%;">
                        <img class="img-responsive" src="/images/<?php echo e($user->nid_image?'nid/'.$user->nid_image:'/nid-sample.jpg'); ?>" alt="">
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
                        <img class="img-responsive" src="/images/<?php echo e($user->image?'profile/'.$user->image:'avatar.png'); ?>" alt="">
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
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label>Status</label>
                    <br>
                    <label>
                      <input type="radio" name="status" value="Active" <?php echo e($user->status == 'Active'? 'checked':''); ?>> 
                      <span class="text-success"> Active </span>
                    </label>
                    <label>
                      <input type="radio" name="status" value="Deactive" <?php echo e($user->status == 'Deactive'? 'checked':''); ?>>
                      <span class="text-warning"> Deactive</span> 
                    </label>
                    <label>
                      <input type="radio" name="status" value="2" <?php echo e($user->status == 2? 'checked':''); ?>> 
                      <span class="text-primary"> Free </span>
                    </label>
                    <label>
                      <input type="radio" name="status" value="3" <?php echo e($user->status == 3? 'checked':''); ?>> 
                      <span class="text-danger"> Cancel </span>
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <?php echo e(Form::label('details', 'Details:', ['class' => 'control-label'])); ?>

                    <?php echo e(Form::textarea('details', $user->details, ['class' => 'form-control', 'rows' => '4'])); ?>

                </div>
            </div>
        </div>
        <a href="#" class="btn btn-simple btn-danger btn-icon pull-left" title="Delete this user!" onclick="document.getElementById('target').style.display = 'block';"><i class="material-icons">delete</i></a>

        <button type="submit" class="btn btn-primary pull-right"><i class="material-icons">update</i></button>
        <div class="clearfix"></div>
    <?php echo Form::close(); ?>


    <?php echo e(Form::open(['route' => ['admin.user.delete', $user->id], 'method' => 'DELETE'])); ?>

        <div id="target" class="swal2-modal swal2-show delete-alert">
            <h2>Are you sure?</h2>
            <div class="swal2-content" style="display: block;">You want to delete this!</div>
            <hr class="swal2-spacer" style="display: block;">
            <button type="submit" class="btn btn-success"><i class="material-icons">check</i></button>
            <button class="btn btn-danger" type="button" onclick="this.parentNode.style.display = 'none';"><i class="material-icons">close</i></button>
        </div>
    <?php echo e(Form::close()); ?>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/users/edit_user.blade.php ENDPATH**/ ?>