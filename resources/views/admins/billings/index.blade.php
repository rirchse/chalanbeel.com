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
                  <form action="{{route('payment.index')}}" method="GET" class="">
                    @csrf
                    <div class="col-md-3">
                      <div class="form-group">
                        <select name="user_id" id="user_id" class="form-control select2">
                          <option value="">Select User</option>
                          @foreach($users as $user)
                          <option value="{{$user->id}}" {{$user->id == $user_id ? 'selected' : ''}}>{{$user->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="date" name="start_date" class="form-control" value="{{$start_date}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="date" name="end_date" class="form-control" value="{{$end_date}}">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-info btn-sm btn-block">Submit</button>
                    </div>
                  </form>
                  <div class="clearfix"></div>
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Contact</th>
                            <th>Amount Tk.</th>
                            <th>TrxID</th>
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
                                <th>TrxID</th>
                                <th>Date</th>
                                <th>Billing Month</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                          @foreach($payments as $key => $payment)
                          <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{$payment->name}} </td>
                                <td>{{ $payment->contact }}</td>
                                <td>{{ $payment->receive ? $payment->receive:'Due' }}</td>
                                <td>{{ $payment->trxid }}</td>
                                <td>{{ $payment->receive_date ? date('d M Y', strtotime($payment->receive_date)) : '' }}</td>
                                <td>{{ $payment->billing_month }}</td>
                                <td class="text-right">
                                    <a href="{{route('payment.show', $payment->id)}}" class="btn btn-info btn-sm"><i class="material-icons">dvr</i></a>
                                    <form class="form-inline pull-right" action="{{route('payment.destroy', $payment->id)}}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure, you want to delete this payment?')">
                                        <i class="fa fa-trash"></i>
                                      </button>
                                    </form>
                                </td>
                            </tr>
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