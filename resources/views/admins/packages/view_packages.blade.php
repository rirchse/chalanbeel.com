@extends('admin')
@section('title', 'View all Packages')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing all Packages ({{count($packages)}})</h4>
                <div class="toolbar" style="text-align:right">
                    <a class="btn btn-success btn-xs" href="/admin/create_package" title="Add New package"><i class="material-icons">add</i></a>
                    {{-- <a class="btn btn-xs btn-info" href="/admin/get_package_from_router">Get Pacakge From Router</a> --}}
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>service_mode</th>
                                <th>server</th>
                                <th>connection</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>service_mode</th>
                                <th>server</th>
                                <th>connection</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($packages as $package)
                            <tr>
                                <td>{{ $package->speed }}</td>
                                <td>{{ $package->time_limit }}</a></td>
                                <td>{{ $package->service_mode }}</td>
                                <td>{{ $package->server }}</td>
                                <td>{{ $package->connection }}</td>
                                <td>&#2547;{{ $package->price }}</a></td>
                                <td>{{ $package->discount }}%</td>
                                <td>
                                    @if($package->status == 1)
                                    <span class="text-success text-simple" title="Active"><i class="material-icons">check</i></span>
                                    @else
                                    <span class="text-warning text-simple" title="Inactive"><i class="material-icons">close</i></span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="/admin/package/{{ $package->id }}" class="btn btn-simple btn-icon btn-info"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/package/{{ $package->id }}/edit" class="btn btn-simple btn-icon btn-warning" title="Edit the record"><i class="material-icons">edit</i></a>
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