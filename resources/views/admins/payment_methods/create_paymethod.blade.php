@extends('admin')
@section('title', 'Add Payment Method')
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            
            {!! Form::open(['route' => 'paymethod.store', 'method' => 'POST', 'id' => 'RegisterValidation']) !!}
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Create Payment Method</h4>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('bank_name', 'Bank Name:', ['class' => 'control-label']) }}
                            {{ Form::text('bank_name', null, ['class' => 'form-control border-input']) }}
                        </div>

                        <div class="form-group label-floating">
                            {{ Form::label('payment_system', 'Payment System', ['class' => 'control-label']) }}
                            {{ Form::select('payment_system', [''=>'', 'Cash'=>'Cash', 'bKash'=>'bKash', 'Rocket'=>'Rocket', 'Sure Cash'=>'Sure Cash'], null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('operator', 'Mobile Operator', ['class' => 'control-label']) }}
                            {{ Form::text('operator', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">

                            {{ Form::label('country_code', 'Country Code', ['class' => 'control-label']) }}
                            {{ Form::text('country_code', null, ['class' => 'form-control border-input']) }}
                        </div>

                        
                    </div>

                    <div class="col-md-6">
                        
                        <div class="form-group label-floating">

                            {{ Form::label('account_no', 'Account Number:', ['class' => 'control-label']) }}
                            {{ Form::text('account_no', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">

                            {{ Form::label('detail', 'Details', ['class' => 'control-label']) }}
                            {{ Form::textarea('detail', null, ['class' => 'form-control border-input', 'rows' => '7']) }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right">Create Payment Method</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('scripts')

@endsection