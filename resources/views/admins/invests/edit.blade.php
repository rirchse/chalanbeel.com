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
                  <div class="form-group label-floating">
                    <label for="">Cost Amount</label>
                    <input type="number" class="form-control" name="amount" value="{{$invest->amount}}">
                  </div>
                  <div class="form-group label-floating">
                    <label for="">Cost For?</label>
                    <input type="text" class="form-control" name="whats_for" value="{{$invest->whats_for}}">
                  </div>
                  <div class="form-group label-floating">
                    <label for="">Date:</label>
                    <input type="date" class="form-control" name="date" value="{{$invest->date}}">
                  </div>
                  <div class="form-group label-floating">
                    <label for="">Details</label>
                    <textarea name="details" id="" class="form-control"> {{$invest->details}}</textarea>
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