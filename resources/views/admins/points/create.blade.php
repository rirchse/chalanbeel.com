@extends('admin')
@section('title', 'Add New Point')
@section('stylesheets')
<link rel="stylesheet" href="/assets/summernote/summernote.min.css">
@endsection

@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            <form action="{{route('point.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                      <h4 class="card-title">Add New Point</b></h4>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Address/Location:</label>
                        <input type="text" name="address" class="form-control" placeholder="Description on the location, any mark on the pole">
                      </div>
                      <div class="input-group">
                        <label for="">Lat Long:</label>
                        <input type="text" name="lat_lon" id="lat_long" class="form-control">
                        
                        <span class="input-group-addon">
                          <button type="button" data-toggle="modal" data-target="#map_modal">
                            <i class="fa fa-map"></i>
                          </button>
                        </span>
                      </div>
                      <div class="form-group">
                        <label for="">Details:</label>
                        <textarea rows="10" name="details" class="form-control editor"></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Creation Date:(Optional)</label>
                        <input type="date" name="created_at" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Photo:(Optional)</label>
                        <input type="file" name="image" class="form-control" style="border:1px solid #ddd !important">
                      </div>
                    </div>
                    <div class="clearfix"></div>

                    <button type="submit" class="btn btn-primary btn-fill pull-right">Save</button>
                </div>
            </div>
          </form>

        </div>
        {{-- user details --}}
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

<script src="/assets/summernote/summernote-bs4.min.js"></script>
<script type="text/javascript">

  //this script for text editor
  $(document).ready(function() {
      $('.editor').summernote({
          height: 150
      });
  });
</script>
@endsection