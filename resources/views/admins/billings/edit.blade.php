@extends('admin')
@section('title', 'Edit Payment Receive')
@section('content')
    
      <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">edit</i>
                </div>
                <div class="card-content">
                  <h4 class="card-title">Edit Payment</h4>
                  <div class="col-sm-12">
                  <div class="action-tools" style="text-align:right; margin-bottom:10px">
                      <a class="btn btn-success btn-sm" title="View Paid Bills" href="{{route('payment.index')}}"><i class="fa fa-list"></i></a>
                  </div>
                </div>
                
                <form action="{{route('payment.update', $payment->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Payment Received:</label>
                            <input type="date" name="receive_date" class="form-control" value="{{date('Y-m-d')}}" onkeyup="addOneMonth(this)" onchange="addOneMonth(this)">
                          </div>
                          <div class="form-group">
                            <label for="">Amount:</label>
                            <input type="number" name="receive" class="form-control" value="{{$payment->receive}}">
                          </div>
                          <div class="form-group">
                            <label for="">Next Payment Date:</label>
                            <input type="date" name="payment_date" class="form-control" value="{{date('Y-m-d', strtotime('+1 months'))}}" id="paymentDate">
                          </div>
                          <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
      </div><!-- end row -->
@endsection
@section('scripts')
    <script>
    var hide_field = document.getElementsByClassName('hide_field');
    var hide_ctrl = document.getElementById('hide_ctrl');
    hide_ctrl.addEventListener('change', change);
    function change(){
        if(hide_ctrl.options[hide_ctrl.selectedIndex].innerHTML == 'Cash') {
            for(var x = 0; x < hide_field.length; x++){
                hide_field[x].style.display = 'none';
            }
        } else {
            for(var x = 0; x < hide_field.length; x++){
                hide_field[x].style.display = 'block';
            }
        }
    }
    change();
    </script>
@endsection