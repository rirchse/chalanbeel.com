@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('admin')
@section('title', 'Add New Invest')
@section('content')
    
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">add</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Add New Invest</h4>
                <form action="{{route('invest.store')}}" method="post" id="RegisterValidation">
                  @csrf
                <div class="col-md-12">
                  <div class="form-group label-floating">
                    <label for="">Cost Amount</label>
                    <input type="number" class="form-control" name="amount">
                  </div>
                  <div class="form-group label-floating">
                    <label for="">Cost For?</label>
                    <input type="text" class="form-control" name="whats_for">
                  </div>
                  <div class="form-group label-floating">
                    <label for="">Date:</label>
                    <input type="date" class="form-control" name="date">
                  </div>
                  <div class="form-group label-floating">
                    <label for="">Details</label>
                    <textarea name="details" id="" class="form-control"></textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-rose btn-fill pull-right">ADD</button> 
              </form>
                                 
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">list</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Recent Invests</h4>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>What's For</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        <tbody>
                            <?php $r = 0; $total_amount = 0; ?>

                            @foreach($invests as $invest)

                            <?php $r++; ?>

                            <tr>
                                <td>{{ $r }}</td>
                                <td>&#2547;{{ $invest->amount }}</td>
                                <td>{{ $source->dformat($invest->date) }}</td>
                                <td>{{ $invest->whats_for }}</td>
                                <td class="text-right">
                                    <a href="/admin/invest/{{ $invest->id }}/edit" class="text-warning btn-simple" title="Edit the record"><i class="material-icons">edit</i></a>
                                </td>
                            </tr>

                            <?php $total_amount += $invest->amount; ?>

                            @endforeach

                            <tr>
                              <th colspan="7">
                                <a href="{{route('invest.index')}}">View More...</a>
                              </th>
                            </tr>

                        </tbody>
                    </table>
                </div>
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