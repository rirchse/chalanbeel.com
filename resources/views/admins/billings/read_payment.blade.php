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
                        <a class="text-success" title="View Active Services" href="/admin/bill/paid/view"><i class="material-icons">assignment</i></a>
                        <a class="text-primary" title="View All Services" href="/admin/bill/due/view"><i class="material-icons">assignment</i></a>
                        <a class="text-warning" title="Edit" href="/admin/payment/{{$bill->id}}/edit"><i class="material-icons">edit</i></a>

                        <a class="text-info" title="View Bills" href="/admin/payment/{{$bill->service_id}}/total_paid"><i class="material-icons">subject</i></a>
                        <a class="btn-simple btn-icon text-warning" title="View Due Bills" href="/admin/payment/{{$bill->service_id}}/total_due"><i class="material-icons">subject</i></a>
                        <a class="btn-simple btn-icon text-warning" title="View Due Bills" href="/admin/payment/{{$bill->service_id}}/total_due"><i class="material-icons">print</i></a>
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
                        <td>{{$bill->details}}</td>
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
    {{-- <div class="col-md-4">
      <div class="card card-profile">
        <div class="card-avatar">
          <a href="#pablo">
            <img src="/images/{{$bill->image?'profile/'.$bill->image:'avatar.png'}}" class="img">
          </a>
        </div>
        <div class="card-body">
          <h6 class="card-category text-gray">{{$bill->profession}}</h6>
          <h4 class="card-title">{{$bill->full_name}}</h4>
          <p class="card-description">details....</p>
          <img class="img-responsive" src="/images/{{$bill->nid_image?'nid/'.$bill->nid_image:'nid-sample.jpg'}}">
          <a class="btn btn-rose btn-round" href="#pablo">Follow</a>
        </div>
      </div>
    </div> <!-- end content--> --}}
</div> <!-- end row --> 
@endsection