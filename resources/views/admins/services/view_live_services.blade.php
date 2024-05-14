@extends('admin')
@section('title', 'View Live Users')
@section('content')

<style type="text/css">
    .item-wrapper{margin-bottom: 15px;float: left;width: 15%;margin-right: 10px;}
    .item-box{border:1px solid #ddd; padding: 10px;text-align: center;}

</style>

<?php
$live = [];
foreach($liveusers as $liveuser){
    $live[] = $liveuser('name');
}

?>

{{-- {{dd($liveusers)}} --}}
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h4 class="card-title text-success">Live Services [<b>{{count($live)}}</b>]</h4>
                <div class="toolbar">
                    <span></span>
                </div>
                <div class="col-md-12">
                    @foreach($services as $service)
                    <div class="item-wrapper">
                        <div class="item-box" style="background:#{{in_array($service->username, $live)?'0f0':'ddd'}}">
                            <a href="/admin/service/{{$service->id}}/edit">{{$service->username}}<br>
                            {{substr($service->full_name, 0, 10)}}</a><br>
                        </div>
                    </div>
                    @endforeach
                    <br><br>
                </div>
                <div class="clearfix"></div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div><!-- end col-md-12 -->
</div><!-- end row -->
@endsection