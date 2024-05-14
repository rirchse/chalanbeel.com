@extends('admin')
@section('title', 'Edit device')
@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            {!! Form::model($device, ['route' => ['device.update', $device], 'method' => 'PUT', 'id' => 'RegisterValidation', 'files' => true]) !!}
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Edit device</b></h4>
                    </div>
                    <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="text-info" title="Edit" href="/admin/device/{{$device->id}}"><i class="material-icons">dvr</i></a>
                        <a class="text-success" title="View Devices" href="/admin/device"><i class="material-icons">assignment</i></a>
                    </div>
                </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('ip', 'IP Address (*)', ['class' => 'control-label']) }}
                            {{ Form::text('ip', $device->ip, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('mac', 'MAC Address (*)', ['class' => 'control-label']) }}
                            {{ Form::text('mac', $device->mac, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('device_name', 'Device Name/Identity (*)', ['class' => 'control-label']) }}
                            {{ Form::text('device_name', $device->device_name, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('model', 'Device Model/Platform (*)', ['class' => 'control-label']) }}
                            {{ Form::text('model', $device->model_no, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('parent', 'Parent Device:', ['class' => 'control-label']) }}
                            <select name="parent" id="parent" class="form-control">
                                <option value=""></option>
                                @foreach($devices as $value)
                                <option value="{{ $value->id }}" {{$value->id == $device->parent_id?'selected':''}}>{{$value->device_name}} [{{$value->mac}} / {{$value->ip}}]</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('location', 'Location:', ['class' => 'control-label']) }}
                            <select name="location" id="location" class="form-control">
                                <option value=""></option>
                                @foreach($areas as $location)
                                <option value="{{ $location->id }}" {{$location->id == $device->location_id?'selected':''}}>{{ $location->station }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('username', 'Username', ['class' => 'control-label']) }}
                            {{ Form::text('username', $device->username, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
                            {{ Form::text('password', $device->password, ['class' => 'form-control border-input']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('brand', 'Device Brand', ['class' => 'control-label']) }}
                            {{ Form::text('brand', $device->brand, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('wireless_mode', 'Wireless Mode', ['class' => 'control-label']) }}
                            {{ Form::select('wireless_mode', [''=>'', 'AccessPoint'=>'AccessPoint', 'Station'=>'Station', 'Repeater'=>'Repeater'], $device->wireless_mode, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('ssid', 'SSID', ['class' => 'control-label']) }}
                            {{ Form::text('ssid', $device->ssid, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('security', 'SSID Security', ['class' => 'control-label']) }}
                            {{ Form::text('security', $device->security, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('frequency', 'Frequency', ['class' => 'control-label']) }}
                            {{ Form::text('frequency', $device->frequency, ['class' => 'form-control border-input']) }}
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
                            {{ Form::textarea('detail', $device->details, ['class' => 'form-control border-input', 'rows' => '2']) }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right">update</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
        {{-- user details --}}
    </div>

@endsection