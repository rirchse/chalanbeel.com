@extends('admin')
@section('title', 'edit Payment Method')
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            
            {!! Form::model($paymethod, ['route' => ['paymethod.update', $paymethod->id], 'method' => 'PUT', 'id' => 'RegisterValidation']) !!}
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Edit Payment Method</h4>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('bank_name', 'Bank Name:', ['class' => 'control-label']) }}
                            {{ Form::text('bank_name', $paymethod->bank_name, ['class' => 'form-control border-input']) }}
                        </div>

                        <div class="form-group label-floating">
                            {{ Form::label('payment_system', 'Payment System', ['class' => 'control-label']) }}
                            {{ Form::text('payment_system', $paymethod->payment_system, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('operator', 'Mobile Operator', ['class' => 'control-label']) }}
                            {{ Form::text('operator', $paymethod->operator, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">

                            {{ Form::label('country_code', 'Country Code', ['class' => 'control-label']) }}
                            {{ Form::text('country_code', $paymethod->country_code, ['class' => 'form-control border-input']) }}
                        </div>

                        
                    </div>

                    <div class="col-md-6">
                        
                        <div class="form-group label-floating">

                            {{ Form::label('account_no', 'Account Number:', ['class' => 'control-label']) }}
                            {{ Form::text('account_no', $paymethod->account_number, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">

                            {{ Form::label('details', 'Details', ['class' => 'control-label']) }}
                            {{ Form::textarea('details', $paymethod->detail, ['class' => 'form-control border-input', 'rows' => '7']) }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right"><i class="material-icons">save</i> Save</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('scripts')

@endsection