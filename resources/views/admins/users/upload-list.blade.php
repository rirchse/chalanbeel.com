@extends('admin')
@section('title', 'User Profile')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Edit User Detail</h4>

    <form action="{{route('user.upload-list-store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="col-md-12">
        <div class="form-group">
          <label for="" class="control-label">Upload CSV File:</label>
          <input type="file" name="user_list" accept=".csv" required class="form-control btn btn-lg" style="border:1px solid #ddd"> <i class="fa fa-upload pull-right"></i>
        </div>
        <button type="submit" class="btn btn-primary">Upload user list</button>
      </div>
    </form>
    <div class="clearfix"></div>
        

                </div>
            </div>
        </div>
    </div>
@endsection