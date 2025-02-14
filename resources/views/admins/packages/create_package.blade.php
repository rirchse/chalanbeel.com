@extends('admin')
@section('title', 'Add Package')
@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">

            <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-6">
                        <h4 class="card-title">Create Package</h4>
                    </div>

                    {!! Form::open(['route' => 'package.store', 'method' => 'POST', 'id' => 'RegisterValidation']) !!}

                    <div class="row">
                        <div class=" col-md-6">
                            <div class="form-group label-floating">                                
                                {{ Form::label('service', 'Service Name', ['class' => 'control-label container-label']) }}
                                {{ Form::select('service', [ ''=>'', 'Internet' => 'Internet', 'Software' => 'Software'], null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('connection', 'Connection Mode', ['class' => 'control-label container-label']) }}
                                {{ Form::select('connection', [ ''=>'', 'Cable' => 'Cable', 'WiFi' => 'WiFi'], null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('speed', 'Speed [example: 1MB]', ['class' => 'control-label container-label']) }}
                                {{ Form::text('speed', null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('time_limit', 'Time Limit', ['class' => 'control-label container-label']) }}
                                {{ Form::select('time_limit', [ ''=>'', '1Day' => '1Day', '5Days' => '5Days', '10Days' => '10Days', '30Days' => '30Days'], null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('price', 'Price', ['class' => 'control-label container-label']) }}
                                {{ Form::number('price', null, ['class' => 'form-control border-input']) }}
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group label-floating">                                
                                {{ Form::label('discount', 'Discount', ['class' => 'control-label container-label']) }}
                                {{ Form::number('discount', null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                <label>Status:</label><br>
                                <input type="radio" name="status" value="1"> Active &nbsp; 
                                <input type="radio" name="status" value="0"> Inactive
                            </div>
                            <div class="form-group label-floating">                                
                                {{ Form::label('details', 'Details', ['class' => 'control-label container-label']) }}
                                {{ Form::textarea('details', null, ['class' => 'form-control border-input', 'rows' => 6]) }}
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