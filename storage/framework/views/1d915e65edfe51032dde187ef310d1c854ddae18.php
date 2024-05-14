<?php $__env->startSection('title', 'Showing payments'); ?>
<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Due Payments</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                    
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Amount</th>
                                <th>Billing Month</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Amount</th>
                                <th>Billing Month</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            /* array value exists function */
                            function arrExists($array, $month, $amount)
                            {
                                for($a = 0; count($array) > $a; $a++)
                                {
                                    if($array[$a]['billing_month'] == $month)
                                    {
                                        if($array[$a]['receive'] >= $amount)
                                        {
                                            return false;
                                        }
                                        else
                                        {
                                            return $amount - $array[$a]['receive']; 
                                        }
                                    }
                                }
                                return $amount;
                            }
                            ?>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $r = 1;
                            $totaldue = 0;

                            $payments = App\Payment::where('service_id', $service->id)->select('billing_month', 'receive')->get();

                            $billing_months = [];
                            // collecting rows from service plans table
                            $billings = App\ServicePlan::where('service_id', $service->id)->get();
                            // creating array what is exist
                            foreach($billings as $bill){
                                array_push($billing_months, date('Y-m', strtotime($bill->billing_date)));
                            }
                            
                            $billing_date  = strtotime($service->billing_date);
                            $billing_date  = strtotime(date('Y-m', $billing_date));
                            $billing_month = strtotime('-1 MONTH', $billing_date);
                            $closed_month  = strtotime(date('Y-m'));
                            $bill_amount = $service->amount;
                            $closed_at  = strtotime(date('Y-m'));

                            // if($service->status == 3 && $service->closed_date)
                            // {
                            //     $closed_month = strtotime($service->closed_date);
                            // }
                            
                            if($service->billing_plan == 'Postpaid')
                            {
                                $closed_month = strtotime('-1 MONTH', $closed_month);
                            }

                            ?>

                            <?php while(strtotime('+1 MONTH', $billing_month) <= $closed_month): ?>
                            <?php
                            $billing_month = strtotime('+1 MONTH', $billing_month);
                            $checking_month = date('Y-m', $billing_month);

                            if(in_array($checking_month, $billing_months)) {
                            $billing = App\ServicePlan::where('billing_date', 'like','%'.$checking_month.'%')->where('service_id', $service->id)->first();
                                
                                $bill_amount = $billing->amount;

                                if($billing->closed_at){
                                    $closed_at = strtotime(date('Y-m', strtotime($billing->closed_at)));
                                } else {
                                    $closed_at  = strtotime(date('Y-m'));
                                }
                            }


                            if($billing_month <= $closed_at) {

                            $check = arrExists($payments, $checking_month, $bill_amount);
                            ?>

                            <?php if($check != false): ?>

                            <tr>
                                <td><?php echo e($r); ?></td>
                                <td><?php echo e($service->username); ?></td>
                                <td><?php echo e(number_format($check, 2)); ?></td>
                                <td><?php echo e(date('M Y', $billing_month)); ?></td>
                                <td><?php echo e($service->speed.'bps-'.$service->time_limit); ?></td>
                                <td>
                                    <span style="color:#d00">Due</span>
                                </td>
                                <td class="text-right">
                                    
                                </td>
                            </tr>
                            <?php $totaldue += $check; ?>
                            <?php endif; ?>

                            <?php } $r++; ?>

                            <?php endwhile; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                            <tr>
                                <th colspan=2>Total = </th>
                                <th><?php echo e($totaldue); ?></th>
                                <th colspan=4></th>
                            </tr>
                    </table>
                </div>
            </div> <!-- end content-->
        </div> <!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/users/view_due_bills.blade.php ENDPATH**/ ?>