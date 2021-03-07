@extends('layouts.layout')
@section('title', '管理画面 画像一覧｜PhotoBon_92')
@section('content')

{{-- アップロードページリンク --}}
<a href="{{ route('getForm') }}">Upload</a>
<hr />

{{-- 画像一覧 --}}
<h2 class="mt_40">新着画像</h2>

<div class="row mt_40 mb_120">

  @foreach($images as $image)
  <div class="col-lg-3">
    {{-- 画像表示、クリックで詳細ページ --}}
    <a href="/photobon92/public/details_92/{{ $image->id }}">
      <img src="{{ url("https://kachibon.work/photobon92/public/storage/{$image->file_path}") }}" class="w-100"/>
    </a>
    {{-- ファイル名 --}}
    <label for="">ファイル名</label>
    <p>{{ $image->file_name }}</p>
    <p>{{ $image->image_name }}</p>

    {{-- 画像名 --}}
    <label for="">画像名</label>
    <input type="text" name="image_name" value="{{ $image->image_name }}">
  </div>
  @endforeach

</div>

@endsection