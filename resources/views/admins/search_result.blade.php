@extends('admin')
@section('title', 'Showing Search Result')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Search Results</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>

                @if(!empty($search_worders))

                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Work Order</th>
                                <th>Account Name</th>
                                <th>Total Containers</th>
                                <th>Total Weight</th>                                
                                <th>Enter Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Work Order</th>
                                <th>Account Name</th>
                                <th>Total Containers</th>
                                <th>Office</th>
                                <th>Enter Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach($search_worders as $workorder)

                            <tr>
                                <td><a href="/admin/work_order_details/{{ $workorder->id }}">{{ $workorder->id }}</a></td>
                                <td><a href="/admin/work_order_details/{{ $workorder->id }}">{{ $workorder->client }}</a></td>
                                <td>{{ $workorder->container }}</td>
                                <td>{{ $workorder->weight }}</td>
                                <td title="{{ date('h:i:s', strtotime($workorder->created_at)) }}">{{ date('m/d/Y', strtotime($workorder->created_at)) }}</td>
                                <td class="text-right">
                                    <a href="/admin/work_order_details/{{ $workorder->id }}" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/work_order/{{$workorder->id}}/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the work order"><i class="material-icons">mode_edit</i></a>

                                    @if($workorder->status == 1)

                                    <a href="/admin/finished_work_order/{{$workorder->id}}" class="btn btn-simple btn-warning btn-icon" title="Mark the Work Order as finished!"><i class="material-icons">check</i></a>

                                    @elseif($workorder->status == 2)

                                    <a href="/admin/active_work_order/{{$workorder->id}}" class="btn btn-simple btn-success btn-icon" title="Move to active work order"><i class="material-icons">replay</i></a>

                                    <a href="/admin/delete_work_order/{{$workorder->id}}" class="btn btn-simple btn-warning btn-icon" title="Delete work order!"><i class="material-icons">delete</i></a>

                                    @endif

                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>

                @else

                <h3 class="text-warning">Searching value Doesn\'t match!</h3>

                @endif

            </div><!-- end content-->


        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row --> 
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });


        var table = $('#datatables').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });

        $('.card .material-datatables label').addClass('form-group');
    });
</script>

@endsection