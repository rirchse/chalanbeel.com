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
                  <h4 class="card-title">Create/Update User</h4>

                  <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data" id="user_form">
                    @csrf
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact">Mobile Number(*):</label>
                                <input type="number" name="contact" class="form-control" minlength="11" maxlength="11" autofocus="true" onkeyup="checkContact(this)" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name(*):</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <input type="text" name="address" class="form-control" placeholder="Street Address">
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <input type="email" name="email" class="form-control" placeholder="Email Address">
                              </div>
                            </div>
                          <div class="clearfix"></div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="">Join Date:</label>
                                  <input type="date" name="join_date" class="form-control">
                              </div>
                              <div class="form-group">
                                  <label for="">Billing Date:</label>
                                  <input type="date" name="billing_date" class="form-control">
                              </div>
                              <div class="form-group">
                                  <label for="">Next Payment Date:</label>
                                  <input type="date" name="payment_date" class="form-control">
                              </div>
                              <div class="form-group">
                                  <select name="status" id="" class="form-control">
                                    <option value="">Select Status:</option>
                                    <option value="New">New</option>
                                    <option value="Active">Active</option>
                                    <option value="Deactive">Deactive</option>
                                    <option value="Expire">Expire</option>
                                    <option value="Cancel">Cancel</option>
                                  </select>
                              </div>
                              <div class="input-group">
                                  <input type="text" name="lat_long" id="lat_long" class="form-control" placeholder="Lat Long">
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
                                  <option value="{{$package->id}}">{{$package->speed}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                  <select name="service_type" id="service_type" class="form-control" onchange="selectService(this)">
                                    <option value="">Service Type:</option>
                                    <option value="PPPoE">PPPoE</option>
                                    <option value="Static">Static</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <select name="location" id="" class="form-control">
                                      <option value="">Select POP/OLT</option>
                                      <option value="Bildahor">Bildahor</option>
                                      <option value="Nazirpur">Nazirpur</option>
                                      <option value="Chanchkoir">Chanchkoir</option>
                                      <option value="Ganadanagar">Ganadanagar</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <select name="pon" id="pon" class="form-control" onchange="checkIP(this)">
                                    <option value="">Select PON:</option>
                                    <option value="PON1">PON1</option>
                                    <option value="PON2">PON2</option>
                                    <option value="PON3">PON3</option>
                                    {{-- <option value="PON4">PON4</option> --}}
                                    <option value="RADIO">RADIO</option>
                                  </select>
                              </div>
                              <div id="serviceParts">
                                
                              </div>
                              <div class="form-group">
                                  <input type="text" class="form-control" name="mac" placeholder="ONU MAC Address:">
                              </div>
                            </div>
                            <div class="col-md-12">
                              
                              <div class="form-group">
                                <label for="">Details:</label>
                                <textarea class="form-control" name="details" id="" rows="2" placeholder="write details here..."></textarea>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="">National ID Number</label>
                                <input type="text" name="NID" class="form-control">
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
        // console.log(data);
        let elm = userForm.elements;
        elm.name.value = data.user.name;
        elm.email.value = data.user.email;
        elm.address.value = data.user.address;
        elm.lat_long.value = data.user.lat_long;
        elm.join_date.value = data.user.join_date;
        elm.billing_date.value = data.user.billing_date;
        elm.payment_date.value = data.user.payment_date;

        if(data.user.status)
        {
          elm.status.options[0] = new Option(data.user.status, data.user.status, false, true);
        }

        if(data.user.location)
        {
          elm.location.options[0] = new Option(data.user.location, data.user.location, false, true);
        }

        if(data.user.package)
        {
          elm.package.options[0] = new Option(data.user.package.speed, data.user.package.id, false, true);
        }

        if(data.user.service_type)
        {
          elm.service_type.options[0] = new Option(data.user.service_type, data.user.service_type, false, true);

          selectService(document.getElementById('service_type'));
        }

        if(data.user.pon)
        {
          elm.pon.options[0] = new Option(data.user.pon, data.user.pon, false, true);
        }

        if(data.user.service_type == 'PPPoE')
        {
          elm.username.value = data.user.username;
          elm.password.value = data.user.service_password;
        }
        else
        {
          elm.ip.options[0] = new Option(data.user.ip, data.user.ip, false, true);
          // checkIP(document.getElementById('pon'));
          // elm.ip.value = data.user.ip;
        }
        
        elm.mac.value = data.user.mac;

        elm.work_at.value = data.user.work_at;
        elm.profession.value = data.user.profession;
        elm.date_of_birth.value = data.user.date_of_birth;
        elm.details.value = data.user.details;
        
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

  function selectService(e)
  {
    const serviceParts = document.getElementById('serviceParts');
    let service = e.options[e.selectedIndex];

    if(service.value == 'PPPoE')
    {
      serviceParts.innerHTML = '<div class="form-group">'+
                                  '<input type="text" name="username" id="" class="form-control" placeholder="Username">'+
                              '</div>'+
                              '<div class="form-group">'+
                                  '<input type="text" name="service_password" id="" class="form-control" placeholder="Service Password">'+
                              '</div>';;
    }
    else
    {
      serviceParts.innerHTML = '<div class="form-group">'+
                                  '<select name="ip" id="static" class="form-control">'+
                                    '<option value="">Select IP:</option>'+
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
          let options = '<option value="">Select IP</option>';
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