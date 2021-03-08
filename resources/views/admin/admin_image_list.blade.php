@extends('layouts.admin_layout')

@push('css')
    <link href="{{ asset('css/admin_image_list.css') }}" rel="stylesheet">
@endpush

@section('title', '管理画面 画像一覧｜PhotoBon_92')
@section('content')

{{-- 画像一覧 --}}
<h2 class="mt_120">管理画面｜画像一覧</h2>

{{-- 更新時のflash --}}
@if (session('err_msg'))
<p class="text-danger">
  {{ session('err_msg') }}
</p>
@endif

<div class="row mt_40 mb_120">

  @foreach($images as $image)
  <div class="col-lg-3 col-4 mb_40 image_item">
    {{-- 画像表示、クリックで詳細ページ --}}
    <a href="/photobon92/public/details_92/{{ $image->id }}">
      <img src="{{ url("https://kachibon.work/photobon92/public/storage/{$image->file_path}") }}" class="image" style="max-height: 210px;"/>
    </a>

    <table class="table table-bordered mt_20">
      <tbody>
        <tr>
          <th>画像名</th>
          <td>{{ $image->image_name }}</td>
        </tr>
        <tr>
          <th>ファイル名</th>
          <td>{{ $image->file_name }}</td>
        </tr>
      </tbody>
    </table>
  </div>
  @endforeach

</div>

@endsection