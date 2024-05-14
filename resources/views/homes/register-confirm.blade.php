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
                                <h3>Is this you?</h3>
                                <h4>Please verify your information.</h4>
                                <div class="panel panel-danger">
                                    <div class="panel-heading"><h2>{{$exuser->full_name}}</h2></div>
                                    <div class="panel-footer"> <h2>{{$exuser->contact}}</h2></div>
                                </div>
                                
                               

                                <label><input id="terms" type="checkbox" value="Yes" onclick="showbtn(this)"> Yes, this me and I am agree to the terms and condition.</label>

                                {!! Form::model($exuser, ['route' => ['register.sendsms', $exuser->remember_token], 'method' => 'PUT']) !!}
                                <div class="form-group">
                                    <a class="btn btn-warning" href="/package/{{Session::get('_package_id')?Session::get('_package_id'):''}}/select">No, this is not me.</a>
                                    @if($exuser)
                                    <a class="btn btn-success pull-right" href="/package/{{$exuser->id}}" id="sndbtn">Next</a>
                                    @else
                                    <input class="btn btn-success pull-right" type="submit" value="Next" id="sndbtn" disabled>
                                    @endif
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