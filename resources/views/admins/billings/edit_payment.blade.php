@extends('admin')
@section('title', 'Edit Payment Receive')
@section('content')
    
<div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Edit Payment</h4>
                    <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="text-success" title="View Paid Bills" href="/admin/bill/paid/view"><i class="material-icons">assignment</i></a>
                        <a class="text-primary" title="View Due Bills" href="/admin/bill/due/view"><i class="material-icons">assignment</i></a>
                        <a class="text-info" title="View Details" href="/admin/payment/{{$payment->id}}"><i class="material-icons">dvr</i></a>
                        <a class="text-info" title="View Paid Bills of" href="/admin/payment/{{$payment->service_id}}/total_paid"><i class="material-icons">subject</i></a>
                        <a class="btn-simple btn-icon text-warning" title="View Due Bills of" href="/admin/payment/{{$payment->service_id}}/total_due"><i class="material-icons">subject</i></a>
                    </div>
                </div>
                    

                    {!! Form::model($payment, ['route' => ['payment.update', $payment->id], 'method' => 'PUT', 'id' => 'RegisterValidation']) !!}
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group label-floating">
                                <div class="form-selct">
                                    {{ Form::label('payment_method', 'Payment Method', ['class' => 'control-label']) }}
                                    <select name="payment_method" class="form-control border-input" id="hide_ctrl">
                                        <option value=""></option>
                                        @foreach($paymethods as $paymethod)
                                        <option value="{{ $paymethod->id }}" {{$paymethod->id == $payment->paymethod_id? 'selected':''}}>{{ $paymethod->payment_system }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group label-floating">
                                <select name="service_id" id="" class="form-control">
                                    <option value="">Service</option>
                                    @foreach($services as $service)
                                    <option value="{{$service->id}}" {{$service->id == $payment->service_id? 'selected':''}}>{{$service->contact.' - '.$service->full_name.' :: '.$service->speed.' - '.$service->connection}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('received_amount', 'Received Amount', ['class' => 'control-label container-label']) }}
                                {{ Form::text('received_amount', $payment->receive, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating hide_field">
                                {{ Form::label('account_number', 'Account Number', ['class' => 'control-label container-label']) }}
                                {{ Form::text('account_number', $payment->account_no, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating hide_field">
                                {{ Form::label('reference_number', 'Reference Number (Ref.)', ['class' => 'control-label container-label']) }}
                                {{ Form::text('reference_number', $payment->refer_no, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating hide_field">
                                {{ Form::label('trxid', 'Transaction ID (TrxID)', ['class' => 'control-label container-label']) }}
                                {{ Form::text('trxid', $payment->trxid, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('receive_date', 'Receive Date(Y-m-d)', ['class' => 'control-label container-label']) }}
                                {{ Form::text('receive_date', $payment->receive_date, ['class' => 'form-control border-input']) }}
                                <small style="color:red">Double check receive date!</small>
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('billing_month', 'Billing Month(Y-m)', ['class' => 'control-label container-label']) }}
                                {{ Form::text('billing_month', $payment->billing_month, ['class' => 'form-control border-input']) }}
                                <small style="color:red">Double check billing month!</small>
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('detail', 'Details', ['class' => 'control-label']) }}
                                {{ Form::textarea('detail', $payment->details, ['class' => 'form-control border-input', 'rows' => '2']) }}
                            </div>

                        </div>
                    </div>
                    <a href="/admin/payment/{{$payment->id}}/delete" class="btn btn-simple btn-danger btn-icon" title="Delete this item." onclick="return confirm('Are you sure you want to delete this item?')"><i class="material-icons">delete</i></a>
                    <button type="submit" class="btn btn-rose btn-fill pull-right">Update</button> 
                    {!! Form::close() !!}
                                     
                </div>
            </div>
        </div>
    </div><!-- end row -->
@endsection
@section('scripts')
    <script>
    var hide_field = document.getElementsByClassName('hide_field');
    var hide_ctrl = document.getElementById('hide_ctrl');
    hide_ctrl.addEventListener('change', change);
    function change(){
        if(hide_ctrl.options[hide_ctrl.selectedIndex].innerHTML == 'Cash') {
            for(var x = 0; x < hide_field.length; x++){
                hide_field[x].style.display = 'none';
            }
        } else {
            for(var x = 0; x < hide_field.length; x++){
                hide_field[x].style.display = 'block';
            }
        }
    }
    change();
    </script>
@endsection