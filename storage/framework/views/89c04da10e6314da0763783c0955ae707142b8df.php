<?php $__env->startSection('title', 'Due Payment'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple"><i class="material-icons">assignment</i></div>
            <div class="card-content">
                <h4 class="card-title">View Due Bills</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Contact</th>
                                <th>Username</th>
                                <th>Amount (Tk.)</th>
                                <th>Billing Month</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Contact</th>
                                <th>Username</th>
                                <th>Amount</th>
                                <th>Billing Month</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php 
                            $r = 1; 
                            $total_due = 0;
                            $due_bill = 0;
                            ?>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php
                            $service_plan = App\ServicePlan::where('service_id', $service->id)->orderBy('id', 'DESC')->first();
                            if($service_plan){
                                $due_bill = $service_plan->amount;
                            }else{
                                $due_bill = $service->amount;
                            }
                            
                            $billing_month = date('Y-m');
                            
                            if($service->billing_plan == "Postpaid"){
                                $billing_month = date('Y-m', strtotime('-1 month'));
                            }

                            // dd(date('Y-m') < date('Y-m'));

                            $duebills = DB::table('payments')->where('service_id', $service->id)->where('billing_month', $billing_month)->get();?>
                            <?php if(date('Y-m', strtotime($service->billing_date)) < $billing_month && count($duebills) <= 0): ?>
                            <?php $total_due += $due_bill; ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($service->full_name); ?></td>
                                <td><?php echo e($service->contact); ?></td>
                                <td title="<?php echo e($service->station); ?>"><?php echo e($service->username); ?></td>
                                <td><?php echo e($due_bill?$due_bill:''); ?></td>
                                <td><?php echo e($service->billing_date ? date('d ', strtotime($service->billing_date)).date('M ').date('Y '):''); ?></td>
                                <td class="text-right">
                                    <a href="/admin/payment/<?php echo e($service->id); ?>/print"class="btn btn-simple btn-info btn-icon"><i class="material-icons">print</i></a>
                                    <a href="/admin/payment/<?php echo e($service->id); ?>/total_due" class="btn btn-simple btn-success btn-icon" title="Total Due Bills"><i class="material-icons">subject</i></a>
                                    <a href="/admin/payment/<?php echo e($service->id); ?>/<?php echo e($billing_month); ?>/add" class="btn btn-simple btn-warning btn-icon" title="Add Bill Amount"><i class="material-icons">add_circle</i></a>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php $r ++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr style="color:#f00">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total Due = </th>
                                <th><?php echo e($total_due); ?></th>
                                <th></th>
                                <th></th>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/billings/view_due_payments.blade.php ENDPATH**/ ?>