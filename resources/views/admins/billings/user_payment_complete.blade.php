@extends('admin')
@section('title', 'Create User Payment')
@section('content')
    
<div class="row">
        <div class="col-md-6">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="#pablo">
                    <img src="{{$base_url}}/images/{{ ($customer->image? $customer->image:'avatar.png') }}" class="img">
                </a>
            </div>

            <div class="card-body"><br>
                <h4 class="card-title"><b>{{ $customer->first_name.' '.$customer->last_name }}</b></h4>
                <h6 class="card-category text-gray"></b>{{ $customer->contact }}</b></h6>
                <a class="btn btn-rose btn-round" href="#pablo">details</a>
            </div>
        </div>
    </div>
    </div><!-- end row --> 
@endsection

@section('scripts')

@endsection