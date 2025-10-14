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
                        <a class="btn btn-sm btn-info" href="{{route('user.show', $user->id)}}" title="User details"><i class="fa fa-file"></i></a>

                        <a class="btn btn-success btn-sm" href="{{route('user.index')}}"><i class="fa fa-list"></i></a>

                        <form class="pull-right" action="{{route('user.destroy', $user->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>

                    {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    {{ Form::label('name', 'Full Name:', ['class' => 'control-label']) }}
                                    {{ Form::text('name', $user->name, ['class' => 'form-control'])}}
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
                                  <label for="join_date">Join Date</label>
                                  <input type="date" class="form-control" name="join_date" value="$user->join_date">
                                </div>
                                <div class="form-group label-floating">
                                    <select name="location" id="" class="form-control">
                                        <option value="">Select Location</option>
                                        @foreach($locations as $location)
                                        <option value="{{$location->id}}" {{$user->location_id == $location->id?'selected':''}}>{{$location->station}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Lat Lang</label>
                                  <input type="text" name="lat_long" class="form-control" placeholder="00.00000, 00.00000" value="{{$user->lat ? $user->lat.', '.$user->lng:''}}" id="lat_long">
                                </div>
                                <div class="form-group label-floating">
                                    <label>Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control">
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
                              <div class="form-group">
                                <select name="status" class="form-control" id="status">
                                  <option value="">Select One</option>
                                  <option value="New" {{$user->status == 'New'? 'selected': ''}}>New</option>
                                  <option value="Active" {{$user->status == 'Active'? 'selected': ''}} >Active</option>
                                  <option value="Expire" {{$user->status == 'Expire'? 'selected': ''}}>Expire</option>
                                  <option value="Cancel" {{$user->status == 'Cancel'? 'selected': ''}}>Cancel</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    {{ Form::label('details', 'Details:', ['class' => 'control-label']) }}
                                    {{ Form::textarea('details', $user->details, ['class' => 'form-control', 'rows' => '4']) }}
                                </div>
                                <div class="form-group">
                                  <div id="map" style="width:100%; height:400px; margin-top:0"></div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right"><i class="material-icons">update</i></button>
                        <div class="clearfix"></div>
                    {!! Form::close() !!}

    

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{'/js/open-map.js?v=1.0.2'}}"></script>
@endsection