@extends('user')
@section('title', 'Showing Services')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Services</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Bill</th>
                                <th>Billing Date</th>
                                <th>Status</th>
                                <th>Closed Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Bill</th>
                                <th>Billing Date</th>
                                <th>Status</th>
                                <th>Closed Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 1; ?>

                            @foreach($services as $service)

                            <tr>
                                <td>{{$r}}</td>
                                <td>{{ $service->username }}</td>
                                <td>{{ $service->speed }}</td>
                                <td>{{ $service->time_limit }}</td>
                                <td>{{ $service->amount }}</td>
                                <td>{{ date('d M Y', strtotime($service->billing_date)) }}</td>
                                <td>
                                    @if($service->status == 0)
                                    <span style="color:#d00">Unpaid
                                    @elseif($service->status == 1)
                                    <span style="color:#0d0">Active
                                    @else
                                    <span style="color:#d00">Closed
                                    @endif
                                </td>
                                <td>{{ $service->end_at?date('d M Y', strtotime($service->end_at)):'On Going' }}</td>
                                <td class="text-right">
                                    {{-- <a href="/service/{{ $service->id }}/edit" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a> --}}
                                    {{-- <a href="/service/{{ $service->id }}/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the record"><i class="material-icons">mode_edit</i></a> --}}
                                </td>
                            </tr>
                            <?php $r++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- end content-->
        </div> <!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row --> 
@endsection