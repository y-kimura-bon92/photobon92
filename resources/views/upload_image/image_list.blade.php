@extends('layouts.layout')

@push('css')
    <link href="{{ asset('css/image_list.css') }}" rel="stylesheet">
@endpush

@section('title', '画像一覧｜PhotoBon 92')
@section('content')

{{-- 画像一覧 --}}
<h2 class="mt_120">新着画像一覧</h2>



{{-- ================== --}}

<form action="{{ url('/serch')}}" method="post">
  {{ csrf_field()}}
  {{method_field('get')}}
  <div class="form-group">
    <label>画像名</label>
    <input type="text" class="form-control col-md-5" placeholder="検索したい名前を入力してください" name="name">
    <button type="submit" class="btn btn-primary col-md-5">検索</button>
  </div>
</form>
    
{{-- ================== --}}


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

</div>

{{-- ダウンロード確認ダイアログ --}}
<script>
  function checkDounload(){
  if(window.confirm('ダウンロードしますか？')){
      return true;
  } else {
      return false;
  }
  }
</script>

@endsection