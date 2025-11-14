@extends('admin')
@section('title', 'Received Payment')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple"><i class="material-icons">assignment</i></div>
            <div class="card-content">
                <h4 class="card-title">Received Payments</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Contact</th>
                                <th>Amount Tk.</th>
                                <th>PayMethod</th>
                                <th>Date</th>
                                <th>Billing Month</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Contact</th>
                                <th>Amount</th>
                                <th>PayMethod</th>
                                <th>Date</th>
                                <th>Billing Month</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $total = 0; ?>

                            @foreach($payments as $key => $payment)

                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{$payment->name}} </td>
                                <td>{{ $payment->username }}</td>
                                <td>{{ $payment->receive?$payment->receive:'Due' }}</td>
                                <td>{{ $payment->payment_system }}</td>
                                <td>{{ $payment->receive_date?date('d M Y', strtotime($payment->receive_date)):'' }}</td>
                                <td>{{ $payment->billing_month }}</td>
                                <td class="text-right">
                                    <a href="/admin/payment/{{$payment->id}}" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/payment/{{$payment->id}}/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the record"><i class="material-icons">mode_edit</i></a>
                                </td>
                            </tr>

                            <?php $total += $payment->receive; ?>

                            @endforeach
                            <tr>
                                <th></th>
                                <th>Total = </th>
                                <th>{{$total}}</th>
                                <th></th>
                                <th></th>
                                <th></th>
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
@endsection