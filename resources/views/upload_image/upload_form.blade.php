@extends('layouts.layout')
@section('content')


@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<form method="post" action="{{ route('postUpload') }}" enctype="multipart/form-data">
	@csrf
	<input type="file" name="image" accept="image/png, image/jpeg ,image/jpg">
	<input type="submit" value="Upload">
</form>

@endsection