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
                      <label style="border: 1px solid">Select CSV File:
                      <input type="file" name="user_list" accept=".csv" required class="form-control" style="border:1px solid #430606; display:block; cursor: pointer;"> <i class="fa fa-upload"></i></label>
                    <button type="submit" class="btn btn-primary pull-right">Upload user list</button>
                    </div>
                  </div>
                </form>
                <div class="clearfix"></div>   

            </div>
        </div>
    </div>
</div>
@endsection