@extends('user')
@section('title', 'Create Payment')
@section('content')

<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">dvr</i>
            </div>
            <div class="card-content">
                <div class="col-md-8">
                    <h4 class="card-title">Package Details</h4>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <style type="text/css">
                        .package-table tr td{padding: 5px!important}
                        </style>
                        <table class="package-table table table-bordered">
                            <tr>
                                <td>Package</td>
                                <td>{{$package->service}}</td>
                            </tr>
                            <tr>
                                <td>Speed</td>
                                <td>{{$package->speed.'bps'}}</td>
                            </tr>
                            <tr>
                                <td>Time Limit </td>
                                <td>{{$package->time_limit}}</td>
                            </tr>
                            <tr>
                                <td>Price </td>
                                <td>{{$package->price}} taka</td>
                            </tr>
                            <tr>
                                <td>VAT </td>
                                <td>0%</td>
                            </tr>
                            <tr>
                                <td>Discount </td>
                                <td><span>{{number_format($package->discount,0)}}</span>%</td>
                            </tr>
                            <tr>
                                <td>Total Price </td>
                                <td><b><span>{{$package->price - ($package->price*$package->discount/100)}}</span></b> taka</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            
            {!! Form::open(['route' => 'user.create.payment', 'method' => 'POST', 'id' => 'RegisterValidation']) !!}
            <input type="hidden" name="service_id" value="{{$package->id}}">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Create Payment</h4>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            {{ Form::label('payment_method', 'Payment Type', ['class' => 'control-label']) }}
                            <select name="payment_method" class="form-control">
                                <option value=""></option>
                                <option value="bKash">bKash</option>
                                <option value="Sure Cash">Sure Cash</option>
                                <option value="Rocket">Rocket</option>
                            </select>
                            <input type="hidden" value="{{$package->package_id}}" name="package_id">
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('transaction_id', 'Transaction ID', ['class' => 'control-label']) }}
                            {{ Form::text('transaction_id', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('account_number', 'Transacted Mobile Number', ['class' => 'control-label']) }}
                            {{ Form::text('account_number', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('paid_amount', 'Paid Amount', ['class' => 'control-label']) }}
                            {{ Form::text('paid_amount', null, ['class' => 'form-control border-input']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-rose btn-fill pull-right">Submit</button>
                    </div>
                    
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection