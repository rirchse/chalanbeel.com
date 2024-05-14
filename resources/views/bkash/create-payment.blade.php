@extends('home')
@section('content')
<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
  <div class="content">
      <div class="container">
        <div class="col-md-6 col-md-offset-3">
          <div class="card">
            <form action="{{ route('bkash.pay') }}" method="POST" style="min-height:400px">
              @csrf
              <div class="form-group">
                <label>Enter Amount:</label>
                <input class="form-contr/ol" type="number" name="amount" placeholder="Enter amount" required>
              </div>
              <br>
              <button type="submit" class="btn btn-warning">
                <img src="/images/icons/bkash.png" alt="" style="width: 150px">
                Pay with bkash</button>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection