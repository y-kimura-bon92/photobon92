@extends('layouts.admin_layout')

@push('css')
    <link href="{{ asset('css/admin_detalis.css') }}" rel="stylesheet">
@endpush

@section('title', '管理画面 画像一覧｜PhotoBon_92')
@section('content')


{{-- 画像一覧 --}}
<h2 class="mt_120">管理画面｜画像編集</h2>

<form action="{{ route('postUpdate_92') }}" method="POST" enctype="multipart/form-data" onSubmit="return checkSubmit()" class="mt_40">
  @csrf

  <input type="hidden" name="image_id" value="{{ $image_id->id }}">
  <input type="hidden" name="file_name" value="{{ $image_id->file_name }}">

  <div class="card bg-light">
    <div class="card-body">
      <table class="table table-bordered bg-white">
        <tbody>
          <tr>
            <td rowspan="3" class="w-25"><img src="{{ url("https://kachibon.work/photobon92/public/storage/{$image_id->file_path}") }}" class="w-100"/></td>
            <td>画像NO.</td>
            <td>{{ $image_id->id }}</td>
          </tr>
          <tr>
            <td>ファイル名</td>
            <td>{{ $image_id->file_name }}</td>
          </tr>
          <tr>
            <td>画像名</td>
            <td><input type="text" name="image_name" value="{{ $image_id->image_name }}"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row mt_40 mb_120">
    <input type="submit" value="更新する" class="btn btn-success">
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