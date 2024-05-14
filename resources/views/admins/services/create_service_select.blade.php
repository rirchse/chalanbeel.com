@extends('admin')
@section('title', 'All Packages')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">All Packages</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Connection</th>
                                <th>Service</th>
                                <th>Created At</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Connection</th>
                                <th>Service</th>
                                <th>Created At</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 0; ?>

                            @foreach($services as $service)

                            <?php $r++; ?>

                            <tr>
                                <td>{{ $r }}</td>
                                <td>{{ $service->speed }}</td>
                                <td>{{ $service->time_limit }}</a></td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->discount }}</td>
                                <td>{{ $service->connection }}</td>
                                <td>{{ $service->service }}</td>
                                <td title="{{ date('H:i:s', strtotime($service->created_at)) }}">{{ date('d M Y', strtotime($service->created_at)) }}</td>
                                <td class="text-right">
                                    <a href="/admin/create/{{ $service->id }}/service/{{$user->id}}" class="btn btn-xs btn-warning">Get<i class="material-icons"></i></a>
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