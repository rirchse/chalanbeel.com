@extends('admin')
@section('title', 'Edit Point')
@section('stylesheets')
<link rel="stylesheet" href="/assets/summernote/summernote.min.css">
@endsection
@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">
            
            <form action="{{route('point.update', $point->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10">
                        <h4 class="card-title">Edit Point</b></h4>
                    </div>
                    <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="btn btn-info" href="{{route('point.show', $point->id)}}"><i class="material-icons">dvr</i></a>
                        <a class="btn btn-success" href="{{route('point.index')}}"><i class="material-icons">assignment</i></a>
                    </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Address/Location:</label>
                    <input type="text" name="address" class="form-control" placeholder="Description on the location, any mark on the pole" value="{{$point->address}}">
                  </div>
                  <div class="input-group">
                    <label for="">Lat Long:</label>
                    <input type="text" name="lat_lon" id="lat_long" class="form-control" value="{{$point->lat_lon}}">
                    
                    <span class="input-group-addon">
                      <button type="button" data-toggle="modal" data-target="#map_modal">
                        <i class="fa fa-map"></i>
                      </button>
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="">Details:</label>
                    <textarea rows="10" name="details" class="form-control editor">{{$point->details}}</textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Status:</label>
                    <select name="status" id="" class="form-control">
                      <option value="">Select One</option>
                      <option value="Active" {{$point->status == 'Active'? 'selected':''}}>Active</option>
                      <option value="Deactive" {{$point->status == 'Deactive'? 'selected':''}}>Deactive</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Creation Date:(Optional)</label>
                    <input type="datetime-local" name="created_at" class="form-control"  value="{{$point->created_at}}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Photo:(Optional)</label>
                    <input type="file" name="image" class="form-control" style="border:1px solid #ddd !important">

                    @if($point->image)
                    <br>
                    <a target="_blank" href="{{$point->image}}">View Image</a>
                    @endif
                  </div>
                </div>

                    <button type="submit" class="btn btn-rose btn-fill pull-right">update</button>
                </div>
            </div>
          </form>

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