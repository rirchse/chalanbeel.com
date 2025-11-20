@extends('home')
@section('title', __('messages.titles.check_account_details'))
@section('content')

<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
            <div class="card">

            {!! Form::open(['route' => 'check_account_details', 'method' => 'POST']) !!}
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">subject</i>
                </div>
                <div class="card-content">
                    <div class="col-md-10"><h4 class="card-title">Check Account Details</h4></div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="title">Type your internet account number</p>
                            <input id="number" class="form-contro" name="number" placeholder="01X XX XX XX XX" style="width:100%;padding:15px" autofocus="" required="" minlength="11" maxlength="11">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-fill pull-right">Submit</button>
                </div>
            </div>
            </div>
        </div><!-- container -->
            {!! Form::close() !!}

            {{ dd($service) }}

        </div>
    </div>

@endsection