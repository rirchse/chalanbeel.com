@extends('admin')
@section('title', 'Add New Service')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            
            {!! Form::open(['route' => 'service_plan.store', 'method' => 'POST', 'id' => 'RegisterValidation']) !!}
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Add New Service Plan for <b>{{$service->username}}</b></h4>
                    </div>

                    {{Form::hidden('service_id', $service->id)}}

                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            {{ Form::label('amount', 'Amount (*):', ['class' => 'control-label']) }}
                            {{ Form::number('amount', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('billing_date', 'Billing Date (*):', ['class' => 'control-label']) }}
                            {{ Form::date('billing_date', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('closed_at', 'Closed At:', ['class' => 'control-label']) }}
                            {{ Form::date('closed_at', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('billing_status', 'Billing Status (*):', ['class' => 'control-label']) }}
                            {{ Form::select('billing_status', ['' => '', 'Open' => 'Open', 'Closed' => 'Closed'], null, ['class' => 'form-control border-input', 'rows' => '2']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('note', 'Note:', ['class' => 'control-label']) }}
                            {{ Form::textarea('note', null, ['class' => 'form-control border-input', 'rows' => '2']) }}
                        </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right">Save</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
        {{-- user details --}}
    </div>

    <script type="text/javascript">
    var amount = document.getElementById('amount');
    var bill = document.getElementById('bill');
    var payable = document.getElementById('payable');
    var discount = document.getElementById('discount');
    discount.addEventListener('keyup', change);
    function change(){
        //
        var pay = Number(amount.innerHTML) - (Number(amount.innerHTML)/100*discount.value);
        payable.innerHTML = pay;
        bill.value = pay;
    }
    change();

    function amountTodiscount(){
        discount.value = bill.value/Number(amount.innerHTML)*100;
    }
    </script>

@endsection