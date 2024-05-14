@extends('admin')
@section('title', 'View all Services')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Services</h4>
                <div class="toolbar text-right">
                    <a class="text-success" href="/admin/user" title="Add New Service"><i class="material-icons">add</i></a>
                    <a class="text-info" href="/admin/print_due_services" title="Print"><i class="material-icons">print</i></a>
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Bill(Tk.)</th>
                                <th>Date</th>
                                <th>User+Contact</th>
                                <th>Username</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right" width="100">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Bill(Tk.)</th>
                                <th>Date</th>
                                <th>User+Contact</th>
                                <th>Username</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $r = 0;
                            $total_amount = 0;
                            $total_receive = 0;
                            ?>

                            @foreach($services as $service)

                            <?php $r++; ?>

                            <tr>
                                <td>{{ $r }}</td>
                                <td>{{ $service->speed .' - '.$service->time_limit}}</td>
                                <td>{{ $service->amount?$service->amount:'' }}</td>
                                <td>{{ $service->billing_date? date('d M Y', strtotime($service->billing_date)):'' }}</td>
                                <td>{{ $service->full_name }}</a></td>
                                <td>{{ $service->username }}</a></td>
                                <td>{{ $service->billing_plan }}</a></td>
                                <td>
                                    @if($service->status == 1)
                                    <span class="label label-success">Active</span>
                                    @else
                                    <span class="label label-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-simple btn-icon btn-info" href="/admin/service/{{ $service->id }}" class="text-info"><i class="material-icons">dvr</i></a>
                                    <a class="btn btn-simple btn-icon btn-warning" href="/admin/service/{{ $service->id }}/edit" class="text-warning" title="Edit the record"><i class="material-icons">edit</i></a>
                                    {{-- <a href="/admin/payment/{{$service->id}}/add" class="btn btn-simple btn-success btn-icon" title="Add Payment"><i class="material-icons">payment</i></a> --}}
                                </td>
                            </tr>

                            <?php 

                            $total_amount += $service->amount;
                            $total_receive += $service->receive;

                            ?>

                            @endforeach

                        </tbody>
                            <tr>
                                <th colspan="2">Total = </th>
                                <th>&#2547;{{$total_amount}}</th>
                                <th colspan="2"></th>
                                <th>&#2547;{{$total_receive}}</th>
                                <th colspan="3"></th>
                            </tr>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row --> 
@endsection