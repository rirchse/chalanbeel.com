@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('user')
@section('title', 'Showing payments')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Payments</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Date</th>
                              <th>Amount</th>
                              <th>Package</th>
                              <th>Status</th>
                              <th class="text-right disabled-sorting">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Package</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                          @foreach($payments as $key => $payment)
                          <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$source->dtformat($payment->receive_date)}}</td>
                              <td>{{$payment->package ? $payment->package->price:''}}</td>
                              <td>{{$payment->package ? $payment->package->speed:''}}
                                <br>
                                 {{$payment->package ? $payment->package->time_limit:''}}</td>
                              <td>
                                  @if($payment->status == 'Paid')
                                  <span class="label label-success">{{$payment->status}}</span>
                                  @else
                                  <span class="label label-danger">{{$payment->status}}</span>
                                  @endif
                              </td>
                              <td class="text-right">
                                <a class="btn btn-info btn-sm" href="{{route('user.invoice', $payment->id)}}">invoice</a>
                              </td>
                          </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div> <!-- end content-->
        </div> <!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row --> 
@endsection