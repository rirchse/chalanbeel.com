@extends('admin')
@section('title', 'Bill Details')
@section('content')
    
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Bill Details</h4>
                <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                      <a class="btn btn-success btn-sm" title="Payments" href="{{route('payment.index')}}">
                        <i class="fa fa-list"></i>
                      </a>
                      <a class="btn btn-warning btn-sm" title="Edit Payment" href="{{route('payment.edit', $bill->id)}}">
                        <i class="fa fa-edit"></i>
                      </a>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <th>Billing Method</th>
                        <th>{{$bill->payment_system}}</th>
                    <tr>
                        <th>Account No.</th>
                        <td>{{$bill->account_no}}</td>
                    </tr>
                    <tr>
                        <th>Referer</th>
                        <td>{{$bill->refer_no}}</td>
                    </tr>
                    <tr>
                        <th>TrxID</th>
                        <td>{{$bill->trxid}}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{$bill->receive}}</td>
                    </tr>
                    <tr>
                        <th>Receive Date</th>
                        <td>{{$bill->receive_date}}</td>
                    </tr>
                    <tr>
                        <th>Billing Month</th>
                        <td>{{$bill->billing_month}}</td>
                    </tr>
                    <tr>
                        <th>Service Details</th>
                        <td><a href="/admin/service/{{$bill->service_id}}">View Service Details</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <th>{{$bill->status == 1? 'Paid':'Due'}}</th>
                    </tr>
                    <tr>
                        <td>Details: </td>
                        <td>{!!$bill->details!!}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{$bill->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Created By</th>
                        <td>{{$bill->first_name.' '.$bill->last_name}}</td>
                    </tr>
                    <tr>
                        <th>Updated By</th>
                        <td>{{$bill->first_name.' '.$bill->last_name}}</td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end row --> 
@endsection