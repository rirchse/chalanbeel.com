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

                    <form action="{{route('user.update', $user->id)}}" method="POST" enctype="multipart/form-data" id="user_form">
                      @csrf
                      @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="contact">Mobile Number(*):</label>
                                  <input type="number" name="contact" id="contact" class="form-control" minlength="11" maxlength="11" autofocus="true" required value="{{$user->contact}}">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="">Name(*):</label>
                                  <input type="text" name="name" class="form-control" required value="{{$user->name}}">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <input type="text" name="address" class="form-control" placeholder="Street Address" value="{{$user->address}}">
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{$user->email}}">
                                </div>
                              </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Join Date:</label>
                                    <input type="date" name="join_date" class="form-control" value="{{$user->join_date}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Billing Date:</label>
                                    <input type="date" name="billing_date" class="form-control" value="{{$user->billing_date}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Next Payment Date:</label>
                                    <input type="date" name="payment_date" class="form-control" value="{{$user->payment_date}}">
                                </div>
                                <div class="form-group">
                                    <select name="status" id="" class="form-control">
                                      <option value="">Select Status:</option>
                                      <option value="New" {{$user->status == 'New'? 'selected':''}}>New</option>
                                      <option value="Active" {{$user->status == 'Active'? 'selected':''}}>Active</option>
                                      <option value="Deactive" {{$user->status == 'Deactive'? 'selected':''}}>Deactive</option>
                                      <option value="Expire" {{$user->status == 'Expire'? 'selected':''}}>Expire</option>
                                      <option value="Cancel" {{$user->status == 'Cancel'? 'selected':''}}>Cancel</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <input type="text" name="lat_long" id="lat_long" class="form-control" placeholder="Lat Long" value="{{$user->lat_long}}">
                                    <span class="input-group-addon">
                                      <button type="button" data-toggle="modal" data-target="#map_modal">
                                        <i class="fa fa-map"></i>
                                      </button>
                                    </span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <select name="package_id" id="package" class="form-control">
                                    <option value="">Select Package:</option>
                                    @foreach($packages as $package)
                                    <option value="{{$package->id}}" {{($user->package?$user->package->id:'') == $package->id ? 'selected':''}}>{{$package->speed}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                    <select name="service_type" id="service_type" class="form-control" onchange="selectService(this)">
                                      <option value="">Service Type:</option>
                                      <option value="PPPoE" {{$user->service_type == 'PPPoE'? 'selected':''}}>PPPoE</option>
                                      <option value="Static" {{$user->service_type == 'Static'? 'selected':''}}>Static</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="location" id="" class="form-control">
                                        <option value="">Select POP/OLT</option>
                                        <option value="Bildahor" {{$user->location == 'Bildahor'? 'selected':''}}>Bildahor</option>
                                        <option value="Nazirpur" {{$user->location == 'Nazirpur'? 'selected':''}}>Nazirpur</option>
                                        <option value="Chanchkoir" {{$user->location == 'Chanchkoir'? 'selected':''}}>Chanchkoir</option>
                                        <option value="Ganadanagar" {{$user->location == 'Ganadanagar'? 'selected':''}}>Ganadanagar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="pon" id="pon" class="form-control" onchange="checkIP(this)">
                                      <option value="">Select PON:</option>
                                      <option value="PON1" {{$user->pon == 'PON1'? 'selected':''}}>PON1</option>
                                      <option value="PON2" {{$user->pon == 'PON2'? 'selected':''}}>PON2</option>
                                      <option value="PON3" {{$user->pon == 'PON3'? 'selected':''}}>PON3</option>
                                      <option value="PON4">PON4</option>
                                      <option value="RADIO" {{$user->pon == 'RADIO'? 'selected':''}}>RADIO</option>
                                    </select>
                                </div>
                                <div id="serviceParts">
                                  @if($user->service_type == 'Static')
                                  <div class="form-group">
                                      <select name="ip" id="static" class="form-control">
                                        <option value="">Select IP:</option>
                                        <option value="{{$user->ip}}" selected>{{$user->ip}}</option>
                                      </select>
                                  </div>
                                  @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="mac" placeholder="ONU MAC Address:" value="{{$user->mac}}">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="balance" placeholder="Balance" value="{{$user->balance ? $user->balance : 0}}" onwheel="event.currentTarget.blur()">
                                </div>
                              </div>
                              <div class="col-md-12">
                                
                                <div class="form-group">
                                  <label for="">Details:</label>
                                  <textarea class="form-control" name="details" id="" rows="2" placeholder="write details here...">{{$user->details}}</textarea>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                            
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="">National ID Number</label>
                                  <input type="text" name="nid_no" class="form-control">
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
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="">Add Photo:</label>
                              </div>
                              <div class="form-group fileinput fileinput-new text-center pull-right" data-provides="fileinput" style="width:100%;border:1px solid #eee">
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
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Created at:</label>
                              <input type="datetime-local" name="created_at" class="form-control" value="{{$user->created_at}}">
                          </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Updated at:</label>
                              <input type="datetime-local" name="updated_at" class="form-control" value="{{$user->updated_at}}">
                            </div>
  
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                        <div class="clearfix"></div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="map_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Google Map</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div id="map" style="width:100%; height:400px; margin-top:0"></div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Done</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{'/js/open-map.js?v=1.0.2'}}"></script>
<script>
  // function checkContact(e)
  // {
  //   const userForm = document.getElementById('user_form');
  //   let formdata = new FormData(userForm);
  //   if(e.value.length == 11)
  //   {
  //     $.ajax({
  //     type: 'GET',
  //     url: '{{route("user.by-username", "")}}/'+e.value,
  //     success: function(data){
  //       // console.log(data);
  //       let elm = userForm.elements;
  //       elm.name.value = data.user.name;
  //       elm.email.value = data.user.email;
  //       elm.address.value = data.user.address;
  //       elm.lat_long.value = data.user.lat_long;
  //       elm.join_date.value = data.user.join_date;
  //       elm.billing_date.value = data.user.billing_date;
  //       elm.payment_date.value = data.user.payment_date;

  //       if(data.user.status)
  //       {
  //         elm.status.options[0] = new Option(data.user.status, data.user.status, false, true);
  //       }

  //       if(data.user.location)
  //       {
  //         elm.location.options[0] = new Option(data.user.location, data.user.location, false, true);
  //       }

  //       if(data.user.package == null)
  //       {
  //         elm.package.options[0] = new Option('Select Package', '', false, true);
  //       }
  //       else
  //       {
  //         elm.package.options[0] = new Option(data.user.package.speed, data.user.package.id, false, true);
  //       }

  //       if(data.user.service_type == null)
  //       {
  //         elm.service_type.options[0] = new Option('Select Service', '', false, true);
  //       }
  //       else
  //       {
  //         elm.service_type.options[0] = new Option(data.user.service_type, data.user.service_type, false, true);

  //         selectService(document.getElementById('service_type'));

  //         if(data.user.service_type == 'PPPoE')
  //         {
  //           elm.username.value = data.user.username;
  //           elm.service_password.value = data.user.service_password;
  //         }
  //         else if(data.user.service_type == 'Static')
  //         {
  //           elm.ip.options[0] = new Option(data.user.ip, data.user.ip, false, true);

  //           // checkIP(document.getElementById('pon'));
  //           // elm.ip.value = data.user.ip;
  //         }
  //         else
  //         {
  //           serviceParts.innerHTML = '';
  //         }
  //       }

  //       if(data.user.pon)
  //       {
  //         elm.pon.options[0] = new Option(data.user.pon, data.user.pon, false, true);
  //       }

  //       if(data.user.service_type == 'PPPoE')
  //       {
  //         elm.username.value = data.user.username;
  //         elm.service_password.value = data.user.service_password;
  //       }
  //       else
  //       {
  //         elm.ip.options[0] = new Option(data.user.ip, data.user.ip, false, true);
  //         // checkIP(document.getElementById('pon'));
  //         // elm.ip.value = data.user.ip;
  //       }
        
  //       elm.mac.value = data.user.mac;

  //       elm.work_at.value = data.user.work_at;
  //       elm.profession.value = data.user.profession;
  //       elm.date_of_birth.value = data.user.date_of_birth;
  //       elm.details.value = data.user.details;
        
  //     },
  //     error: function(data){
  //       console.error(data);
  //     }
  //   });

  //     e.style.borderBottom = '1px solid #fff';
  //   }
  //   else
  //   {
  //     e.style.borderBottom = '1px solid #f00';
  //   }
  // }

  // onload call 
  // checkContact(document.getElementById('contact'));

  function selectService(e)
  {
    const serviceParts = document.getElementById('serviceParts');
    let service = e.options[e.selectedIndex];

    if(service.value == 'PPPoE')
    {
      serviceParts.innerHTML = '<div class="form-group">'+
                                  '<input type="text" name="username" id="" class="form-control" placeholder="Username" value="{{$user->username}}">'+
                              '</div>'+
                              '<div class="form-group">'+
                                  '<input type="text" name="service_password" id="" class="form-control" placeholder="Service Password">'+
                              '</div>';
    }
    else
    {
      serviceParts.innerHTML = '<div class="form-group">'+
                                  '<select name="ip" id="static" class="form-control">'+
                                    '<option value="{{$user->ip}}">{{$user->ip ? $user->ip : "Select IP:"}}</option>'+
                                  '</select>'+
                              '</div>';
    }
  }

  function checkIP(e)
  {    
    const service_type = document.getElementById('service_type');
    if(service_type.options[service_type.selectedIndex].value == 'Static')
    {
      const static = document.getElementById('static');
      const ipblock = e.options[e.selectedIndex];
      $.ajax({
        url: '{{route("user.check-ip", "")}}/'+ipblock.value,
        type: 'GET',
        success: function(data){
          let options = '<option value="{{$user->ip}}">{{$user->ip ? $user->ip : "Select IP:"}}</option>';
          data.ip.forEach((i) => {
            options += '<option value="'+i+'">'+i+'</option>';
          });

          static.innerHTML = options;
        },
        error: function(data){
          console.error(data);
        }
      });
    }
    
  }
</script>
@endsection