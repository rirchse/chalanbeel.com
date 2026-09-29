@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('admin')
@section('title', 'Router Static Users')
@section('content')
<style>
  @media print {
  .temp-hide-print {
    display: none !important;
  }
}
  .form-group{
    margin-top: 0;
  }
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
                </div>
                <div class="material-datatables" id="printAbleArea">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Database ({{$users_count}})</th>
                                <th>Router ({{$arps_count}})</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Database</th>
                                <th>Router</th>
                                <th class="text-right" width="180">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach($mergedList as $key => $user)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                  {{ $user['name'] ?? '' }}<br>
                                  {{ $user['contact'] ?? '' }}<br>
                                  {{ $user['db_status'] ?? '' }}<br>
                                  {{ $user['ip'] ?? '' }}<br>
                                  {{ $user['mac'] ?? '' }}<br>
                                </td>
                                <td>
                                  {{ $user['interface'] ?? '' }}<br>
                                  <br>
                                  {{ $user['status'] ?? '' }}<br>
                                  {{ $user['address'] ?? '' }}<br>
                                  {{ $user['mac-address'] ?? '' }}<br>
                                </td>
                                <td class="text-right">
                                  @if(isset($user['id']))
                                    <a href="{{route('user.show', $user['id']??'')}}" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-eye"></i></a>

                                    <a class="btn btn-xs btn-warning" title="Edit the record" data-id="{{$user['id']}}" onclick="showModal(this)"><i class="fa fa-pencil"></i></a>
                                  @endif
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div> <!-- end content-->
        </div> <!--  end card  -->
    </div> <!-- end col-md-12 -->
    <!-- Modal User Edit-->
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
            <select name="package_id" id="package" class="form-control">
              <option value="">Select Package:</option>
              
            </select>
          </div>
          <div class="form-group">
              <select name="service_type" id="service_type" class="form-control">
                <option value="">Service Type:</option>
                <option value="PPPoE">PPPoE</option>
                <option value="Static">Static</option>
              </select>
          </div>
          <div class="form-group">
              <select name="pon" id="pon" class="form-control" onchange="checkIP(this)">
                <option value="">Select PON:</option>
                <option value="GPON1">GPON1</option>
                <option value="PON1">PON1</option>
                <option value="PON2">PON2</option>
                <option value="PON3">PON3</option>
                <option value="PON4">PON4</option>
                <option value="RADIO">RADIO</option>
              </select>
          </div>
          <div>
            <div class="form-group">
              <select name="ip" id="static" class="form-control">
                <option value="">Select IP:</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="username" id="" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="text" name="service_password" id="" class="form-control" placeholder="PPPoE Password">
            </div>
          </div>
          <div class="form-group">
              <input type="text" class="form-control" name="mac" placeholder="MAC Address:">
          </div>
          <div class="form-group">
              <input type="text" class="form-control" name="onu_mac" placeholder="ONU MAC Address:">
          </div>
          <div class="input-group">
            <input type="text" name="lat_long" id="lat_long" class="form-control" placeholder="Lat Long">
            <span class="input-group-addon">
              <button type="button" onclick="showMap()">
                <i class="fa fa-map"></i>
              </button>
            </span>
          </div>
          <div class="form-group">
            <input type="number" class="form-control" name="balance" placeholder="Balance" value="" onwheel="event.currentTarget.blur()">
          </div>
          <div class="form-group">
              <select name="location" id="" class="form-control">
                  <option value="">Select POP/OLT</option>
                  <option value="Bildahor EPON">Bildahor EPON</option>
                  <option value="Bildahor GPON">Bildahor GPON</option>
                  <option value="Nazirpur EPON">Nazirpur EPON</option>
                  <option value="Chanchkoir RADIO">Chanchkoir RADIO</option>
              </select>
          </div>
          <div class="form-group">
            <input type="text" name="address" class="form-control" placeholder="Address">
          </div>
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

</div> <!-- end row -->



@endsection

@section('scripts')
<script>
  let preloader = document.getElementById('preloader');

  function checkIP(e)
  {
    const service_type = document.getElementById('service_type');
    if(service_type.options[service_type.selectedIndex].value == 'Static')
    {
      const static = document.getElementById('static');
      const pon = e.options[e.selectedIndex];

      $.ajax({
        url: '{{route("user.check-ip", "")}}/'+pon.value,
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

  //store html table row
  let tabletr = '';
  function showModal(e)
  {
    tabletr = e.parentNode.parentNode;
    preloader.style.display = 'block';
    const editform = document.getElementById('submitEditForm');

    $.ajax({
      type: 'GET',
      url: '{{route("user.show", "")}}/'+e.dataset.id,
      success: function(data){
        let elm = editform.elements;
        elm.id.value = data.user.id ? data.user.id : '';
        elm.name.value = data.user.name ? data.user.name : '';
        elm.contact.value = data.user.contact ? data.user.contact : '';
        elm.address.value = data.user.address ? data.user.address : '';
        elm.lat_long.value = data.user.lat_long ? data.user.lat_long : '';
        elm.join_date.value = data.user.join_date ? data.user.join_date : '';
        elm.payment_date.value = data.user.payment_date ? data.user.payment_date : '';
        elm.lat_long.parentNode.classList.add('is-focused');
        if(data.user.status)
        {
          elm.status.options[0] = new Option(data.user.status, data.user.status, false, true);
        }

        if(data.user.location)
        {
          elm.location.options[0] = new Option(data.user.location, data.user.location, false, true);
        }

        if(data.user.package == null)
        {
          elm.package.options[0] = new Option('Select Package', '', false, true);
        }
        else
        {
          elm.package.options[0] = new Option(data.user.package.name, data.user.package.id, false, true);
        }

        if(data.user.service_type == null)
        {
          elm.service_type.options[0] = new Option('Select Service', '', false, true);
        }

        elm.service_type.options[0] = new Option(data.user.service_type, data.user.service_type, false, true);
        elm.ip.options[0] = new Option(data.user.ip, data.user.ip, false, true);
        elm.username.value = data.user.username ? data.user.username : '';
        elm.service_password.value = data.user.service_password ? data.user.service_password : '';

        if(data.user.pon)
        {
          elm.pon.options[0] = new Option(data.user.pon, data.user.pon, false, true);
        }

        elm.mac.value = data.user.mac ? data.user.mac : '';
        elm.onu_mac.value = data.user.onu_mac ? data.user.onu_mac : '';
        elm.balance.value = data.user.balance ? data.user.balance : 0;

        preloader.style.display = 'none';

        //show modal
        $('#editForm').modal('show');
        
      },
      error: function(data){
        console.error(data);
      }
    });
  }

  //submit data
  $('#editForm').on('submit', function(e){
    e.preventDefault();
    const editform = document.getElementById('submitEditForm');
    const formdata = new FormData(editform);
    formdata.append('_method', 'PUT');

    preloader.style.display = 'block';

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
        preloader.style.display = 'none';
        // console.log(data);

        let td = data.user.name+'<br>'+
        data.user.contact+'<br>'+
        data.user.status+'<br>'+
        data.user.ip+'<br>'+
        data.user.mac;

        tabletr.children[1].innerHTML = td;
      },
      error: function(data){
        console.error(data);
      }
    });
  });
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