@extends('admin')
@section('title', 'Add Package')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">

            <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">add</i>
                </div>
                <div class="card-content">
                    <div class="col-md-6">
                        <h4 class="card-title">Create Package</h4>
                    </div>
                    <form action="{{route('package.store')}}" method="POST" id="RegisterValidation">
                      @csrf

                    <div class="row">
                        <div class=" col-md-12">
                            <div class="form-group label-floating">                                
                                <label for="">Speed(*):</label>
                                <input type="text" class="form-control" name="speed" required>
                            </div>
                            <div class="form-group label-floating">
                                <label for="">Time Limit in Days(*):</label>
                                <input type="number" class="form-control" name="time_limit" required>
                            </div>
                            <div class="form-group label-floating">                                
                                <label for="">Price(*):</label>
                                <input type="number" class="form-control" name="price" required step="0.1">
                            </div>
                            <div class="form-group label-floating">
                                <label>Status:</label><br>
                                <input type="radio" name="status" value="1"> Active &nbsp; 
                                <input type="radio" name="status" value="0"> Inactive
                            </div>
                            <div class="form-group label-floating">                                
                                <label for="">Details:</label>
                                <textarea class="form-control" name="details" id="" rows="3"></textarea>
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