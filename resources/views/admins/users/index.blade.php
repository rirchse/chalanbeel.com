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
                    <form action="{{route('user.search')}}" method="POST" class="form/-inline">
                      @csrf
                      <div class="col-md-5">
                        <div class="form-group">
                          <select name="status" id="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="New" {{$status == 'New'? 'selected': ''}}>New</option>
                            <option value="Active" {{$status == 'Active'? 'selected': ''}} >Active</option>
                            <option value="Expire" {{$status == 'Expire'? 'selected': ''}}>Expire</option>
                            <option value="Cancel" {{$status == 'Cancel'? 'selected': ''}}>Cancel</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-control">
                          <input type="date" name="date" class="form-control" value="{{$date}}">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-info btn-sm btn-block">Submit</button>
                      </div>
                    </form>
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
                                <th>Payment Date</th>
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
                                <th>Payment Date</th>
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
                                <td>{{ $source->dtformat($user->payment_date) }}</td>
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
          <label for="">Join Date:</label>
          <input type="date" name="join_date" class="form-control" placeholder="Join Date">
        </div>
        <div class="form-group">
          <label for="">Next Payment Date:</label>
          <input type="date" name="payment_date" class="form-control" placeholder="Join Date">
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
<script src="{{'/js/open-map.js?v=1.0.2'}}"></script>
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
          },
          // processing: true,
          // serverSide: true,
          // ajax: {
          //   url: '{{route("user.get-all-users")}}',
          //   type: 'GET'
          // },
          // columns: [
          //   {data: 'id'},
          //   {data: 'name'},
          //   {data: 'contact'},
          //   {data: 'location'},
          //   {data: 'lat_long'},
          //   {data: 'join_date'},
          //   {data: 'status'}
          // ]

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