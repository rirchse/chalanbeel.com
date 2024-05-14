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
                        <h4 class="card-title">Register User</h4>

                        {!! Form::open(['route' => 'package.store', 'method' => 'POST', 'files' => true, 'id' => 'RegisterValidation']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        {{ Form::label('full_name', 'Your Full Name:', ['class' => 'control-label']) }}
                                        {{ Form::text('full_name', null, ['class' => 'form-control'])}}
                                    </div>
                                    <div class="form-group label-floating">
                                        {{ Form::label('contact', 'Mobile Number', ['class' => 'control-label']) }}
                                        {{ Form::text('contact', null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group label-floating">
                                        {{ Form::label('contact_confirmation', 'Confirm Mobile Number', ['class' => 'control-label']) }}
                                        {{ Form::text('contact_confirmation', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Next</button>
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