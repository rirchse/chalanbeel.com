@extends('admin')
@section('title', 'Create User Payment')
@section('content')
    
<div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Create User Payment</h4>

                    {!! Form::open(['route' => 'payment.store', 'method' => 'POST', 'id' => 'RegisterValidation']) !!}
                    {{ Form::hidden('cust_id', $customer->id) }}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <div class="form-selct">
                                    {{ Form::label('payment_method', 'Payment Method', ['class' => 'control-label']) }}
                                    <select name="payment_method" class="form-control border-input">
                                        <option value=""></option>
                                        <option value="Cash">Cash</option>
                                        @foreach($paymethods as $paymethod)
                                        <option value="{{ $paymethod->id }}">{{ $paymethod->payment_system }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group label-floating">                                
                                {{ Form::label('received_amount', 'Received Amount', ['class' => 'control-label container-label']) }}
                                {{ Form::text('received_amount', null, ['class' => 'form-control border-input']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating">                                
                                {{ Form::label('account_number', 'Account Number', ['class' => 'control-label container-label']) }}
                                {{ Form::text('account_number', null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('trxid', 'Transaction ID (TrxID)', ['class' => 'control-label container-label']) }}
                                {{ Form::text('trxid', 'cbtcpay', ['class' => 'form-control border-input']) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group label-floating">
                                {{ Form::label('detail', 'Details', ['class' => 'control-label']) }}
                                {{ Form::textarea('detail', null, ['class' => 'form-control border-input', 'rows' => '5']) }}
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-rose btn-fill pull-right">Create</button> 
                    {!! Form::close() !!}
                                     
                </div>
            </div>
        </div><!--main-column-8 -->
        <div class="col-md-4">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="#pablo">
                    <img src="{{$base_url}}/images/{{ ($customer->image? $customer->image:'avatar.png') }}" class="img">
                </a>
            </div>

            <div class="card-body"><br>
                <h4 class="card-title"><b>{{ $customer->first_name.' '.$customer->last_name }}</b></h4>
                <h6 class="card-category text-gray"></b>{{ $customer->contact }}</b></h6>
                <a class="btn btn-rose btn-round" href="#pablo">details</a>
            </div>
        </div>
    </div>
    </div><!-- end row --> 
@endsection

@section('scripts')

@endsection