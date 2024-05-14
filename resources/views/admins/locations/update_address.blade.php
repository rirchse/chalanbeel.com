@extends('admin')
@section('title', 'Update Address')
@section('content')

<div class="row">
        <div class="col-md-12">
            <div class="card">

                {{ Form::open(['route' => 'admin.add.address', 'method' => 'POST', 'id' => 'RegisterValidation']) }}
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">add</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Update Address</h4>

                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                
                                {{ Form::label('stop', 'Pickup & Delivery Title', ['class' => 'control-label']) }}
                                {{ Form::text('stop', null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('first', 'First', ['class' => 'control-label']) }}
                                {{ Form::text('first', null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('last', 'Last', ['class' => 'control-label']) }}
                                {{ Form::text('last', null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('address', 'Address', ['class' => 'control-label']) }}
                                {{ Form::text('address', null, ['class' => 'form-control border-input']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                {{ Form::label('city', 'City', ['class' => 'control-label']) }}
                                {{ Form::text('city', null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('state', 'State', ['class' => 'control-label']) }}
                                {{ Form::text('state', null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('zip', 'ZIP', ['class' => 'control-label']) }}
                                {{ Form::text('zip', null, ['class' => 'form-control border-input']) }}
                            </div>
                            <div class="form-group label-floating">
                                {{ Form::label('telephone', 'Telephone', ['class' => 'control-label']) }}
                                {{ Form::text('telephone', null, ['class' => 'form-control border-input']) }}
                            </div>
                        </div>
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-rose btn-fill">Update Address</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
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