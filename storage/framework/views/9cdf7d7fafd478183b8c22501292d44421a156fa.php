
<?php $__env->startSection('title', 'Print Due Bills'); ?>
<?php $__env->startSection('content'); ?>

<?php if(count($services) == 0): ?>

<div class="col-md-6 col-md-offset-3">
	<div class="card content text-center">
	<h3>No due bills are available.</h3>
	<h5>
		<p style="padding-left: 40px;padding-right: 40px;">Please go back to print section of this Bill of Lading and try adding a new due bill only then you will be able to print due bill.</p>
		<a href="<?php echo e($base_url); ?>/admin/due_bills">Back to due bill printing</a>
		<!--a class="text-small" href="#"></a-->
	</h5>
	</div>
</div>

<?php else: ?>

<style type="text/css" media="print">
@media print {
    a[href]:after {
        content: none !important;
    }
}
</style>

<div style="position: fixed; z-index:9999; right: 0;top: 5px;border: 2px solid #b54cf7;width: 74px;text-transform: uppercase;border-radius: 3px;font-weight: bold;" class="print">
	<a href="#" onclick="document.title=''; printDiv(); return false;">
		<i class="material-icons">print</i> Print
	</a>
</div>


<div name="table" id="table" style="width:8.5in; margin:40px auto; background:#fff; padding:10px 15px">
    <div>
        <div style="width:33%; float:left" class="pageheader">
            <img src="/images/<?php echo e($info['logo']); ?>" width="140"><br>
        </div>
        <div style="width:33%; float:left; text-align:center" class="pageheader">
            <b style="font-size:20px;"><?php echo e($info['name']); ?></b><br>
            <b>Internet Users Lists</b><br>
            <b style="font-size:16px"><?php echo e(date('F Y')); ?></b><p></p>
        </div>
        <div style="width:33%; float:left;text-align:right" class="pageheader">
            <div style=""><?php echo e(date('d M Y')); ?></div>            
        </div>
    <div class="clearfix"></div>
    <br>
    <table class="table table-bordered" cellspacing="0" width="100%" style="width:100%;">
    	<tr>
            <th>#</th>
            <th style="text-align:left" width="220">Name</th>
            <th>Contact</th>
            <th>Location</th>
            <th>Join Date</th>
            <th>Bill</th>
            <th>Last Pay At</th>
            <th>Remarks</th>
        </tr>
        <?php $r = 0; ?>
       <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <?php $r++; ?>
        <tr>
            <td><?php echo e($r); ?></td>
            <td style="text-align:left"><?php echo e($service->full_name); ?></td>
            <td style="text-align:left"><?php echo e($service->contact); ?></td>
            <td><?php echo e($service->station); ?></td>
            <td><?php echo e($service->join_date?date('d M Y', strtotime($service->join_date)):''); ?></td>
            <td><?php echo e($service->amount); ?></td>
            <td><?php echo e($service->last_pay_at?date('d M Y', strtotime($service->last_pay_at)):''); ?></td>
            <td></td>
        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th colspan="8">Total = <?php echo e(count($services)); ?></th>
        </tr>

        </tbody>
    </table>
</div><!--div for print-->

    <script type="text/javascript">
        function printDiv() {
        var divToPrint = document.getElementById('table');
        var htmlToPrint = '' +
            '<style type="text/css">' +
            '.pageheader{font-size:12px}'+
            'table { border-collapse:collapse; font-size:14px}' +
            'table th, table td { border:1px solid #666; padding: 10px;}' +
            '</style>';
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }
    </script>

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/services/print_due_services.blade.php ENDPATH**/ ?>