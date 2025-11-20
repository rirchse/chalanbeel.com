@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('admin')
@section('title', 'View Careers')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">work</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Careers
                    <a href="{{route('career.create')}}" class="btn btn-primary btn-sm pull-right">
                        <i class="material-icons">add</i> Add New Career
                    </a>
                </h4>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Department</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Department</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($careers as $key => $career)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $career->title }}</td>
                                <td>{{ $career->department ?? 'N/A' }}</td>
                                <td>{{ $career->location ?? 'N/A' }}</td>
                                <td>{{ $career->type ?? 'N/A' }}</td>
                                <td>{{ $career->deadline ? date('M d, Y', strtotime($career->deadline)) : 'N/A' }}</td>
                                <td>
                                    @if($career->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $source->dtformat($career->created_at) }}</td>
                                <td class="text-right">
                                    <a href="{{route('career.show', $career->id)}}" class="text-info" title="View"><i class="material-icons">dvr</i></a>
                                    <a href="{{route('career.edit', $career->id)}}" class="text-warning" title="Edit"><i class="material-icons">edit</i></a>
                                    <a href="{{route('admin.career.delete', $career->id)}}" class="text-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this career?')"><i class="material-icons">delete</i></a>
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

@endsection

