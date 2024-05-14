@extends('admin')
@section('title', 'Device Details')
@section('content')
    {{-- {{dd($device)}} --}}
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content" style="">
                <div class="col-md-5">
                    <h4 class="card-title">Device Details</h4>
                </div>
                <div class="col-sm-12">
                    <div class="action-tools" style="text-align:right; margin-bottom:10px">
                        <a class="text-info" title="Add New Device" href="/admin/device/create"><i class="material-icons">add</i></a>
                        <a class="text-success" title="View Devices" href="/admin/device"><i class="material-icons">assignment</i></a>
                        <a class="text-warning" title="Edit" href="/admin/device/{{$device->id}}/edit"><i class="material-icons">edit</i></a>
                        @if(count(App\Device::where('parent_id', $device->id)->get()) > 0)
                        <a href="/admin/device/{{ $device->id }}/childs" class="text-primary" title="View Child Devices"><i class="material-icons">assignment</i></a>
                        @endif
                        @if($device->parent_id)
                        <a class="text-info" title="Parent Device" href="/admin/device/{{$device->parent_id}}"><i class="material-icons">assignment</i></a>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-content">
                            <div class="table-responsive table-space">
                                <table class="table table-bordered table-space">
                                        <tbody>
                                            <tr>
                                                <th>Device Name</th>
                                                <td>{{ $device->device_name }}</td>
                                            </tr>
                                            @if($device->parent_id)
                                            <tr>
                                                <th>Parent Device</th>
                                                <th>{{ App\Device::find($device->parent_id)->device_name }}<br>{{ App\Device::find($device->parent_id)->mac }}<br>{{ App\Device::find($device->parent_id)->ip }}</th>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>IP Address</td>
                                                <td>{{ $device->ip }}</td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td>{{ $device->username }}</td>
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td>{{ $device->password }}</td>
                                            </tr>
                                            <tr>
                                                <td>MAC Address</td>
                                                <td>{{ $device->mac }}</td>
                                            </tr>
                                            <tr>
                                                <td>Model No.</td>
                                                <td>{{ $device->model_no }}</td>
                                            </tr>
                                            <tr>
                                                <td>Device Mode</td>
                                                <td>{{ $device->wireless_mode }}</td>
                                            </tr>
                                            <tr>
                                                <td>SSID</td>
                                                <td>{{ $device->ssid }}</td>
                                            </tr>
                                            <tr>
                                                <td>security</td>
                                                <td>{{ $device->security }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>{{ $device->status }}</td>
                                            </tr>
                                            <tr>
                                                <td>Created By</td>
                                                <td>{{ $device->first_name.' '.$device->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Created On</td>
                                                <td>{{ $device->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td>Config File</td>
                                                <td>
                                                    @if($device->config_file)
                                                    <a href="/uploads/configs/{{ $device->config_file }}" download>Download [ {{date('d M Y', strtotime(substr($device->config_file, 0, 6)))}} ]</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ScreenShot:</td>
                                                <td>
                                                    <a target="_blank" href="/uploads/device_images/{{$device->image}}"><img style="max-width:100px" src="/uploads/device_images/{{$device->image}}"></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- end row --> 
@endsection