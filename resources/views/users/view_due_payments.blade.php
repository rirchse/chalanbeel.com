@extends('user')
@section('title', 'Showing payments')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing payments</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                    {{-- {{dd($payments)}} --}}
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Payment By</th>
                                <th>Account No</th>
                                <th>Amount</th>
                                <th>Payment On</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Payment By</th>
                                <th>Account No</th>
                                <th>Amount</th>
                                <th>Payment On</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 1; ?>

                            @foreach($payments as $payment)

                            <tr>
                                <td>{{$r}}</td>
                                <td>{{ $payment->payment_system }}</td>
                                <td>{{ $payment->account_no }}</td>
                                <td>{{ $payment->receive }}</td>
                                <td title="{{ date('H:i:s', strtotime($payment->receive_date)) }}">{{ date('d M Y', strtotime($payment->receive_date)) }}</td>
                                <td>{{ $payment->service.'-'.$payment->speed.'bps-'.$payment->time_limit }}</td>
                                <td>
                                    @if($payment->status == 0)
                                    <span style="color:#d00">Pending
                                    @elseif($payment->status == 1)
                                    <span style="color:#0d0">Active
                                    @endif
                                </td>
                                <td class="text-right">
                                    {{-- <a href="/payment/{{ $payment->id }}/edit" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a> --}}
                                    {{-- <a href="/payment/{{ $payment->id }}/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the record"><i class="material-icons">mode_edit</i></a> --}}
                                </td>
                            </tr>
                            <?php $r++; ?>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row --> 
@endsection