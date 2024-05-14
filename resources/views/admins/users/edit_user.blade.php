@extends('admin')
@section('title', 'Edit User')
@section('content')

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Edit User</h4>
                    <div class="toolbar">
                        <a class="btn btn-simple btn-icon btn-info" href="/admin/user/{{$user->id}}/details" title="User details"><i class="material-icons">dvr</i></a>
                        <a href="/admin/view_users"><i class="material-icons">peoples</i></a>
                    </div>

    {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
    <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('full_name', 'Full Name:', ['class' => 'control-label']) }}
                    {{ Form::text('full_name', $user->full_name, ['class' => 'form-control'])}}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('contact', 'Contact Number:', ['class' => 'control-label']) }}
                    {{ Form::text('contact', $user->contact, ['class' => 'form-control']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('email', 'Email Address:', ['class' => 'control-label']) }}
                    {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('work_at', 'Work At', ['class' => 'control-label']) }}
                    {{ Form::text('work_at', $user->work_at, ['class' => 'form-control datepicker']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('profession', 'Profession', ['class' => 'control-label']) }}
                    {{ Form::text('profession', $user->profession, ['class' => 'form-control']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('join_date', 'Join Date', ['class' => 'control-label']) }}
                    {{ Form::text('join_date', $user->join_date, ['class' => 'form-control']) }}
                </div>
                <div class="form-group label-floating">
                    <select name="location" id="" class="form-control">
                        <option value="">Select Location</option>
                        @foreach($locations as $location)
                        <option value="{{$location->id}}" {{$user->location_id == $location->id?'selected':''}}>{{$location->station}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('date_of_birth', 'Date of Birth (Y-m-d)', ['class' => 'control-label']) }}
                    {{ Form::text('date_of_birth', $user->date_of_birth, ['class' => 'form-control datepicker']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('NID', 'NID Card Number', ['class' => 'control-label']) }}
                    {{ Form::text('NID', $user->nid_no, ['class' => 'form-control']) }}
                </div>
                <div class="fileinput fileinput-new text-center pull-right" data-provides="fileinput" style="width:100%;margin-bottom:15px;border:1px solid #eee">
                    <div class="fileinput-new thumbnail" style="width:100%;">
                        <img class="img-responsive" src="/images/{{$user->nid_image?'nid/'.$user->nid_image:'/nid-sample.jpg'}}" alt="">
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
                        <img class="img-responsive" src="/images/{{$user->image?'profile/'.$user->image:'avatar.png'}}" alt="">
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
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label>Status</label><br>
                    <label><input type="radio" name="status" value="0" {{$user->status == 0? 'checked':''}}><span class="text-warning"> New</span> </label>
                    <label><input type="radio" name="status" value="1" {{$user->status == 1? 'checked':''}}> <span class="text-success"> Active </label>
                    <label><input type="radio" name="status" value="2" {{$user->status == 2? 'checked':''}}> <span class="text-primary"> Free </label>
                    <label><input type="radio" name="status" value="3" {{$user->status == 3? 'checked':''}}> <span class="text-danger"> Cancel </label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group label-floating">
                    {{ Form::label('details', 'Details:', ['class' => 'control-label']) }}
                    {{ Form::textarea('details', $user->details, ['class' => 'form-control', 'rows' => '4']) }}
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-simple btn-danger btn-icon pull-left" title="Delete this user!" onclick="document.getElementById('target').style.display = 'block';"><i class="material-icons">delete</i></a>

        <button type="submit" class="btn btn-primary pull-right"><i class="material-icons">update</i></button>
        <div class="clearfix"></div>
    {!! Form::close() !!}

    {{ Form::open(['route' => ['admin.user.delete', $user->id], 'method' => 'DELETE']) }}
        <div id="target" class="swal2-modal swal2-show delete-alert">
            <h2>Are you sure?</h2>
            <div class="swal2-content" style="display: block;">You want to delete this!</div>
            <hr class="swal2-spacer" style="display: block;">
            <button type="submit" class="btn btn-success"><i class="material-icons">check</i></button>
            <button class="btn btn-danger" type="button" onclick="this.parentNode.style.display = 'none';"><i class="material-icons">close</i></button>
        </div>
    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection