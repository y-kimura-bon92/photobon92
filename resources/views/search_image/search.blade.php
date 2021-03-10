@extends('layouts.layout')
@push('css')
    <link href="{{ asset('css/image_list.css') }}" rel="stylesheet">
@endpush

@section('title', '画像一覧｜PhotoBon 92')
@section('content')


{{-- 画像一覧 --}}
<h2 class="mt_120">画像検索</h2>

<form action="{{ route('getSearch')}}" method="post">
  {{ csrf_field()}}
  {{method_field('get')}}

  <div class="form-group row">
    <input type="text" class="col-lg-8" placeholder="検索したい名前を入力してください" name="keyword_image_name">
    <button type="submit" class="btn btn-success col-lg-4">検索</button>
  </div>
</form>

  @if(!empty($message))
    <div class="alert alert-primary" role="alert">{{ $message}}</div>
  @endif

  @if(isset($images))
  <div class="row mt_40 mb_120">

    @foreach($images as $image)
      <div class="col-lg-3 col-4 mb_40 sp_mb_20 text-center image_item">
        {{-- lightbox --}}
        <a href="{{ url("https://kachibon.work/photobon92/public/storage/{$image->file_path}") }}" data-lightbox="fuga" data-title="{{ $image->image_name }}">
          <img src="{{ url("https://kachibon.work/photobon92/public/storage/{$image->file_path}") }}" alt="{{ $image->image_name }}" class="image">
        </a>
        
        <p class="mt_10 sp_mt_0">
          <a class="dounload_link" href="{{ url("https://kachibon.work/photobon92/public/storage/{$image->file_path}") }}" download="{{ $image->file_name }}" type="button" onclick="return checkDounload()">ダウンロード</a>
        </p>
      </div>
    @endforeach

    {{ $pagenate->links() }}

  </div>
  @endif

  
  

@endsection