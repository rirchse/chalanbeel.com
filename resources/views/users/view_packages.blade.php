@extends('user')
@section('title', 'Packages for User')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Packages</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Connection</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Connection</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 1; ?>

                            @foreach($packages as $package)

                            <tr>
                                <td>{{$r}}</td>
                                <td>{{ $package->service }}</td>
                                <td>{{ $package->connection }}</td>
                                <td>{{ $package->speed }}</td>
                                <td>{{ $package->time_limit }}</td>
                                <td>&#x9f3;{{ number_format($package->price, 0) }}</td>
                                <td>{{ $package->discount? number_format($package->discount,0).'%':'' }} </td>
                                <td>
                                    @if($package->status == 0)
                                    <span style="color:#d00">Inactive
                                    @elseif($package->status == 1)
                                    <span style="color:#0d0">Active
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="/package/{{ $package->id }}/edit" class="btn btn-simple btn-info btn-icon" title="View details"><i class="material-icons">dvr</i></a>
                                    <a href="/package/{{ $package->id }}/get" class="btn btn-xs btn-warning btn-icon" title="Get internet package">Get<i class="material-icons">arrow_right</i></a>
                                </td>
                            </tr>
                            <?php $r++; ?>

                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row --> 
@endsection