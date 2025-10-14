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

                  <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data" id="user_form">
                    @csrf
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact">Contact Number:</label>
                                <input type="number" name="contact" class="form-control" minlength="11" maxlength="11" autofocus="true" onkeyup="checkContact(this)">
                            </div>
                              <div class="form-group">
                                  <label for="">Name:</label>
                                  <input type="text" name="name" class="form-control">
                              </div>
                              <div class="form-group">
                                  <label for="">Email:</label>
                                  <input type="email" name="email" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="">Address:</label>
                                <input type="text" name="address" class="form-control">
                              </div>
                              <div class="form-group">
                                  {{ Form::label('work_at', 'Work At', ['class' => 'control-label']) }}
                                  {{ Form::text('work_at', null, ['class' => 'form-control datepicker']) }}
                              </div>
                              <div class="form-group">
                                  {{ Form::label('profession', 'Profession', ['class' => 'control-label']) }}
                                  {{ Form::text('profession', null, ['class' => 'form-control']) }}
                              </div>
                              <div class="form-group">
                                  {{ Form::label('join_date', 'Join Date', ['class' => 'control-label']) }}
                                  {{ Form::date('join_date', date('Y-m-d'), ['class' => 'form-control']) }}
                              </div>
                              <div class="form-group">
                                  <select name="location" id="" class="form-control">
                                      <option value="">Select Location</option>
                                      @foreach($locations as $location)
                                      <option value="{{$location->id}}">{{$location->station}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="form-group">
                                  <input type="text" name="lat_long" id="lat_long" class="form-control" placeholder="Lat Long">
                              </div>
                              <div class="form-group">
                                  <select name="status" id="" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="New">New</option>
                                    <option value="Active">Active</option>
                                    <option value="Expire">Expire</option>
                                    <option value="Cancel">Cancel</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  {{ Form::label('date_of_birth', 'Date of Birth (Y-m-d)', ['class' => 'control-label']) }}
                                  {{ Form::date('date_of_birth', null, ['class' => 'form-control datepicker']) }}
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
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
                              <div class="form-group">
                                  {{ Form::label('details', 'Details:', ['class' => 'control-label']) }}
                                  {{ Form::textarea('details', null, ['class' => 'form-control', 'rows' => '4']) }}
                              </div>
                              <div class="form-group">
                                <div id="map" style="width:100%; height:400px; margin-top:0"></div>
                              </div>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary pull-right">Save</button>
                      <div class="clearfix"></div>
                  </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{'/js/open-map.js?v=1.0.2'}}"></script>
<script>
  function checkContact(e)
  {
    const userForm = document.getElementById('user_form');
    let formdata = new FormData(userForm);
    if(e.value.length == 11)
    {
      $.ajax({
      type: 'GET',
      url: '{{route("user.by-username", "")}}/'+e.value,
      success: function(data){
        let elm = userForm.elements;
        elm.name.value = data.user.name;
        elm.email.value = data.user.email;
        elm.address.value = data.user.address;
        elm.lat_long.value = data.user.lat ? data.user.lat+', '+data.user.lng : '';
        elm.join_date.value = data.user.join_date;
        if(data.user.status)
        {
          elm.status.options[0] = new Option(data.user.status, data.user.status, false, true);
        }

        // console.log(data);
        
      },
      error: function(data){
        console.error(data);
      }
    });

      e.style.borderBottom = '1px solid #fff';
    }
    else
    {
      e.style.borderBottom = '1px solid #f00';
    }
  }
</script>
@endsection