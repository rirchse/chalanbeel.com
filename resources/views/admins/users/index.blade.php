@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('admin')
@section('title', 'View All Users')
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
                  <!-- Hides 3rd column (Action) dynamically when button is clicked -->
                  <button onclick="printDivWithHiddenColumns('datatables', [6, 6, 7, 7])">
                    <i class="fa fa-print"></i>
                  </button>
                    <form action="{{route('user.search')}}" method="GET" class="form/-inline">
                      @csrf
                      <div class="col-md-2">
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
                      <div class="col-md-2">
                        <div class="form-group">
                          <select name="service_type" id="service" class="form-control">
                            <option value="">Select Service Type</option>
                            <option value="PPPoE" {{$service_type == 'PPPoE'? 'selected': ''}}>PPPoE</option>
                            <option value="Static" {{$service_type == 'Static'? 'selected': ''}} >Static</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="date" name="date" class="form-control" value="{{$date}}">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" name="name" class="form-control" value="{{$name}}" placeholder="Name, Contact, IP">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-info btn-sm btn-block">Submit</button>
                      </div>
                    </form>
                </div>
                <div class="material-datatables" id="printAbleArea">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Service</th>
                                <th>Payment Date</th>
                                <th>IP</th>
                                <th>Lat, Long</th>
                                <th>Status</th>
                                <th>Balance</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Service</th>
                                <th>Payment Date</th>
                                <th>IP</th>
                                <th>Lat, Long</th>
                                <th>Status</th>
                                <th>Balance</th>
                                <th class="text-right" width="180">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach($users as $key => $user)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->contact }}</td>
                                <td>{{ $user->service_type }}</td>
                                <td>{{ $source->dformat($user->payment_date) }}</td>
                                <td>{{ $user->ip }}</td>
                                <td>{{ $user->lat.' '. $user->lng }}</td>
                                <td>
                                  @if($user->status == 'Active')
                                  <label class="label label-success">{{$user->status}}</label>
                                  @elseif($user->status == 'Expire')
                                  <label class="label label-warning">{{$user->status}}</label>
                                  @elseif($user->status == 'Deactive')
                                  <label class="label label-default">{{$user->status}}</label>
                                  @elseif($user->status == 'Cancel')
                                  <label class="label label-danger">{{$user->status}}</label>
                                  @else
                                  <label class="label label-primary">{{$user->status}}</label>
                                  @endif
                                </td>
                                <td>{{$user->balance}}</td>
                                <td class="text-right">
                                    <a href="{{route('user.show', $user->id)}}" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                                    
                                    <a class="btn btn-xs btn-warning" title="Edit the record" data-id="{{$user->id}}" onclick="showModal(this)"><i class="fa fa-pencil"></i></a>

                                    <button class="btn btn-info btn-sm"  onclick="showPayModal(this)" data-id="{{$user->id}}">Pay</button>
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
            <select name="location" id="" class="form-control">
                <option value="">Select POP/OLT</option>
                <option value="Bildahor">Bildahor</option>
                <option value="Nazirpur">Nazirpur</option>
                <option value="Chanchkoir">Chanchkoir</option>
                <option value="Ganadanagar">Ganadanagar</option>
            </select>
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
        <div id="serviceParts">
          
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

  <!-- Map Modal -->
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

  <!-- Modal Payment -->
