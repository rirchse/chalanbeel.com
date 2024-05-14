@extends('print')
@section('title', 'Print Due Bills')
@section('content')

@if(empty($service))

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

@else

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
            <img src="/images/{{$info['logo']}}" width="140"><br>
        </div>
        <div style="width:33%; float:left; text-align:center" class="pageheader">
            <b style="font-size:20px;">{{$info['name']}}</b><br>
            <b>Anual Billing Report</b><br>
            <b style="font-size:20px">Year: {{$year}}</b><p></p>
        </div>
        <div style="width:33%; float:left;text-align:right" class="pageheader">
            <div style="">{{ date('d M Y') }}</div>            
        </div>
    <div class="clearfix"></div>
    <br>
      <table class="table table-bordered">
          <tr>
            <td><b>Name:</b> {{$service->full_name}}</td>
            <td><b>Contact:</b> {{$service->contact}}</td>
            <td><b>Username:</b> {{$service->username}}</td>
            <td><b>Connection Date:</b> {{date('d M Y', strtotime($service->billing_date))}}</td>
        </tr>
      </table>
    <table class="table table-bordered" cellspacing="0" width="100%" style="width:100%;">
        
        <tr>
            <th>#</th>
            <th>Billing Month</th>
            <th>Billing Date</th>
            <th>Bill Amount</th>
            <th>Paid</th>
            <th>Paid At</th>
            <th>Due</th>
            <th>Received By</th>
            <th>Comments</th>
        </tr>
        <tbody>
            @if($service)
            <?php
            $r = 1;
            $total = $total_due = $total_paid = 0;

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

            $billing_year = date('Y', $billing_date);

            if($year > date('Y', strtotime($billing_date))){
                $billing_year = $year;
            }            
            
            $billing_date  = strtotime('2021'.date('-m', $billing_date));

            $billing_month = strtotime('-1 MONTH', $billing_date);
            $closed_month  = strtotime(date('Y-m'));
            $bill_amount = $service->amount;

            if($year < date('Y')){
                $closed_month = strtotime($year.'-12');
            }

            $closed_at  = strtotime(date('Y-m'));

            if($service->billing_plan == 'Postpaid')
            {
                $closed_month = strtotime('-1 MONTH', $closed_month);
            }


            ?>

            @while(strtotime('+1 MONTH', $billing_month) <= $closed_month)
            <?php
            $billing_month = strtotime('+1 MONTH', $billing_month);
            $checking_month = date('Y-m', $billing_month);

            //payment receiver 
            $payment = App\Payment::where('service_id', $service->id)->where('billing_month', 'like', '%'.$checking_month.'%')->first();

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

            <tr>
                <td>{{$r}}</td>
                <td>{{ date('F', $billing_month) }}</td>
                <td>{{ date('d ', strtotime($billing->billing_date)).' '.date('F Y', $billing_month) }}</td>
                <td>{{ $bill_amount }}</td>
                <td>{{ $bill_amount-$check }}</td>
                <td>{{ $payment?date('d M Y', strtotime($payment->receive_date)):'' }}</td>
                <td>{{ $check != false?$check:0 }}</td>
                <td>{{ $payment?App\Admin::find($payment->created_by)->first_name:'' }}</td>
                <td></td>
            </tr>

            <?php
            $total += $bill_amount;
            $total_paid += $bill_amount-$check;
            $total_due += $check;
             } $r++; ?>

            @endwhile

            @endif
            <tr>
                <th colspan=2></th>
                <th>Total = </th>
                <th>{{ $total }}</th>
                <th>{{ $total_paid }}</th>
                <th></th>
                <th>{{ $total_due }}</th>
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

@endif

@endsection