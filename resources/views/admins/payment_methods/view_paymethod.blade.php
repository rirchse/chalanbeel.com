@extends('admin')
@section('title', 'Showing all Payment Method')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Showing Paymethod</h4>
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Bank Name</th>
                                <th>Payment System</th>
                                <th>Operator</th>
                                <th>Country Code</th>
                                <th>Account No</th>
                                <th>Creation Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Bank Name</th>
                                <th>Payment System</th>
                                <th>Operator</th>
                                <th>Country Code</th>
                                <th>Account No</th>
                                <th>Creation Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php $r = 0; ?>

                            @foreach($paymethods as $paymethod)

                            <?php $r++; ?>

                            <tr>
                                <td><a href="/admin/paymethod/{{ $paymethod->id }}/edit">{{ $paymethod->bank_name }}</a></td>
                                <td><a href="/admin/work_order_details/{{ $paymethod->payment_system }}">{{ $paymethod->payment_system }}</a></td>
                                <td>{{ $paymethod->operator }}</td>
                                <td>{{ $paymethod->country_code }}</td>
                                <td>{{ $paymethod->account_number }}</td>
                                <td title="{{ date('H:i:s', strtotime($paymethod->created_at)) }}">{{ date('m/d/Y', strtotime($paymethod->created_at)) }}</td>
                                <td class="text-right">
                                    <a href="/admin/paymethod/{{ $paymethod->id }}/edit" class="btn btn-simple btn-info btn-icon"><i class="material-icons">dvr</i></a>
                                    <a href="/admin/paymethod/{{ $paymethod->id }}/edit" class="btn btn-simple btn-warning btn-icon" title="Edit the record"><i class="material-icons">mode_edit</i></a>

                                    <a href="#" class="btn btn-simple btn-danger btn-icon" title="Delete bil of lading!" onclick="document.getElementById('target{{$r}}').style.display = 'block';"><i class="material-icons">delete</i></a>

    {{ Form::open(['route' => ['admin.paymethod.delete', $paymethod->id], 'method' => 'DELETE', 'class' => 'button-form pull-left']) }}
    <div id="target{{$r}}" class="swal2-modal swal2-show delete-alert">
        <h2>Are you sure?</h2>
        <div class="swal2-content" style="display: block;">You want to delete this!</div>
        <hr class="swal2-spacer" style="display: block;">
        <button type="submit" class="btn btn-success"><i class="material-icons">check</i></button>
        <button class="btn btn-danger" type="button" onclick="this.parentNode.style.display = 'none';"><i class="material-icons">close</i></button>
    </div>
    {{ Form::close() }}
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