@if(Session::has('success'))

	<div class="alert alert-success col-md-8" role="alert" style="max-width: 600px; right:0">
		<div class="alert-container">		
			<strong>Success:</strong> {!! Session::get('success') !!}
			<i class="material-icons alert-i" onclick="this.parentNode.parentNode.style.display = 'none';">clear</i>	
		</div>		
	</div>

@endif

@if(Session::has('error'))

	<div class="alert alert-danger col-md-8" role="alert" style="max-width: 600px; right:0">
		<div class="alert-container">		
			<strong>Error:</strong> {!! Session::get('error') !!}
			<i class="material-icons alert-i" onclick="this.parentNode.parentNode.style.display = 'none';">clear</i>	
		</div>		
	</div>

@endif

@if(count($errors) > 0)

	<div class="alert alert-danger" role="alert" style="max-width: 600px; right:0">
		<div class="alert-container">
			<strong>Errors:</strong>
			<ul>
			
			@foreach($errors->all() as $error)

				<li>{!! $error !!}</li>


			@endforeach
			
			</ul>
			<span class="pull-right" style="position:absolute; right:0;top:0">
				<i class="material-icons alert-i" onclick="this.parentNode.parentNode.parentNode.style.display = 'none';">clear</i>	
			</span>
		</div>		

	</div>

@endif