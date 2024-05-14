@extends('admin')
@section('title', 'User Profile')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Edit User Detail</h4>

    {!! Form::model($user,['route' => ['admin.update.user', $user->id], 'method' => 'PUT', 'files' => true]) !!}
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
                    {{ Form::label('job_title', 'Profession', ['class' => 'control-label']) }}
                    {{ Form::text('job_title', $user->job_title, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-rose pull-right">Update User</button>
{!! Form::close() !!}

@if(!count(DB::table('admins')->where('email', $user->email)->get()))

<button type="submit" class="btn btn-warning" onclick="document.getElementById('user_to_admin').style.display = 'block';">Permit as Admin</button>

    {!! Form::model($user, ['route' => ['admin.permit.admin', $user->id], 'method' => 'PUT', 'files' => true]) !!}    

    <div id="user_to_admin" class="swal2-modal swal2-show delete-alert">
        <h2>Are you sure?</h2>
        <div class="swal2-content" style="display: block;">You want to permit this user as admin!</div>
        <hr class="swal2-spacer" style="display: block;">
        <button type="submit" class="btn btn-success"><i class="material-icons">check</i></button>
        <button class="btn btn-danger" type="button" onclick="this.parentNode.style.display = 'none';"><i class="material-icons">close</i></button>
    </div>
    {!! Form::close() !!}
@endif

        <div class="clearfix"></div>
        

                </div>
            </div>
        </div>
    </div>
@endsection