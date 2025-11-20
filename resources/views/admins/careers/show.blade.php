@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('admin')
@section('title', 'View Career')
@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="blue">
                <i class="material-icons">work</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">{{ $career->title }}
                    <a href="{{route('career.edit', $career->id)}}" class="btn btn-warning btn-sm pull-right">
                        <i class="material-icons">edit</i> Edit
                    </a>
                </h4>
                
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <th width="150">Title:</th>
                                <td>{{ $career->title }}</td>
                            </tr>
                            <tr>
                                <th>Department:</th>
                                <td>{{ $career->department ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Location:</th>
                                <td>{{ $career->location ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Job Type:</th>
                                <td>{{ $career->type ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Salary:</th>
                                <td>
                                    @if($career->salary_min && $career->salary_max)
                                        ৳{{ number_format($career->salary_min, 2) }} - ৳{{ number_format($career->salary_max, 2) }}
                                    @elseif($career->salary_min)
                                        ৳{{ number_format($career->salary_min, 2) }}+
                                    @else
                                        Negotiable
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Deadline:</th>
                                <td>{{ $career->deadline ? date('F d, Y', strtotime($career->deadline)) : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if($career->status == 1)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>{!! $career->description !!}</td>
                            </tr>
                            @if($career->requirements)
                            <tr>
                                <th>Requirements:</th>
                                <td>{!! $career->requirements !!}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Created:</th>
                                <td>{{ $source->dtformat($career->created_at) }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated:</th>
                                <td>{{ $source->dtformat($career->updated_at) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('career.index')}}" class="btn btn-default">Back to List</a>
                        <a href="{{route('career.edit', $career->id)}}" class="btn btn-warning">Edit</a>
                        <a href="{{route('admin.career.delete', $career->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this career?')">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

