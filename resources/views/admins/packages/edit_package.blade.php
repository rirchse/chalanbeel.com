@extends('admin')
@section('title', 'Edit Package')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">

            <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <div class="col-md-6">
                        <h4 class="card-title">Edit Package</h4>
                    </div>
                    <div class="toolbar">
                        <a class="btn-simple btn-icon text-info" href="/admin/package/{{$package->id}}" title="Details"><i class="material-icons">dvr</i></a>
                        <a class="btn-simple btn-icon text-success" href="/admin/package" title="View"><i class="material-icons">subject</i></a>
                    </div>
                    
                    <form action="{{route('package.update', $package->id)}}" method="POST" id="RegisterValidation">
                      @csrf
                      @method('PUT')

                    <div class="row">
                      <div class=" col-md-12">
                          <div class="form-group label-floating">
                              <label for="">Speed(*):</label>
                              <input type="text" class="form-control" name="speed" required value="{{$package->speed}}">
                          </div>
                          <div class="form-group label-floating">
                              <label for="">Time Limit in Days(*):</label>
                              <input type="number" class="form-control" name="time_limit" required value="{{$package->time_limit}}">
                          </div>
                          <div class="form-group label-floating">
                              <label for="">Price(*):</label>
                              <input type="number" class="form-control" name="price" required step="0.1" value="{{$package->price}}">
                          </div>
                          <div class="form-group label-floating">
                              <label>Status:</label>
                              <br>
                              <input type="radio" name="status" value="Active" {{$package->status == 'Active'? 'checked': ''}}> Active &nbsp; 
                              <input type="radio" name="status" value="Inactive" {{$package->status == 'Inactive'? 'checked': ''}}> Inactive
                          </div>
                          <div class="form-group label-floating">
                              <label for="">Details:</label>
                              <textarea class="form-control" name="details" id="" rows="3" >{{$package->details}}</textarea>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <button type="submit" class="btn btn-primary pull-right"><i class="material-icons">save</i> Save</button>
                      </div>
                  </div>

                    
                </form>
                    
                </div>
            </div>
        </div>
    </div>

@endsection