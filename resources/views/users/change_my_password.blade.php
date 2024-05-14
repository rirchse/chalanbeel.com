@extends('user')
@section('title', 'Change My Password')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">settings</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Change My Password</h4>

    {!! Form::model($profile, ['route' => ['user.password_change', $profile->id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="row">
            <div class="col-md-12">
                
                <div class="form-group label-floating">
                    {{ Form::label('email', 'Email Address:', ['class' => 'control-label']) }}
                    {{ Form::email('email', $profile->email, ['class' => 'form-control', 'disabled' => 'disabled']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('old_password', 'Old Password', ['class' => 'control-label']) }}
                    {{ Form::password('old_password', ['class' => 'form-control']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('password', 'New Password', ['class' => 'control-label']) }}
                    {{ Form::password('password', ['class' => 'form-control']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('confirm_password', 'Confirm New Password', ['class' => 'control-label']) }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-rose pull-right">Update Password</button>
        <div class="clearfix"></div>
    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection