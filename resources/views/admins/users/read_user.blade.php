@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('admin')
@section('title', 'User Details')
@section('content')
    
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">User Details</h4> 
                <div class="col-md-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                      @if($user->status == 'Expire' || $user->balance == 0)
                      <button class="btn btn-info btn-sm" data-target="#payment_modal" data-toggle="modal">Paid</button>
                      @endif
                        <a class="btn btn-sm btn-primary" title="Add New User" href="{{route('user.create')}}"><i class="fa fa-plus"></i></a>
                        <a class="btn btn-sm btn-success" title="View All Users" href="{{route('user.index')}}"><i class="fa fa-list"></i></a>
                        <a class="text-success" title="View Active Users" href="/admin/view_active_users"><i class="material-icons">assignment</i></a>
                        <a class="text-primary" title="View All Users" href="/admin/user"><i class="material-icons">assignment</i></a>
                        <a class="text-warning" title="Edit" href="/admin/user/{{$user->id}}/edit"><i class="material-icons">edit</i></a>
                        <form class="pull-right" action="{{route('user.destroy', $user->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-responsive">
                      <tr>
                          <th>Balance:</th>
                          <th>{{$user->balance}}</th>
                      </tr>
                      <tr>
                          <th>User Name</th>
                          <td>{{$user->name}}</td>
                      </tr>
                      <tr>
                          <th>Contact</th>
                          <td>{{$user->contact}}</td>
                      </tr>
                      <tr>
                          <th>Street Address:</th>
                          <td>{{$user->address}}</td>
                      </tr>
                      <tr>
                          <th>POP/OLT</th>
                          <td>{{$user->location}}</td>
                      </tr>
                      <tr>
                          <th>Status:</th>
                          <td>
                            @if($user->status == 'Active')
                            <label class="label label-success">{{$user->status}}</label>
                            @else
                            <label class="label label-danger">{{$user->status}}</label>
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <th>Package:</th>
                          <td>{{$user->package?$user->package->speed:''}}</td>
                      </tr>
                      <tr>
                          <th>Package Price:</th>
                          <td>{{$user->package?$user->package->price:''}}</td>
                      </tr>
                      <tr>
                          <th>Service Type:</th>
                          <td>{{$user->service_type}}</td>
                      </tr>
                      <tr>
                          <th>PON Number:</th>
                          <td>{{$user->pon}}</td>
                      </tr>
                      <tr>
                          <th>IP Address:</th>
                          <td>{{$user->ip}}</td>
                      </tr>
                      <tr>
                          <th>ONU MAC</th>
                          <td>{{$user->mac}}</td>
                      </tr>
                      <tr>
                          <th>Username:</th>
                          <td>{{$user->username}}</td>
                      </tr>
                      <tr>
                          <th>Service Password:</th>
                          <td>{{$user->service_password}}</td>
                      </tr>
                      <tr>
                          <th>Join Date:</th>
                          <td>{{$source->dtformat($user->join_date)}}</td>
                      </tr>
                      <tr>
                          <th>Billing Date:</th>
                          <td>{{$source->dtformat($user->billing_date)}}</td>
                      </tr>
                      <tr>
                          <th>Next Payment Date:</th>
                          <td>{{$source->dtformat($user->payment_date)}}</td>
                      </tr>
                      <tr>
                          <th>Location On Map:</th>
                          <td>@if($user->lat_long)
                          <a target="_blank" href="https://www.google.com/maps/place/{{$user->lat_long}}">View On Map</a>
                          @else
                          Unavailable
                          @endif</td>
                      </tr>
                      <tr>
                          <th>Email</th>
                          <td>{{$user->email}}</td>
                      </tr>
                      <tr>
                          <th>NID No.</th>
                          <td>{{$user->nid_no}}</td>
                      </tr>
                      <tr>
                          <th>Date of Birth</th>
                          <td>{{$user->date_of_birth}}</td>
                      </tr>
                      <tr>
                          <th>Work At</th>
                          <td>{{$user->work_at}}</td>
                      </tr>
                      <tr>
                          <th>Station</th>
                          <td>{{$user->station}}</td>
                      </tr>
                      <tr>
                          <th>Details:</th>
                          <td>{{$user->details}}</td>
                      </tr>
                      <tr>
                          <th>Created At</th>
                          <td>{{$source->dtformat($user->created_at)}}</td>
                      </tr>
                      <tr>
                          <th>Created By</th>
                          <td>{{$user->adminCreated ?$user->adminCreated->first_name : ''}}</td>
                      </tr>
                      <tr>
                          <th>Updated By</th>
                          <td>{{$user->adminUpdated ? $user->adminUpdated->first_name : ''}}</td>
                      </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
      <div class="card card-profile">
        <div class="card-avatar">
          <a href="#pablo">
            <img src="/images/{{$user->image?'profile/'.$user->image:'avatar.png'}}" class="img">
          </a>
        </div>
        <div class="card-body">
          <h6 class="card-category text-gray">{{$user->profession}}</h6>
          <h4 class="card-title">{{$user->full_name}}</h4>
          <p class="card-description">details....</p>
          <img class="img-responsive" src="/images/{{$user->nid_image?'nid/'.$user->nid_image:'nid-sample.jpg'}}">
          <a class="btn btn-rose btn-round" href="#pablo">Follow</a>
        </div>
      </div>
    </div> <!-- end content-->
</div> <!-- end row -->

<!-- Modal -->
<div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Payment</h4>
      </div>
      <form action="{{route('user.get-payment')}}" method="POST">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="user_id" value="{{$user->id}}">
          <div class="form-group">
            <label for="">Payment Received:</label>
            <input type="date" name="pament_receive" class="form-control" value="{{date('Y-m-d')}}">
          </div>
          <div class="form-group">
            <label for="">Amount:</label>
            <input type="number" name="amount" class="form-control" value="{{$user->package?$user->package->price:''}}">
          </div>
          <div class="form-group">
            <label for="">Next Payment Date:</label>
            <input type="date" name="payment_date" class="form-control" value="{{date('Y-m-d', strtotime('+30 days'))}}">
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