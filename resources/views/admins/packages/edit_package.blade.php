@extends('admin')
@section('title', 'Edit Package')
@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">

            <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-6">
                        <h4 class="card-title">Edit Package</h4>
                    </div>
                    <div class="toolbar">
                        <a class="btn-simple btn-icon text-info" href="/admin/package/{{$package->id}}" title="Details"><i class="material-icons">dvr</i></a>
                        <a class="btn-simple btn-icon text-success" href="/admin/package" title="View"><i class="material-icons">subject</i></a>
                    </div>

                    {!! Form::model($package, ['route' => ['package.update',$package->id], 'method' => 'PUT', 'id' => 'RegisterValidation']) !!}

                    <div class="row">
                        <div class=" col-md-6">
                            <div class="form-group label-floating">                                
                                {{ Form::label('service', 'Service Name', ['class' => 'control-label container-label']) }}
                                {{ Form::select('service', [ ''=>'', 'Internet' => 'Internet', 'Software' => 'Software'], $package->service, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('service_mode', 'Service Mode', ['class' => 'control-label container-label']) }}
                                {{ Form::select('service_mode', [ ''=>'', 'pppoe' => 'pppoe', 'hotspot' => 'hotspot'], $package->service_mode, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('connection', 'Connection Mode', ['class' => 'control-label container-label']) }}
                                {{ Form::select('connection', [ ''=>'', 'Cable' => 'Cable', 'WiFi' => 'WiFi'], $package->connection, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('speed', 'Speed [example: 1MB]', ['class' => 'control-label container-label']) }}
                                {{ Form::text('speed', $package->speed, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('time_limit', 'Time Limit', ['class' => 'control-label container-label']) }}
                                {{ Form::select('time_limit', [ ''=>'', '1Day' => '1Day', '5Days' => '5Days', '10Days' => '10Days', '30Days' => '30Days'], $package->time_limit, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('price', 'Price', ['class' => 'control-label container-label']) }}
                                {{ Form::number('price', $package->price, ['class' => 'form-control border-input']) }}
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group label-floating">                                
                                {{ Form::label('discount', 'Discount', ['class' => 'control-label container-label']) }}
                                {{ Form::number('discount', $package->discount, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('server', 'Server', ['class' => 'control-label container-label']) }}
                                {{ Form::text('server', $package->server, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                <label>Status:</label><br>
                                <input type="radio" name="status" value="1" {{$package->status == 1? 'checked':''}}> Active &nbsp; 
                                <input type="radio" name="status" value="0" {{$package->status != 1? 'checked':''}}> Inactive
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('details', 'Details', ['class' => 'control-label container-label']) }}
                                {{ Form::textarea('details', $package->details, ['class' => 'form-control border-input', 'rows'=> 6]) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right"><i class="material-icons">save</i> Save</button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>

@endsection