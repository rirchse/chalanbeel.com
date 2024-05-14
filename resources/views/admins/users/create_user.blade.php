@extends('admin')
@section('title', 'Create Customer')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Create User</h4>

    {!! Form::open(['route' => 'user.store', 'method' => 'POST', 'files' => true]) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('full_name', 'Full Name:', ['class' => 'control-label']) }}
                    {{ Form::text('full_name', null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('contact', 'Contact Number:', ['class' => 'control-label']) }}
                    {{ Form::text('contact', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('email', 'Email Address:', ['class' => 'control-label']) }}
                    {{ Form::email('email', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('work_at', 'Work At', ['class' => 'control-label']) }}
                    {{ Form::text('work_at', null, ['class' => 'form-control datepicker']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('profession', 'Profession', ['class' => 'control-label']) }}
                    {{ Form::text('profession', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('join_date', 'Join Date', ['class' => 'control-label']) }}
                    {{ Form::date('join_date', date('Y-m-d'), ['class' => 'form-control']) }}
                </div>
                <div class="form-group label-floating">
                    <select name="location" id="" class="form-control">
                        <option value="">Select Location</option>
                        @foreach($locations as $location)
                        <option value="{{$location->id}}">{{$location->station}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('date_of_birth', 'Date of Birth (Y-m-d)', ['class' => 'control-label']) }}
                    {{ Form::date('date_of_birth', null, ['class' => 'form-control datepicker']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('NID', 'NID Card Number', ['class' => 'control-label']) }}
                    {{ Form::text('NID', null, ['class' => 'form-control']) }}
                </div>
                <div class="fileinput fileinput-new text-center pull-right" data-provides="fileinput" style="width:100%;margin-bottom:15px;border:1px solid #eee">
                    <div class="fileinput-new thumbnail" style="width:100%;">
                        <img class="img-responsive" src="/images/nid-sample.jpg" alt="">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn-round btn-rose btn-file btn-small">
                            <span class="btn btn-xs btn-info fileinput-new">Upload NID</span>
                            <span class="fileinput-exists">Change NID</span>
                            <input type="file" name="nid_image" />
                        </span>
                        <br />
                    </div>
                </div>
                <div class="fileinput fileinput-new text-center pull-right" data-provides="fileinput" style="width:100%;border:1px solid #eee">
                    <div class="fileinput-new thumbnail" style="width:160px;">
                        <img class="img-responsive" src="/images/avatar.png" alt="">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn-round btn-rose btn-file btn-small">
                            <span class="btn btn-xs btn-info fileinput-new">Add Photo</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="profile_image" />
                        </span>
                        <br />
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="form-group label-floating">
                    {{ Form::label('details', 'Details:', ['class' => 'control-label']) }}
                    {{ Form::textarea('details', null, ['class' => 'form-control', 'rows' => '4']) }}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Save</button>
        <div class="clearfix"></div>
    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection