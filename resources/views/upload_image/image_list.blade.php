@extends('layouts.layout')
@section('title', '画像一覧｜PhotoBon_92')
@section('content')

{{-- アップロードページリンク --}}
<a href="{{ route('getForm') }}">Upload</a>
<hr />

{{-- 画像一覧 --}}
<h2 class="mt_40">新着画像</h2>

<div class="row mt_40 mb_120">

  @foreach($images as $image)
  <div class="col-lg-3">
    <img src="{{ url("https://kachibon.work/photobon92/public/storage/{$image->file_path}") }}" class="w-100"/>
    <p>{{ $image->file_name }}</p>
  </div>
  @endforeach

</div>

@endsection