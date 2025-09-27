@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('admin')
@section('title', 'View All Users')
@section('content')
<style>
  .form-group{
    margin-top: 0;
  }
  /* .modal-content {
    max-height: calc(100vh - 200px);
    overflow-y: auto;
  } */
  /* .modal {
    -webkit-overflow-scrolling:touch !important
  } */
</style>
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Users</h4>
                <div class="toolbar">
                    <a class="btn btn-info btn-xs" href="/admin/get_user_from_router">Get User From Router</a>
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Location</th>
                                <th>Lat, Long</th>
                                <th>Join Date</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Location</th>
                                <th>Lat, Long</th>
                                <th>Join Date</th>
                                <th>Status</th>
                                <th class="text-right" width="180">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach($users as $key => $user)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->contact }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->lat.' '. $user->lng }}</td>
                                <td>{{ $source->dtformat($user->join_date) }}</td>
                                <td>{{$user->status}}</td>
                                <td class="text-right">
                                    <a href="{{route('user.show', $user->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                                    
                                    <a class="btn btn-xs btn-warning" title="Edit the record" data-id="{{$user->id}}" onclick="showModal(this)"><i class="fa fa-pencil"></i></a>

                                    <a href="/admin/create/{{$user->id}}/service" class="btn btn-simple btn-success btn-icon" title="Add New Servcie"><i class="material-icons">add_circle</i></a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div> <!-- end content-->
        </div> <!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->




<!-- Modal -->
<div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <form id="submitEditForm" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" value="">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">User Information</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
          <input type="text" name="contact" class="form-control" placeholder="Contact">
        </div>
        <div class="form-group">
          <input type="text" name="address" class="form-control" placeholder="Address">
        </div>
        <div class="form-group">
          <input type="date" name="join_date" class="form-control" placeholder="Join Date">
        </div>
        <div class="form-group">
          <select name="status" class="form-control" id="status">
            <option value="">Select One</option>
            <option value="Active">Active</option>
            <option value="Deactive">Deactive</option>
            <option value="Expire">Expire</option>
            <option value="Cancel">Cancel</option>
          </select>
        </div>
        <div class="form-group">
          <input type="text" name="lat_long" id="lat_long" class="form-control" placeholder="Lat Long">
        </div>
      </div>

      <div class="form-group">
        <div id="map" style="width:100%; height:400px; margin-top:0"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        <div class="clearfix"></div>
      </div>
    </div>

  </form> 
  </div>
</div>


@endsection

@section('scripts')
<script>
  function showModal(e)
  {
    const editform = document.getElementById('submitEditForm');
    $.ajax({
      type: 'GET',
      url: '{{route("user.show", "")}}/'+e.dataset.id,
      success: function(data){
        let elm = editform.elements;
        // let status = data.user.status ? data.user.status : '';
        elm.id.value = data.user.id;
        elm.name.value = data.user.name;
        elm.contact.value = data.user.contact;
        elm.address.value = data.user.address;
        elm.lat_long.value = data.user.lat ? data.user.lat+', '+data.user.lng : '';
        elm.join_date.value = data.user.join_date;
        elm.lat_long.parentNode.classList.add('is-focused');
        if(data.user.status)
        {
          elm.status.options[0] = new Option(data.user.status, data.user.status, false, true);
        }
        
      },
      error: function(data){
        console.error(data);
      }
    });
    //show modal
    $('#editForm').modal('show');
  }

  //submit data
  $('#editForm').on('submit', function(e){
    e.preventDefault();
    const editform = document.getElementById('submitEditForm');
    const formdata = new FormData(editform);
    formdata.append('_method', 'PUT');

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      }
    });
    $.ajax({
      type: 'POST',
      url: '{{route("user.update", "")}}/'+editform.elements.id.value,
      data: formdata,
      processData: false,
      contentType: false,
      success: function(data){
        $('#editForm').modal('hide');
        console.log(data);
      },
      error: function(data){
        console.error(data);
      }
    });
  });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeoMZGKjy_MlK9Jhh8TWgEIHSHa4Mm7Yg"></script>
<script>
  let map;
  let marker;

  let latlong = document.getElementById('lat_long');

  function initMap() {
    // Default location (Dhaka for example)
    const defaultLocation = { lat: 24.4322, lng: 89.2091 };

    // Create map
    map = new google.maps.Map(document.getElementById("map"), {
      center: defaultLocation,
      zoom: 15,
      mapTypeId: "roadmap", // default
      mapTypeControl: true, // enable switcher
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU, // or HORIZONTAL_BAR
        position: google.maps.ControlPosition.TOP_RIGHT,      // position of control
        mapTypeIds: [
          "roadmap",
          "satellite",
          "hybrid",
          "terrain"
        ]
      }
    });

    // Place initial marker
    marker = new google.maps.Marker({
      position: defaultLocation,
      map: map,
      draggable: true,
    });

    // Try HTML5 geolocation
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        function(position) {
          const userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          map.setCenter(userLocation);
          marker.setPosition(userLocation);

          latlong.value = userLocation.lat + ', ' + userLocation.lng;
        },
        function() {
          // alert("Geolocation failed. Using default location.");
        }
      );
    } else {
      // alert("Your browser doesn’t support geolocation.");
    }

    // Update input fields when dragging marker
    google.maps.event.addListener(marker, "dragend", function (event) {
      latlong.value = event.latLng.lat() + ', ' + event.latLng.lng();
    });

    // Update marker & input fields when clicking map
    google.maps.event.addListener(map, "click", function (event) {
      marker.setPosition(event.latLng);
      latlong.value = event.latLng.lat() + ', ' + event.latLng.lng();
    });

    // Set default input values
    // latlong.value = event.latLng.lat() + ', ' + event.latLng.lng();
  }

  // Load map
  window.onload = initMap;
</script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#datatables').DataTable({
          "pagingType": "full_numbers",
          "lengthMenu": [
              [100, 25, 50, 100, -1],
              [100, 25, 50, 100, "All"]
          ],
          responsive: true,
          language: {
              search: "_INPUT_",
              searchPlaceholder: "Search records",
          }

      });


      var table = $('#datatables').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
          $tr = $(this).closest('tr');

          var data = table.row($tr).data();
          alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
          $tr = $(this).closest('tr');
          table.row($tr).remove().draw();
          e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
          alert('You clicked on Like button');
      });

      $('.card .material-datatables label').addClass('form-group');
  });
</script>
@endsection