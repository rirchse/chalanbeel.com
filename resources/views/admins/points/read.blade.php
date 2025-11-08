@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('admin')
@section('title', 'Point Details')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content" style="">
                <div class="col-md-5">
                    <h4 class="card-title">Point Details</h4>
                </div>
                <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="btn btn-info btn-sm" href="{{route('point.create')}}"><i class="material-icons">add</i></a>
                        <a class="btn btn-success btn-sm" href="{{route('point.index')}}"><i class="material-icons">assignment</i></a>
                        <a class="btn btn-warning btn-sm" href="{{route('point.edit', $point->id)}}"><i class="material-icons">edit</i></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-content">
                            <div class="table-responsive table-space">
                                <table class="table table-bordered table-space">
                                        <tbody>
                                            <tr>
                                                <td>Address</td>
                                                <td>{{ $point->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Details</td>
                                                <td>{!! $point->details !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Lat Long</td>
                                                <td>
                                                  {{ $point->lat_lon }}
                                                  <br>
                                                  <a target="_blank" href="https://www.google.com/maps/place/{{$point->lat_lon}}">View On Map</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>
                                                  @if($point->status == 'Active')
                                                  <label class="label label-success">{{$point->status}}</label>
                                                  @else
                                                  <label class="label label-danger">{{$point->status}}</label>
                                                  @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Created By</td>
                                                <td>{{ $point->adminCreated ? $point->adminCreated->first_name:'' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Updated By</td>
                                                <td>{{ $point->adminUpdated ? $point->adminUpdated->first_name:'' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Created On</td>
                                                <td>{{ $source->dtformat($point->created_at) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Created On</td>
                                                <td>{{ $source->dtformat($point->updated_at) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Image</td>
                                                <td>
                                                    @if($point->image)
                                                    <a target="_blank" href="{{ $point->image }}">
                                                      <img src="{{$point->image}}" alt="">
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- end row --> 
@endsection