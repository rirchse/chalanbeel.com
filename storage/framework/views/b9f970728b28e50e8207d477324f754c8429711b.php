<?php $__env->startSection('title', 'Check Account'); ?>
<?php $__env->startSection('content'); ?>

<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
            <div class="card">

            <?php echo Form::open(['route' => 'check_account_details', 'method' => 'POST']); ?>

                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">subject</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10"><h4 class="card-title">Check Account</h4></div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="title">Type your internet account number</p>
                            <input id="number" class="form-contro" name="number" placeholder="01X XX XX XX XX" style="width:100%;padding:15px" autofocus="" required="" minlength="11" maxlength="11">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-fill pull-right">Submit</button>
                </div>
            </div>
            </div>
        </div><!-- container -->
            <?php echo Form::close(); ?>


        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/homes/check_account.blade.php ENDPATH**/ ?>