
<?php $__env->startSection('title', 'Print Due Bills'); ?>
<?php $__env->startSection('content'); ?>

<?php if(empty($bill)): ?>

<div class="col-md-6 col-md-offset-3">
	<div class="card content text-center">
	<h3>No due bills are available.</h3>
	<h5>
		<p style="padding-left: 40px;padding-right: 40px;">Please go back to print section of this Bill of Lading and try adding a new due bill only then you will be able to print due bill.</p>
		<a href="/admin/due_bills">Back to due bill printing</a>
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
        <div style="width:30%; float:left" class="pageheader">
            <img src="/images/<?php echo e($info['logo']); ?>" width="140"><br>
        </div>
        <div style="width:40%; float:left; text-align:center" class="pageheader">
            <b style="font-size:22px;"><?php echo e($info['name']); ?></b><br>
            <b>01778 573396, 01703 586911</b><br>
            SB Complex, Chanchkoir Bazar, Gurudaspur, Natore<br>
            <b style="font-size:18px">Internet Bill</b><br><br>
        </div>
        <div style="width:30%; float:left;text-align:right" class="pageheader">
            <div style="">Date: <?php echo e(date('d M Y')); ?></div>            
        </div>
        <div class="col-md-12" style="font-size: 18px;line-height:1.5">
            User/Organization Name: <b><?php echo e($bill->full_name); ?></b> Billing Date: <b><?php echo e(date('d ', strtotime($bill->billing_date)).date('M Y')); ?></b> Billing Month: <b><?php echo e(date('M Y')); ?></b> Billing Plan: <b><?php echo e($bill->billing_plan); ?></b>, Bandwidth: <b>1MBPS</b> Duration: <b>1 Month</b> <br>Amount (in word): Taka 
            <?php
            $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
            echo $f->format(1000);
            ?> only<br>
            Amount: <span style="border:1px solid #999;font-weight:bold"> 1000/-</span><br><br>
            <p style="text-align:right">Signature of Receiver</p>
            <div style="font-size:14px; text-align:center">:: বকেয়া বিল পরিশোধ করে নিরবিচ্ছিন্ন সেবা প্রদানে সহায়তা করুন ::, &nbsp; &nbsp; www.chalanbeel.com/login</div>
        </div>
        <div class="clearfix"></div>
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
<?php echo $__env->make('print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/print_due_bill.blade.php ENDPATH**/ ?>