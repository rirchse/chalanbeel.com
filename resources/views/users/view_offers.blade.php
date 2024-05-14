@extends('user')
@section('title', 'Showing Services')
@section('content')
    
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Your Offers</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="com-md-12">
                    @if(Auth::user()->status == 0)
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title"><h2>1Day Free Package</h2></h3>
                      </div>
                      <div class="panel-body"> 
                        <form action="{{ route('user.requestOffer') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea class="form-control" name="details" placeholder="Please write down here why you want to do this?" required rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning btn-lg btn-right">Get Package</button>
                        </form>
                            
                      </div>
                    </div>
                    @else
                    <h2>Stay connect... We will offer you very soon. Thank you <a class="btn btn-warning" href="/view_packages">Get Internet</a></h2>
                    @endif
                </div>
                <!--
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Connection</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Connection</th>
                                <th>Speed</th>
                                <th>Time Limit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 1; ?>

                            @foreach($offers as $service)

                            <tr>
                                <td>{{$r}}</td>
                                <td>{{ $service->service }}</td>
                                <td>{{ $service->connection }}</td>
                                <td>{{ $service->speed }}</td>
                                <td>{{ $service->time_limit }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->discount }}</td>
                                <td>
                                    @if($service->service_status == 0)
                                    <span style="color:#d00">Unpaid
                                    @elseif($service->service_status == 1)
                                    <span style="color:#0d0">Paid
                                    @endif
                                </td>
                                <td title="{{ date('H:i:s', strtotime($service->created_at)) }}">{{ date('d M Y', strtotime($service->created_at)) }}</td>
                                <td class="text-right">
                                    <a href="/service/{{ $service->id }}/edit" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a>
                                    <a href="/service/{{ $service->id }}/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the record"><i class="material-icons">mode_edit</i></a>
                                </td>
                            </tr>
                            <?php $r++; ?>

                            @endforeach


                        </tbody>
                    </table>
                </div>
            -->
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row --> 
@endsection