<?php $__env->startSection('content'); ?>
<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
  <div class="content">
      <div class="container">
        <div class="col-md-6 col-md-offset-3">
          <div class="card">
            <form action="<?php echo e(route('bkash.pay')); ?>" method="POST" style="min-height:400px">
              <?php echo csrf_field(); ?>
              <div class="form-group">
                <label>Enter Amount:</label>
                <input class="form-contr/ol" type="number" name="amount" placeholder="Enter amount" required>
              </div>
              <br>
              <button type="submit" class="btn btn-warning">
                <img src="/images/icons/bkash.png" alt="" style="width: 150px">
                Pay with bkash</button>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/bkash/create-payment.blade.php ENDPATH**/ ?>