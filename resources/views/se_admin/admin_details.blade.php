@extends('layouts.admin_layout')

@push('css')
    <link href="{{ asset('css/admin_detalis.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/seCommon.css') }}">
@endpush

@section('title', '管理画面 画像一覧｜PhotoBon_92')
@section('content')


{{-- 画像一覧 --}}
<h2 class="mt_120">管理画面｜画像編集</h2>

<form action="{{ route('SePostUpdate_92') }}" method="POST" enctype="multipart/form-data" onSubmit="return checkSubmit()" class="mt_40">
  @csrf

  <input type="hidden" name="image_id" value="{{ $image_id->id }}">
  {{-- <input type="hidden" name="file_name" value="{{ $image_id->file_name }}"> --}}

  <div class="card bg-light">
    <div class="card-body">
      <table class="table table-bordered bg-white">
        <tbody>
          <tr>
            <td rowspan="3" class="w-25">
              <p>ダウンロード画像</p>
              <img src="{{ asset("storage/{$image_id->file_path}") }}" class="w-100 mt_20"/>
              <input type="file" name="image" accept="image/png, image/jpeg ,image/jpg" class="form-control mt_20" value="{{ $image_id->file_name }}">
            </td>
            <td>画像NO.</td>
            <td>No. {{ $image_id->id }}</td>
          </tr>
          <tr>
            <td>ファイル名</td>
            <td>{{ $image_id->file_name }}</td>
          </tr>
          <tr>
            <td>画像名</td>
            <td><input type="text" name="image_name" value="{{ $image_id->image_name }}" class="form-control"></td>
          </tr>
          <tr>
            <td class="w-25 bg-light">
              <p>サムネイル画像</p>
              <img src="{{ asset("storage/{$image_id->file_path_th}") }}" class="w-50 mt_20"/>
              <input type="file" name="image_th" accept="image/png, image/jpeg ,image/jpg" class="form-control mt_20" value="{{ $image_id->file_name_th }}">
            </td>
            <td>カテゴリー</td>
            <td><textarea name="image_category" id="" cols="30" rows="10" class="form-control">{{ $image_id->image_category }}</textarea>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row mt_20">
    <input type="submit" value="更新する" class="btn btn-success">
  </div>
</form>

<div class="row mt_10">
  <p class="col-lg-2 pl_0">
    <a href="#" onClick="history.back(); return false;" class="btn btn-primary">前のページにもどる</a>
  </p>
  
  {{-- 削除フォーム --}}
  <form action="{{ route('SePostDelete_92', $image_id->id) }}" method="POST" onclick="return checkDelete()" class="mb_120 col-lg-2">
      @csrf

      <button type="submit" class="btn btn-danger w-100" onclick=>削除</button>
  </form>
</div>



<script>
  // 更新のウィンドウダイアログ
  function checkSubmit(){
  if(window.confirm('更新してよろしいですか？')){
      return true;
  } else {
      return false;
  }
  }

  // 削除のウィンドウダイアログ
  function checkDelete(){
  if(window.confirm('削除してよろしいですか？')){
      return true;
  } else {
      return false;
  }
  }
</script>



@endsection