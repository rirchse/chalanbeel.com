@extends('admin')
@section('title', 'Edit Service')
@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            {!! Form::model($service, ['route' => ['service.update', $service->id], 'method' => 'PUT', 'id' => 'RegisterValidation']) !!}
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-8">
                        <h4 class="card-title">Edit Service for <b>{{$service->full_name}}</b></h4>
                    </div>
                    <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="text-success" title="View Active Services" href="/admin/service/active/view"><i class="material-icons">assignment</i></a>
                        <a class="text-primary" title="View All Services" href="/admin/service/all/view"><i class="material-icons">assignment</i></a>
                        <a class="text-info" title="Details" href="/admin/service/{{$service->id}}"><i class="material-icons">dvr</i></a>

                        <a class="text-info" title="View Bills" href="/admin/payment/{{$service->id}}/total_paid"><i class="material-icons">subject</i></a>
                        <a class="btn-simple btn-icon text-warning" title="View Due Bills" href="/admin/payment/{{$service->id}}/total_due"><i class="material-icons">subject</i></a>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('user', 'User:', ['class' => 'control-label']) }}
                            <select name="user" id="user" class="form-control" required disabled>
                                <option value=""></option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{$user->id == $service->user_id?'selected':''}}>{{ $user->full_name.' -> '.$user->contact }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group label-floating">
                            {{ Form::label('package', 'Package:', ['class' => 'control-label']) }}
                            <select name="package" id="package" class="form-control" required>
                                <option value=""></option>
                                @foreach($packages as $package)
                                <option value="{{ $package->id }}" price="{{$package->price}}" {{$package->id == $service->package_id?'selected':''}}>{{ $package->speed.' - '.$package->time_limit.' - '.$package->connection.' - '.$package->price }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('username', 'Username', ['class' => 'control-label']) }}
                            {{ Form::text('username', $service->username, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
                            {{ Form::text('password', $service->password, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('discount', 'Discount %', ['class' => 'control-label']) }}
                            {{ Form::text('discount', $service->discount, ['class' => 'form-control border-input', 'id' => 'discount']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('amount', 'Amount', ['class' => 'control-label']) }}
                            {{ Form::text('amount', $service->amount, ['class' => 'form-control border-input', 'id' => 'amount', 'onkeyup' => 'amountTodiscount()']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('billing_date', 'Billing Date', ['class' => 'control-label']) }}
                            {{ Form::text('billing_date', $service->billing_date, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('billing_plan', 'Billing Plan', ['class' => 'control-label']) }}
                            {{ Form::select('billing_plan', ['Prepaid' => 'Prepaid', 'Postpaid' => 'Postpaid'], $service->billing_plan, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('last_pay_at', 'Last Pay At', ['class' => 'control-label']) }}
                            {{ Form::text('last_pay_at', $service->last_pay_at, ['class' => 'form-control border-input']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <select name="location" id="" class="form-control">
                                <option value="">Select Location</option>
                                @foreach($locations as $location)
                                <option value="{{$location->id}}" {{$service->location_id == $location->id?'selected':''}}>{{$location->station}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('device', 'User Device Information:', ['class' => 'control-label']) }}
                            {{ Form::textarea('device', $service->device, ['class' => 'form-control border-input', 'rows'=>6]) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('mac', 'MAC Address', ['class' => 'control-label']) }}
                            {{ Form::text('mac', $service->mac, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('ip', 'IP Address', ['class' => 'control-label']) }}
                            {{ Form::text('ip', $service->ip, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('left_long', 'Latitude Longitude.', ['class' => 'control-label']) }}
                            {{ Form::text('left_long', $service->left_long, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            <label>Status</label><br>
                            <label><input type="radio" name="status" value="0" {{$service->status == 0? 'checked':''}}><span class="text-warning"> New</span> </label>
                            <label><input type="radio" name="status" value="1" {{$service->status == 1? 'checked':''}}> <span class="text-success"> Active </label>
                            <label><input type="radio" name="status" value="2" {{$service->status == 2? 'checked':''}}> <span class="text-primary"> Free </label>
                            <label><input type="radio" name="status" value="3" onclick="closeDate(this)" {{$service->status == 3? 'checked':''}}> <span class="text-danger"> Close </label>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('close_date', 'Close Date:', ['class' => 'control-label']) }}
                            {{ Form::text('close_date', date('Y-m-d H:i:s'), ['class' => 'form-control border-input']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            {{ Form::label('details', 'Details:', ['class' => 'control-label']) }}
                            {{ Form::textarea('details', $service->details, ['class' => 'form-control border-input', 'rows' => '2']) }}
                        </div>
                        <div class="form-group label-floating">
                            <label for="payment-url" class="payment-url">Payment URL:</label>
                            <input type="url" class="form-control" name="payment-url" value="{{$service->payment_url}}">
                        </div>

                        <a href="/admin/service/{{$service->id}}/delete" style="color:#f00;font-size:16px" onclick="return confirm('Are you sure you want to delete this service? Be sure that it will not back later.')">&times;</a>
                    </div>

                    <button type="submit" class="btn btn-success btn-fill pull-right">Update</button>
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

    var pkg = document.getElementById('package');
    function amountTodiscount(){
        discount.value = Number(pkg.options[pkg.options.selectedIndex].getAttribute('price'))/amount.value*100;
        // discount.value = bill.value/amount.value*100;
    }

    //show cancel date
    function closeDate(elm){
        console.log(elm);
    }
    </script>

@endsection