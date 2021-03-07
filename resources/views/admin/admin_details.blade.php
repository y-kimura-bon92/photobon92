@extends('layouts.layout')
@section('title', '管理画面 画像一覧｜PhotoBon_92')
@section('content')


{{-- 画像一覧 --}}
<h2 class="mt_40">管理画面｜画像編集</h2>

<form action="{{ route('postUpdate_92') }}" method="POST" enctype="multipart/form-data" onSubmit="return checkSubmit()">
  @csrf

  <input type="hidden" name="image_id" value="{{ $image_id->id }}">
  <input type="hidden" name="file_name" value="{{ $image_id->file_name }}">
  <div class="row mt_40 mb_120">
  
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
      <img src="{{ url("https://kachibon.work/photobon92/public/storage/{$image_id->file_path}") }}" class="w-100"/>
      <p>{{ $image_id->file_name }}</p>
  
      <label for="">画像名</label>
      <input type="text" name="image_name" value="{{ old('image_name') }}">

      <input type="submit" value="更新する">
    </div>
  
  </div>
</form>

<script>
  function checkSubmit(){
  if(window.confirm('更新してよろしいですか？')){
      return true;
  } else {
      return false;
  }
  }
  </script>

@endsection