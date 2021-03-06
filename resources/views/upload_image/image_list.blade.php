




<a href="{{ route('getForm') }}">Upload</a>
<hr />

@foreach($images as $image)
<div style="width: 18rem; float:left; margin: 16px;">
	<img src="{{ url("https://kachibon.work/photobon92/public/storage/{$image->file_path}") }}" style="width:100%;"/>
	<p>{{ $image->file_name }}</p>
</div>

@endforeach