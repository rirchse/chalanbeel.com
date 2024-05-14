@extends('admin')
@section('title', 'View Areas')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Areas</h4>
                <div class="toolbar" style="text-align:right">
                    <a class="btn btn-success btn-xs" href="/admin/add_new_area" title="Add New area"><i class="material-icons">add</i></a>
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Station</th>
                                <th>Area</th>
                                <th>Village</th>
                                <th>Contact</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Station</th>
                                <th>Area</th>
                                <th>Village</th>
                                <th>Contact</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $r = 0; $total_amount = 0; ?>

                            @foreach($areas as $area)

                            <?php $r++; ?>

                            <tr>
                                <td>{{ $r }}</td>
                                <td>{{ $area->station }}</td>
                                <td>{{ $area->area }}</a></td>
                                <td>{{ $area->village }}</td>
                                <td>{{ $area->contact }}</td>
                                <td class="text-right">
                                    <a href="/admin/area_details/{{ $area->id }}" class="text-info"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/edit_area/{{ $area->id }}/edit" class="text-warning" title="Edit the record"><i class="material-icons">edit</i></a>
                                </td>
                            </tr>

                            <?php $total_amount += $area->amount; ?>

                            @endforeach

                        </tbody>

                            <tr>
                                <th colspan="3"></th>
                                <th>Total = </th>
                                <th>&#2547;{{$total_amount}}</th>
                                <th colspan="2"></th>
                            </tr>
                    </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row --> 
@endsection