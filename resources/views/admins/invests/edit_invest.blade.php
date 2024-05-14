@extends('admin')
@section('title', 'Add New Invest')
@section('content')
    
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">edit</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Edit Invest</h4>

                {!! Form::model($invest, ['route' => ['invest.update', $invest->id], 'method' => 'PUT', 'id' => 'RegisterValidation']) !!}
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="form-group label-floating">                                
                            {{ Form::label('amount', 'Invest Amount', ['class' => 'control-label container-label']) }}
                            {{ Form::text('amount', $invest->amount, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('date', 'Invest Date', ['class' => 'control-label']) }}
                            {{ Form::text('date', $invest->date, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('whats_for', 'What\'s for', ['class' => 'control-label']) }}
                            {{ Form::text('whats_for', $invest->whats_for, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('vendor', 'Vendor Name', ['class' => 'control-label']) }}
                            {{ Form::text('vendor', $invest->vendor, ['class' => 'form-control border-input']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('details', 'Details', ['class' => 'control-label']) }}
                            {{ Form::textarea('details', $invest->details, ['class' => 'form-control border-input', 'rows' => '3']) }}
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-rose btn-fill pull-right">Update</button> 
                {!! Form::close() !!}
                                 
            </div>
        </div>
    </div>
</div><!-- end row -->
<script type="text/javascript">
    $(document).ready(function() {
        md.initSliders()
        demo.initFormExtendedDatetimepickers();
    });
</script> 
@endsection