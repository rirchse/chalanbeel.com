@extends('user')
@section('title', 'Add New Service')
@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            {!! Form::open(['route' => 'user.create.service', 'method' => 'POST', 'id' => 'RegisterValidation']) !!}
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Add New Service</h4>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('service', 'Service:', ['class' => 'control-label']) }}
                            <select name="service" id="" class="form-control">
                                @foreach(DB::table('packages')->groupBy('service')->select('service')->get() as $service)
                                <option value="{{$service->service}}">{{$service->service}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('connection', 'Connection:', ['class' => 'control-label']) }}
                            <select name="connection" id="" class="form-control">
                                <option value=""></option>
                                @foreach(DB::table('packages')->groupBy('connection')->select('connection')->get() as $service)
                                <option value="{{$service->connection}}">{{$service->connection}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('speed', 'Speed:', ['class' => 'control-label']) }}
                            <select name="speed" id="" class="form-control">
                                <option value=""></option>
                                @foreach(DB::table('packages')->groupBy('speed')->select('speed')->get() as $service)
                                <option value="{{$service->speed}}">{{$service->speed}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('time_limit', 'Time Limit:', ['class' => 'control-label']) }}
                            <select name="time_limit" id="" class="form-control">
                                <option value=""></option>
                                @foreach(DB::table('packages')->groupBy('time_limit')->select('time_limit')->get() as $service)
                                <option value="{{$service->time_limit}}">{{$service->time_limit}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('area', 'Location:', ['class' => 'control-label']) }}
                            <select name="area" id="area" class="form-control">
                                <option value=""></option>
                                @foreach($locations as $area)
                                <option value="{{ $area->id }}">{{ $area->station }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('device', 'User Device', ['class' => 'control-label']) }}
                            <select name="device" class="form-control">
                                <option value=""></option>
                                <option value="Computer">Computer</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Router">Router</option>
                                <option value="Wireless Router">Wireless Router</option>
                                <option value="Mobile Wifi">Mobile Wifi</option>
                                <option value="Smart TV">Smart TV</option>
                                <option value="Smart TV Box">Smart TV Box</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('mac', 'MAC Address', ['class' => 'control-label']) }}
                            {{ Form::text('mac', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('left_long', 'Latitude Longitude.', ['class' => 'control-label']) }}
                            {{ Form::text('left_long', null, ['class' => 'form-control border-input']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            {{ Form::label('detail', 'Details:', ['class' => 'control-label']) }}
                            {{ Form::textarea('detail', null, ['class' => 'form-control border-input', 'rows' => '2']) }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right">Add</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
        {{-- user details --}}
    </div>

@endsection