@extends('admin')
@section('title', 'User Profile')
@section('content')

<?php $admin = Auth::guard('admin')->user() ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Edit Admin Detail</h4>

    {!! Form::model($user,['route' => ['admin.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('first_name', 'First Name:', ['class' => 'control-label']) }}
                    {{ Form::text('first_name', $user->first_name, ['class' => 'form-control'])}}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('last_name', 'Last Name:', ['class' => 'control-label']) }}
                    {{ Form::text('last_name', $user->last_name, ['class' => 'form-control'])}}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('email', 'Email Address:', ['class' => 'control-label']) }}
                    {{ Form::email('email', $user->email, ['class' => 'form-control', 'disabled' => '']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="fileinput fileinput-new text-center pull-right" data-provides="fileinput" style="width:250px;">
                    <div class="fileinput-new thumbnail" style="width:160px;">
                        <img class="img-responsive" src="/images/{{($user->image)? 'profile/'.$user->image : 'avatar.png' }}" alt="">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn-round btn-rose btn-file btn-small">
                            <span class="fileinput-new">Add Photo</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="profile_image" />
                        </span>
                        <br />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group label-floating">
                    {{ Form::label('contact', 'Contact No.', ['class' => 'control-label']) }}
                    {{ Form::text('contact', $user->contact, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group label-floating">
                    {{ Form::label('dob', 'Date of Birth', ['class' => 'control-label']) }}
                    {{ Form::text('dob', $user->dob, ['class' => 'form-control datepicker']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group label-floating">
                    {{ Form::label('job_title', 'Designation', ['class' => 'control-label']) }}
                    {{ Form::text('job_title', $user->job_title, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        @if($admin->user_role == 'ADMIN')
        <a href="/admin/password/{{$user->id}}/edit" class="btn btn-warning pull-left">Change Password</a>
        @endif
        <button type="submit" class="btn btn-rose pull-right">Update User</button>
{!! Form::close() !!}

        <div class="clearfix"></div>
        

                </div>
            </div>
        </div>
    </div>
@endsection