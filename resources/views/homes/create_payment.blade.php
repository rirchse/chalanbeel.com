@extends('home')
@section('title', 'Create Payment')
@section('content')

<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
                <div class="col-md-12">
            <div class="card">

            {!! Form::open(['route' => 'user.create.payment', 'method' => 'POST', 'id' => 'RegisterValidation']) !!}
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">subject</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10"><h4 class="card-title">Create Payment</h4></div>
                    <div class="col-md-12">
                        <h4>You have choosen the package:<br> <b>{{$user->service}}</b> by <b>{{$user->connection}}</b> connection speed <b>{{$user->speed}}</b> for <b>{{$user->time_limit}}</b> price <b>{{$user->price}}</b> taka for the location <b>{{$user->station}}</b></h4>
                        <h5>Please use the reference number  {{$user->reference}}at the payment
                    </div>

                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            {{ Form::label('bol_no', 'BOL Number', ['class' => 'control-label']) }}
                            {{ Form::text('bol_no', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('containers', 'Total Containers', ['class' => 'control-label']) }}
                            {{ Form::text('containers', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('weight', 'Total Weight', ['class' => 'control-label']) }}
                            {{ Form::text('weight', null, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">

                            {{ Form::label('vessel', 'Vessel', ['class' => 'control-label']) }}
                            {{ Form::text('vessel', null, ['class' => 'form-control border-input']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        
                        <div class="form-group label-floating">

                            {{ Form::label('cross_dock_no', 'Cross Dock Number', ['class' => 'control-label']) }}
                            {{ Form::text('cross_dock_no', null, ['class' => 'form-control border-input']) }}
                        </div>

                        <div class="form-group label-floating">
                            {{ Form::label('detail', 'Notes', ['class' => 'control-label']) }}
                            {{ Form::textarea('detail', null, ['class' => 'form-control border-input', 'rows' => '7']) }}
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-rose btn-fill pull-right">Confirm BOL</button>
                </div>
            </div>
            </div>
        </div><!-- container -->
            {!! Form::close() !!}

        </div>
    </div>

@endsection