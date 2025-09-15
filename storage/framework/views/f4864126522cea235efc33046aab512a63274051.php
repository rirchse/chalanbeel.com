<?php $__env->startSection('title', 'View All Users'); ?>
<?php $__env->startSection('content'); ?>
    
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

                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td><?php echo e($user->full_name); ?></td>
                                <td><?php echo e($user->contact); ?></td>
                                <td><?php echo e($user->address); ?></td>
                                <td><?php echo e($user->lat.' '. $user->lng); ?></td>
                                <td title="<?php echo e(date('h:i:s', strtotime($user->join_date))); ?>"><?php echo e(date('d M Y', strtotime($user->join_date))); ?></td>
                                <td>
                                    <?php echo e($user->status); ?>

                                </td>
                                <td class="text-right">
                                    <a href="<?php echo e(route('user.show', $user->id)); ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                                    
                                    <a class="btn btn-xs btn-warning" title="Edit the record" onclick="showModal(this)"><i class="fa fa-pencil"></i></a>

                                    <a href="/admin/create/<?php echo e($user->id); ?>/service" class="btn btn-simple btn-success btn-icon" title="Add New Servcie"><i class="material-icons">add_circle</i></a>
                                </td>
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div> <!-- end content-->
        </div> <!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

<!-- Modal -->
<div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">User Information</h4>
      </div>
      <div class="modal-body">
        <form id="submitEditForm" method="post" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="col-md-12">
            <div class="form-group label-floating">
              <label for="" class="control-label">Name</label>
              <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group label-floating">
              <label for="" class="control-label">Contact</label>
              <input type="text" name="contact" class="form-control">
            </div>
            <div class="form-group label-floating">
              <label for="" class="control-label">Address</label>
              <input type="text" name="address" class="form-control">
            </div>
            <div class="form-group label-floating">
              <label for="" class="control-label">Lat Long</label>
              <input type="text" name="lat_long" id="lat_long" class="form-control">
            </div>
            <div class="form-group label-floating">
              <label for="" class="control-label">Join Date</label>
              <input type="date" name="join_date" class="form-control">
            </div>
          </div>

          <div id="map" style="width:100%; height:400px;"></div>
        </form>

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  function showModal()
  {
    $('#editForm').modal('show');
  }
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

          latlong.value = userLocation.replace(/\(|\)/g, "");
        },
        function() {
          alert("Geolocation failed. Using default location.");
        }
      );
    } else {
      alert("Your browser doesn’t support geolocation.");
    }

    // Update input fields when dragging marker
    google.maps.event.addListener(marker, "dragend", function (event) {
      latlong.value = event.latLng;
    });

    // Update marker & input fields when clicking map
    google.maps.event.addListener(map, "click", function (event) {
      marker.setPosition(event.latLng);
      latlong.value = event.latLng;
    });

    // Set default input values
    latlong.value = event.latLng;
  }

  // Load map
  window.onload = initMap;
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/admins/users/view_all_users.blade.php ENDPATH**/ ?>