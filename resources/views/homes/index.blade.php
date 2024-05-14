@extends('home')
@section('title', '')
@section('content')

<style type="text/css">
    .search{border: 1px solid #fff;}
    .search-alert{background: #fff;padding: 10px 20px;font-size: 18px;font-weight: bold;color:orange;box-shadow: 5px 5px 15px #000;display: none;}
</style>

<div class="full-page login-page" filter-color="" data-image="images/login.jpg">
    <div class="content">
        <div class="container">
            <div class="col-md-12">
                <div class="" style="text-align:center;width:100%;max-width:600px;margin:0 auto;">
                    <div class="">
                        <img src="images/logo.png" class="img-responsive" style="margin:0 auto">
                        {{-- <h3>{{bcrypt('tstadmin')}}</h3> --}}
                        <form class="form-horizontal">
                            <div class="form-group">
                                <input id="search" type="text" class="form-control" style="width:100%; height:45px; background:#efefef; padding:15px 20px;box-shadow: 1px 1px 5px; text-align:cente" placeholder="What &nbsp;  &nbsp;you &nbsp; &nbsp; are &nbsp; &nbsp; looking &nbsp; &nbsp;for?">
                            </div> 

                        <div id="search_alert" class="search-alert" style="position: absolute;">We are being ready to give you best service. Please be connect with us.</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    var search = document.getElementById('search');
    search.addEventListener('keyup', check);
    function check() {
        document.getElementById('search_alert').style.display = 'block';

        setTimeout(function(){
            document.getElementById('search_alert').style.display = 'none';
        }, 10000);        
    }
    
    </script>
@endsection