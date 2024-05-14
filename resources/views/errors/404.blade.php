@include('partials.styles')

<div class="full-page login-page" filter-color="black" data-image="/images/login.jpg">
    <div class="content">
        <div class="container">
              <div class="row">
              	<div class="card-content" style="background:#fff; text-align:center">
                  <div class="col-md-6 col-md-offset-3">
                  	<h1 style="color:#fff;">404 Page Not Found!</h1>
                  	<a href="/"><h3 style="color:#eee;">Back to HomePage</h3></a>
                      <h2>{{ $exception->getMessage() }}</h2>
                  </div>
                 </div>
              </div>
          </div>
    </div>
</div>

@include('partials.scripts')