<div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Payment</h4>
      </div>
      <form action="{{route('user.get-payment')}}" method="POST" id="paymentForm">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="user_id" value="">
          <div class="form-group">
            <label for="">Payment Received:</label>
            <input type="date" name="payment_receive" class="form-control" value="{{date('Y-m-d')}}" onkeyup="addOneMonth(this)" onchange="addOneMonth(this)">
          </div>
          <div class="form-group">
            <label for="">Amount:</label>
            <input type="number" name="amount" class="form-control" value="">
          </div>
          <div class="form-group">
            <label for="">Next Payment Date:</label>
            <input type="date" name="payment_date" class="form-control" value="{{date('Y-m-d', strtotime('+1 months'))}}" id="paymentDate">
          </div>
          <div class="form-group">
            <label for="">Send SMS:</label>
            <input type="checkbox" name="send_sms" checked value="Yes" id="sendSms">
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
function printDivWithHiddenColumns(tableId, columnsToHide) {
  var originalTable = document.getElementById(tableId);
  if (!originalTable) return;

  // 1. Clone the table so we don't alter the actual table on your web page
  var clonedTable = originalTable.cloneNode(true);

  // 2. Remove specified columns (columnsToHide expects 1-based indexes, e.g., [3, 6, 9])
  columnsToHide.forEach(function(colIndex) {
    // Select the Nth <th> and <td> in every row
    var cells = clonedTable.querySelectorAll(`tr > *:nth-child(${colIndex})`);
    cells.forEach(function(cell) {
      cell.remove();
    });
  });

  // 3. Create a hidden iframe
  var iframe = document.createElement('iframe');
  iframe.style.position = 'fixed';
  iframe.style.right = '0';
  iframe.style.bottom = '0';
  iframe.style.width = '0';
  iframe.style.height = '0';
  iframe.style.border = '0';
  document.body.appendChild(iframe);

  // 4. Construct printable document with cloned table
  var doc = iframe.contentWindow.document;
  var htmlContent = '<!DOCTYPE html><html><head><title>Print</title>' +
    '<style type="text/css">' +
    '.pageheader { font-size:12px; }' +
    'table { border-collapse:collapse; font-size:14px; width:100%; }' +
    'table th, table td { border:1px solid #666; padding: 10px; }' +
    '</style></head><body>' +
    '<h2 style="text-align:center">Chalanbeel Technology</h2>'+
    '<h4 style="text-align:center">Expired Users List</h4>'+
    clonedTable.outerHTML +
    '</body></html>';

  // 5. Render and trigger print
  doc.open();
  doc.write(htmlContent);
  doc.close();

  iframe.contentWindow.focus();
  setTimeout(function() {
    iframe.contentWindow.print();
    document.body.removeChild(iframe); // Clean up iframe after print
  }, 500);
}

  function printDiv() {
  var divToPrint = document.getElementById('datatables');
  if (!divToPrint) return;

  // 1. Create a hidden iframe
  var iframe = document.createElement('iframe');
  iframe.style.position = 'fixed';
  iframe.style.right = '0';
  iframe.style.bottom = '0';
  iframe.style.width = '0';
  iframe.style.height = '0';
  iframe.style.border = '0';
  document.body.appendChild(iframe);

  // 2. Prepare HTML content
  var doc = iframe.contentWindow.document;
  var htmlContent = '<!DOCTYPE html><html><head><title>Print</title>' +
    '<style type="text/css">' +
    '.pageheader{font-size:12px}' +
    'table { border-collapse:collapse; font-size:14px; width:100%; }' +
    'table th, table td { border:1px solid #666; padding: 10px; }' +
    '</style></head><body>' +
    divToPrint.outerHTML +
    '</body></html>';

  // 3. Write content to iframe and trigger print
  doc.open();
  doc.write(htmlContent);
  doc.close();

  iframe.contentWindow.focus();
  setTimeout(function() {
    iframe.contentWindow.print();
    document.body.removeChild(iframe); // Clean up after print
  }, 500);
}
</script>

