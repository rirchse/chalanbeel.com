@extends('home')
@section('title', 'Register')
@section('content')
<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Customer Registration</h4>

    {!! Form::open(['route' => 'check.payment', 'method' => 'POST', 'files' => true, 'id' => 'RegisterValidation']) !!}
    <!--form ng-submit="register()"-->
        <div class="row">
            <div class="col-md-12">
                <h4>Payment <span style="color:#f00;font-weight:bold;float:right"><img src="/images/icons/bkash.png" style="width:120px"> 016 21 57 55 17</span></h4>
                <div class="form-group label-floating">
                    {{ Form::label('payment_method', '--- Payment Method ---', ['class' => 'control-label']) }}
                    <select name="payment_method" class="form-control border-input">
                            @foreach($payments as $paymethod)
                            <option value="{{ $paymethod->id }}"><b>{{ $paymethod->payment_system}} &nbsp;&nbsp;&nbsp; - {{ $paymethod->bank_name }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('paid_mobile_no', 'Paid Mobile Number.', ['class' => 'control-label']) }}
                    {{ Form::text('paid_mobile_no', null, ['class' => 'form-control', 'ng-model' => 'mobile_no']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('transaction_id', 'Transaction ID (TrxID)', ['class' => 'control-label']) }}
                    {{ Form::text('transaction_id', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-rose pull-right">Payment Check</button>
        <div class="clearfix"></div>
    <!--/form-->
    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection