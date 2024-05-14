@extends('home')
@section('title', 'Register')
@section('content')
<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">edit</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Customer Registration</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Attension!</div>
                                    <div class="panel-body">
                                        <span style="color:#f00;font-size:16px;border;1px solid #ddd;">Please register with real information and double check your contact number. You have to be verify your information to complete the registration. You will get username and password by SMS to your registered mobile number when you will request for 1Day free package.</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        {!! Form::open(['route' => 'register', 'method' => 'POST', 'files' => true, 'id' => 'RegisterValidation']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        {{ Form::label('name', 'Your Full Name:', ['class' => 'control-label']) }}
                                        {{ Form::text('name', null, ['class' => 'form-control'])}}
                                    </div>
                                    <div class="form-group label-floating">
                                        {{ Form::label('contact', 'Mobile Number', ['class' => 'control-label']) }}
                                        {{ Form::text('contact', null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group label-floating">
                                        {{ Form::label('contact_confirmation', 'Confirm Mobile Number', ['class' => 'control-label']) }}
                                        {{ Form::text('contact_confirmation', null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group label-floating">
                                        {{ Form::label('email', 'Email Address:', ['class' => 'control-label']) }}
                                        {{ Form::email('email', null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group label-floating">
                                        {{ Form::label('address', 'Address:', ['class' => 'control-label']) }}
                                        {{ Form::textarea('address', null, ['class' => 'form-control', 'rows' => 2]) }}
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            <div class="clearfix"></div>
                        <!--/form-->
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection