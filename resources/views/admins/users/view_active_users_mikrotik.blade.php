@extends('admin')
@section('title', 'View Active Users')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Active Users</h4>
                <div class="toolbar text-right">
                    <a class="btn btn-info btn-simple btn-icon" href="/admin/active/users/mikrotik">chek on mikrotik</a>
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Caller ID</th>
                                <th>Address</th>
                                <th>Uptime</th>
                                <th>Service</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Caller ID</th>
                                <th>Address</th>
                                <th>Uptime</th>
                                <th>Service</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php $r = 0; ?>

                            @foreach($users as $user)

                            <?php $r++; ?>

                            <tr>
                                <td>{{$r}}</td>
                                <td>{{ $user('name') }}</td>
                                <td>{{ $user('caller-id') }}</td>
                                <td>{{ $user('address') }}</td>
                                <td>{{ $user('uptime') }}</td>
                                <td>{{ $user('service') }}</td>
                                <td class="text-right">
                                    {{-- <a href="/admin/user/{{ $user('id') }}/details" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a> --}}
                                    <a href="/admin/user/{{$user('id')}}/edit" class="btn btn-xs btn-danger btn-icon" title="Edit the record"><i class="material-icons" onclick="return confirm('Are you sure you want to disconnect this user!')">close</i></a>
                                    {{-- <a href="/admin/create/{{$user('id')}}/service" class="btn btn-simple btn-success btn-icon" title="Add New Servcie"><i class="material-icons">add_circle</i></a> --}}
                                </td>
                            </tr>

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