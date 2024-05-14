@extends('admin')
@section('title', 'Due Bills')
@section('content')
    
<div class="row">
    <style type="text/css">
    @media print {
 table tr:first-child{
        display: none;
    }
}
    </style>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple"><i class="material-icons">assignment</i></div>
            <div class="card-content">
                <h4 class="card-title">Due Bills of <b>{{$service->full_name.' '.$service->contact}}</b></h4>
                <div class="toolbar">

                    <button onclick="printDiv()">Print</button>
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
                            @if($service)
                            <?php
                            $r = 1;
                            $totaldue = 0;

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

                            @while(strtotime('+1 MONTH', $billing_month) <= $closed_month)
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

                            @if($check != false)

                            <tr>
                                <td>{{$r}}</td>
                                <td>{{ $service->username }}</td>
                                <td>{{ number_format($check, 2) }}</td>
                                <td>{{ date('M Y', $billing_month) }}</td>
                                <td>{{ $service->speed.'bps-'.$service->time_limit }}</td>
                                <td>
                                    <span style="color:#d00">Due</span>
                                </td>
                                <td class="text-right">
                                    <a href="/admin/service/{{ $service->id }}" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/payment/{{$service->id}}/{{date('Y-m', $billing_month)}}/add" class="btn btn-simple btn-warning btn-icon" title="Add Bill Amount"><i class="material-icons">add_circle</i></a>
                                </td>
                            </tr>
                            <?php $totaldue += $check; ?>
                            @endif

                            <?php } $r++; ?>

                            @endwhile

                            @endif
                        </tbody>

                            <tr>
                                <th colspan=2>Total = </th>
                                <th>{{$totaldue}}</th>
                                <th colspan=4></th>
                            </tr>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row --> 
<script type="text/javascript">
        function printDiv() {
        var divToPrint = document.getElementById('datatables');
        var htmlToPrint = '' +
            '<style type="text/css">' +
            '.pageheader{font-size:12px}'+
            'table { border-collapse:collapse; font-size:11px}' +
            'table th, table td { border:1px solid #666; padding: 5px;}' +
            '</style>';
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        // $('table tr:first').hide();
        newWin.print();
        newWin.close();
    }
    </script>
@endsection