@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('print')
@section('title', 'Print Invoice')
@section('content')

@if(!$invoice)

<div class="col-md-6 col-md-offset-3">
	<div class="card content text-center">
	<h3>No invoice are available.</h3>
	<h5>
		<p style="padding-left: 40px;padding-right: 40px;">Please go back to print section of this Bill of Lading and try adding a new due bill only then you will be able to print due bill.</p>
		<a href="{{$base_url}}/admin/due_bills">Back to due bill printing</a>
	</h5>
	</div>
</div>

@else

<style type="text/css">

/* Styles for both screen and print */
.data-table, .data-table th, .data-table td {
    border: 1px solid black;
}
.data-table {
    border-collapse: collapse; /* Prevents double borders between cells */
    width: 100%;
}

/* Styles specifically for printing */
@media print {
    /* Ensure borders are visible in print */
    .data-table, .data-table th, .data-table td {
        border-color: black !important; /* Forces color if browser print settings are an issue */
    }
}
</style>

<div class="print">
</div>
<p class="text-center">
  <button class="btn btn-warning" onclick="window.history.back()">Back</button>
	<a class="btn btn-primary" href="#" onclick="printDiv()">
		<i class="material-icons">print</i> Print
	</a>
</p>
<div class="" name="table" id="table" style="width:8.5in; margin:40px auto; background:#fff; padding:10px 15px">
    <div>
        <div style="width:33%; float:left" class="pageheader">
            <img src="/images/{{$info['logo']}}" width="140"><br>
        </div>
        <div style="width:33%; float:left; text-align:center" class="pageheader">
            <b style="font-size:20px;">{{$info['name']}}</b><br>
            <b>Internet Bill</b><br>
            <b style="font-size:16px">{{date('F Y')}}</b><p></p>
        </div>
        <div style="width:33%; float:left;text-align:right" class="pageheader">
            <div style="">{{ date('d M Y') }}</div>            
        </div>
    <div class="clearfix"></div>
    <br>
    <table class="data-table" cellspacing="0" width="100%" style="width:100%;">
    	<tr>
        <th>Date</th>
        <th>Customer Details</th>
        <th>Package</th>
        <th>Bill Tk.</th>
        <th>Remarks</th>
      </tr>
      <tr>
        <td>{{$source->dtformat($invoice->receive_date)}}</td>
        <td>
          {{$invoice->user->name}}
          <br>
          {{$invoice->user->contact}}
        </td>
        <td>
          {{$invoice->package->speed}} Mbps
          <br>
          {{$invoice->package->time_limit}} Days
        </td>
        <td>
          {{$invoice->receive}}
        </td>
        <td></td>
      </tr>
        <tr>
          <th colspan="3" style="text-align: right">Total = </th>
          <th colspan="2" style="text-align: left">{{$invoice->receive}}</th>
        </tr>
    </table>
    <hr>
    <p class="text-center" style="text-align: center">
      Contact: 01778573396, 01703587911
      <br>
      <b>Address:</b>
        <br> <b>Nazirpur:</b> Abdul Hamid Supar Market, Nazirpur Bazar
      <br>
      <b>Bildahor:</b> Samad Complex, Bildahor Bazar
      <br>
      <b>Chanchkoir:</b> Chanchkoir Bazar, gurudaspur, Natore.
      <br>
      <a href="htts://chalanbeel.com">www.chalanbeel.com</a>
    </p>
</div> <!--div for print-->



  <script type="text/javascript">
      function printDiv()
      {
        var divToPrint = document.getElementById('table').outerHTML;
        var printWindow = window.open('', '', 'width=900,height=700');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Print</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse !important;
                    }
                    th, td {
                        border: 1px solid black !important;
                        padding: 8px !important;
                        text-align: left;
                    }
                </style>
            </head>
            <body>
                ${divToPrint}
            </body>
            </html>
        `);

        printWindow.document.close();

        printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
    }
  </script>

@endif

@endsection