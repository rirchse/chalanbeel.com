@extends('home')
@section('title', 'Register')
@section('content')
<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Packages</h4>
                    <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($packages as $package)
                            <tr>
                                <td>{{ $package->speed }}bps</td>
                                <td>{{ $package->time_limit }}</a></td>
                                <td>&#2547;{{ $package->price }}</a></td>
                                <td class="text-right">
                                    <a href="/package/{{ $package->id }}/select" class="btn btn-xs btn-warning" title="Edit the record">Buy</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection