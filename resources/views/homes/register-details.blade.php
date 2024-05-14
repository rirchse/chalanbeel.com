@extends('home')
@section('title', 'Register')
@section('content')
<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple"><i class="material-icons">phone</i></div>
                        <div class="card-content">
                            <h4 class="card-title">Contact Verification</h4>
                            <div class="col-md-12">
                                <h3>Thank you for Sign up</h3>
                                <h4>Please verify your contact number.</h4>
                                <h1>{{$register->contact}}</h1>

                                <label><input id="terms" type="checkbox" value="Yes" onclick="showbtn(this)"> I have checked my contact number and I am agree to the terms and condition.</label>

                                {!! Form::model($register, ['route' => ['register.sendsms', $register->remember_token], 'method' => 'PUT']) !!}
                                <div class="form-group">
                                    <input class="btn btn-success pull-right" type="submit" value="Send SMS" id="sndbtn" disabled>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
            </div> <!--/row-->
        </div> <!--/container-->
    </div> <!--/content-->
</div> <!--/full-page-->

<script type="text/javascript">

function showbtn(elm){
    var sndbtn = document.getElementById('sndbtn');
    if(elm.checked){
        sndbtn.removeAttribute('disabled');
    } else {
        sndbtn.setAttribute('disabled', 'disabled');
    }
}
</script>
@endsection