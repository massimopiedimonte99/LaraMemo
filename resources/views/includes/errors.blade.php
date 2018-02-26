@if(count($errors) > 0)
	<h1 class="error-heading">Whooooooops!</h1>
	<hr class="error-separator" />
	@foreach($errors->all() as $error)
		<p class="error-message">{{ $error }}</p>
	@endforeach <hr class="error-separator" />
@endif

@if(Session::has('error-message'))
	<h1 class="error-heading">Whooooooops!</h1>
	<hr class="error-separator" />
	<p class="error-message">{!! Session::get('error-message') !!}</p>
	<hr class="error-separator" />
@endif