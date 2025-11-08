@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('admin')
@section('title', 'View Points')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Points</h4>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                              <th>#</th>
                                <th>Address</th>
                                <th>Details</th>
                                <th>Lat Long</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                              <th>#</th>
                              <th>Address</th>
                              <th>Details</th>
                              <th>Lat Long</th>
                              <th>Date</th>
                              <th>Status</th>
                              <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                          @foreach($points as $key => $point)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $point->address }}</td>
                            <td>{!! $point->details !!}</td>
                            <td>{{ $point->lat_lon }}</td>
                            <td>{{ $source->dtformat($point->created_at) }}</td>
                            <td>{{ $point->status }}</a></td>
                            <td class="text-right">
                              <a href="{{route('point.show', $point->id)}}" class="text-info"><i class="material-icons">dvr</i></a>
                              <a href="{{route('point.edit', $point->id)}}" class="text-warning" title="Edit the record"><i class="material-icons">edit</i></a>
                            </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row -->
<script type="text/javascript"> function showPassword(element){if(element.innerHTML != '*****'){element.innerHTML = '*****'; }else{ element.innerHTML=element.getAttribute('value'); }}</script>
@endsection