@extends('admin')
@section('title', 'Add New Area')
@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            {!! Form::open(['route' => 'location.store', 'method' => 'POST', 'id' => 'RegisterValidation']) !!}
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Add New Area</b></h4>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('station', 'Station Name', ['class' => 'control-label']) }}
                            {{ Form::text('station', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('area', 'Location', ['class' => 'control-label']) }}
                            {{ Form::text('area', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('village', 'Village', ['class' => 'control-label']) }}
                            {{ Form::text('village', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('address', 'Address', ['class' => 'control-label']) }}
                            {{ Form::text('address', null, ['class' => 'form-control border-input']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('city', 'City', ['class' => 'control-label']) }}
                            {{ Form::text('city', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('state', 'State', ['class' => 'control-label']) }}
                            {{ Form::text('state', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('zip', 'ZIP Code', ['class' => 'control-label']) }}
                            {{ Form::text('zip', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('contact', 'Contact Number', ['class' => 'control-label']) }}
                            {{ Form::text('contact', null, ['class' => 'form-control border-input']) }}
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