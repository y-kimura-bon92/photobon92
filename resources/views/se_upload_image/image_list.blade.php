@extends('layouts.selayout')

@push('css')
    <link href="{{ asset('css/image_list.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/seCommon.css') }}">
@endpush

@section('title', '画像一覧｜PhotoBon 92')
@section('content')

{{-- 画像一覧 --}}
<h2 class="mt_120">新着画像一覧</h2>

{{-- 検索フォーム --}}
<form action="{{ route('SeGetList')}}" method="get">
  {{ csrf_field()}}
  {{method_field('get')}}

  <div class="form-group row">
    {{-- 入力欄 --}}
    <input type="text" class="col-lg-8" placeholder="検索したいキーワードを入力してください" name="keyword_image_name">
    <button type="submit" class="btn btn-success col-lg-4">検索</button>
  </div>
</form>

@if(!empty($message))
  <div class="alert alert-primary" role="alert">{{ $message }}</div>
@endif


@if(isset($images))
  <div class="row mt_40 mb_120">

    @foreach($images as $image)
    <div class="col-lg-3 col-4 mb_40 sp_mb_20 text-center image_item">
      {{-- lightbox --}}
      <a href="{{ asset("storage/{$image->file_path}") }}" data-lightbox="fuga" data-title="{{ $image->image_name }}">
        <img class="lazy image" data-original="{{ asset("storage/{$image->file_path_th}") }}" alt="{{ $image->image_name }}">
      </a>
      
      <p class="mt_10 sp_mt_0">
        <a class="dounload_link" href="{{ asset("storage/{$image->file_path}") }}" download="{{ $image->file_name }}" type="button" onclick="return checkDounload()">ダウンロード</a>
      </p>
    </div>
    @endforeach

    {{-- ページネーションリンク --}}
    {{ $images->appends(request()->input())->links() }}

  </div>
@endif


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