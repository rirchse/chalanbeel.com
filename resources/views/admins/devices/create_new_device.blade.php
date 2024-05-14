@extends('admin')
@section('title', 'Add New device')
@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            {!! Form::open(['route' => 'device.store', 'method' => 'POST', 'id' => 'RegisterValidation', 'files' => true]) !!}
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Add New device</b></h4>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('ip', 'IP Address (*)', ['class' => 'control-label']) }}
                            {{ Form::text('ip', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('mac', 'MAC Address (*)', ['class' => 'control-label']) }}
                            {{ Form::text('mac', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('device_name', 'Device Name/Identity (*)', ['class' => 'control-label']) }}
                            {{ Form::text('device_name', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('model', 'Device Model/Platform (*)', ['class' => 'control-label']) }}
                            {{ Form::text('model', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('parent', 'Parent Device:', ['class' => 'control-label']) }}
                            <select name="parent" id="parent" class="form-control">
                                <option value=""></option>
                                @foreach($devices as $device)
                                <option value="{{ $device->id }}">{{$device->device_name}} [{{$device->mac}} / {{$device->ip}}]</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('location', 'Location:', ['class' => 'control-label']) }}
                            <select name="location" id="location" class="form-control">
                                <option value=""></option>
                                @foreach($areas as $location)
                                <option value="{{ $location->id }}">{{ $location->station }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('username', 'Username', ['class' => 'control-label']) }}
                            {{ Form::text('username', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
                            {{ Form::text('password', null, ['class' => 'form-control border-input']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('brand', 'Device Brand', ['class' => 'control-label']) }}
                            {{ Form::text('brand', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('wireless_mode', 'Wireless Mode', ['class' => 'control-label']) }}
                            {{ Form::select('wireless_mode', [''=>'', 'AccessPoint'=>'AccessPoint', 'Station'=>'Station', 'Repeater'=>'Repeater'], null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('ssid', 'SSID', ['class' => 'control-label']) }}
                            {{ Form::text('ssid', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('security', 'SSID Security', ['class' => 'control-label']) }}
                            {{ Form::text('security', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('frequency', 'Frequency', ['class' => 'control-label']) }}
                            {{ Form::text('frequency', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="" style="border-bottom:1px solid #ddd;">
                            {{ Form::label('config_file', 'Upload Configuration File:') }}
                            {{ Form::file('config_file') }}
                        </div><br>
                        <div class="" style="border-bottom:1px solid #ddd;">
                            {{ Form::label('image', 'Upload ScreenShot:') }}
                            {{ Form::file('image') }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            {{ Form::label('detail', 'Details:', ['class' => 'control-label']) }}
                            {{ Form::textarea('detail', null, ['class' => 'form-control border-input', 'rows' => '2']) }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-fill pull-right">Save</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
        {{-- user details --}}
    </div>

@endsection