<script type="text/javascript">
  function printTableByColumnIndex(tableId, targetColumnIndexes) {
  const table = document.getElementById(tableId);
  if (!table) return;

  // 1. Add temporary class to specified column indexes (1-based index)
  targetColumnIndexes.forEach(columnIndex => {
    const cells = table.querySelectorAll(`tr > *:nth-child(${columnIndex})`);
    cells.forEach(cell => cell.classList.add('temp-hide-print'));
  });

  // 2. Trigger print dialog
  window.print();

  // 3. Clean up classes after print dialog opens/closes
  targetColumnIndexes.forEach(columnIndex => {
    const cells = table.querySelectorAll(`tr > *:nth-child(${columnIndex})`);
    cells.forEach(cell => cell.classList.remove('temp-hide-print'));
  });
}
</script>
<script>
  let preloader = document.getElementById('preloader');
  const serviceParts = document.getElementById('serviceParts');
  function selectService(e)
  {
    let service = e.options[e.selectedIndex];

    if(service.value == 'PPPoE')
    {
      serviceParts.innerHTML = '<div class="form-group">'+
                                  '<input type="text" name="username" id="" class="form-control" placeholder="Username">'+
                              '</div>'+
                              '<div class="form-group">'+
                                  '<input type="text" name="service_password" id="" class="form-control" placeholder="PPPoE Password">'+
                              '</div>';
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

  function showModal(e)
  {
    preloader.style.display = 'block';
    const editform = document.getElementById('submitEditForm');

    $.ajax({
      type: 'GET',
      url: '{{route("user.show", "")}}/'+e.dataset.id,
      success: function(data){
        let elm = editform.elements;
        elm.id.value = data.user.id;
        elm.name.value = data.user.name;
        elm.contact.value = data.user.contact;
        elm.address.value = data.user.address;
        elm.lat_long.value = data.user.lat_long;
        elm.join_date.value = data.user.join_date;
        elm.payment_date.value = data.user.payment_date;
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
        else
        {
          elm.service_type.options[0] = new Option(data.user.service_type, data.user.service_type, false, true);

          selectService(document.getElementById('service_type'));

          if(data.user.service_type == 'PPPoE')
          {
            elm.username.value = data.user.username;
            elm.service_password.value = data.user.service_password;
          }
          else if(data.user.service_type == 'Static')
          {
            elm.ip.options[0] = new Option(data.user.ip, data.user.ip, false, true);
          }
          else
          {
            serviceParts.innerHTML = '';
          }
        }

        if(data.user.pon)
        {
          elm.pon.options[0] = new Option(data.user.pon, data.user.pon, false, true);
        }

        elm.mac.value = data.user.mac;
        elm.onu_mac.value = data.user.onu_mac;
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
        //console.log(data);
      },
      error: function(data){
        console.error(data);
      }
    });
  });
</script>

<script src="{{'/js/open-map.js?v=1.0.3'}}"></script>
    
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeoMZGKjy_MlK9Jhh8TWgEIHSHa4Mm7Yg&callback=initMap" async defer></script>

<script>
  function showMap()
  {
    // Load map
    initMap();

    $('#map_modal').modal('show');
  }
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
<script>

  //payment modal controller
  function showPayModal(e)
  {
    const payForm = document.getElementById('paymentForm');
    payForm.elements.user_id.value = e.dataset.id;

    //get user details
    $.ajax({
      type: 'GET',
      url: '{{route("user.show", "")}}/'+e.dataset.id,
      success: function(data){
        //write user package price
        payForm.elements.amount.value = data.user.package.price;
        //show modal
        $('#payment_modal').modal('show');
      },
      error: function(data){
        console.error(data);
      },

    });

    
  }

  //submit payment data
  $('#payment_modal').on('submit', function(e){
    e.preventDefault();
    
    const payForm = document.getElementById('paymentForm');
    const formdata = new FormData(payForm);
    // formdata.append('_method', 'PUT');

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      }
    });

    $.ajax({
      type: 'POST',
      url: '{{route("user.get-payment")}}',
      data: formdata,
      processData: false,
      contentType: false,
      success: function(data){
        $('#payment_modal').modal('hide');
        console.log(data);
      },
      error: function(data){
        console.error(data);
      }
    });
  });

  function addOneMonth(date)
  {
    const form = document.getElementById('paymentForm');
    // Create a new date object to avoid modifying the original one
    let newDate = new Date(date.value); 
    // getMonth() returns a zero-based index (0 for January, 11 for December)
    let currentMonth = newDate.getMonth();
    // setMonth() automatically adjusts the year if the month exceeds December
    newDate.setMonth(currentMonth + 1);
    
    const year = newDate.getFullYear();
    // Months are 0-indexed, so add 1
    const month = String(newDate.getMonth() + 1).padStart(2, '0'); 
    const day = String(newDate.getDate()).padStart(2, '0');

    const formattedDate = `${year}-${month}-${day}`;

    form.elements.payment_date.value = formattedDate;
  }
</script>
@endsection