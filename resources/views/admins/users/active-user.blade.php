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
                                <th>IP Address</th>
                                <th>Status</th>
                                <th>Name</th>
                                <th>Ethernet</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                          @foreach ($arp_users as $key => $item)
                          <tr style="{{$item['status'] == 'No Entry' ? 'color:red':''}}">
                            <td>{{$key+1}}</td>
                            <td>{{$item['address']}}</td>
                            <td>{{$item['status']}}</td>
                            <td>{{$item['interface']}}</td>
                          </tr>
                              
                          @endforeach

                            {{-- @for($u = 0; $u < count($arp_users); $u++)

                            <tr>
                                <td>{{$u+1}}</td>
                                <td class="text-right"></td>
                            </tr>

                            @endfor --}}

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