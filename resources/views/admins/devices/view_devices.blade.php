@extends('admin')
@section('title', 'View Devices')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Devices</h4>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Device Name</th>
                                <th>IP Address</th>
                                <th>User/Pass</th>
                                <th>Frequency</th>
                                <th>Location</th>
                                <th>MAC Address</th>
                                <th>Device Model</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Device Name</th>
                                <th>IP Address</th>
                                <th>User/Pass</th>
                                <th>Frequency</th>
                                <th>Location</th>
                                <th>MAC Address</th>
                                <th>Device Model</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 0;?>

                            @foreach($devices as $device)

                            <?php $r++; ?>

                            <tr>
                                <td>{{ $device->device_name }}</td>
                                <td><a target="_blank" href="http://{{ $device->ip }}">{{ $device->ip }}</a></td>
                                <td value="{{ $device->username.'/'.$device->password }}" onclick="showPassword(this);">*****</td>
                                <td>{{ $device->frequency }}</td>
                                <td>{{ $device->station }}</td>
                                <td>{{ $device->mac }}</a></td>
                                <td>{{ $device->model_no }}</td>
                                <td class="text-right">
                                    <a href="/admin/device/{{ $device->id }}" class="text-info"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/device/{{ $device->id }}/edit" class="text-warning" title="Edit the record"><i class="material-icons">edit</i></a>
                                    @if(count(App\Device::where('parent_id', $device->id)->get()) > 0)
                                    <a href="/admin/device/{{ $device->id }}/childs" class="text-success" title="View Child Devices"><i class="material-icons">assignment</i></a>
                                    @endif
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