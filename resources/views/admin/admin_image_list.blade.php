@extends('layouts.layout')
@section('title', '管理画面 画像一覧｜PhotoBon_92')

@push('css')
    <link href="{{ asset('css/admin_image_list.css') }}" rel="stylesheet">
@endpush

@section('content')

{{-- 画像一覧 --}}
<h2 class="mt_120">管理画面｜画像一覧</h2>

{{-- 更新時のflash --}}
@if (session('err_msg'))
<p class="text-danger">
  {{ session('err_msg') }}
</p>
@endif

{{-- 検索フォーム --}}
<form action="{{ route('getList_92')}}" method="post">
  {{ csrf_field()}}
  {{method_field('get')}}

  <div class="form-group row">
    <input type="text" class="col-lg-8" placeholder="検索したいキーワードを入力してください" name="keyword_image_name">
    <button type="submit" class="btn btn-success col-lg-4">検索</button>
  </div>
</form>


@if(!empty($message))
  <div class="alert alert-primary" role="alert">{{ $message }}</div>
@endif

@if(isset($images))
    <div class="mt_40 mb_120 card pt_20">
      <table class="table table-bordered row">
        <thead class="col-6">
          <tr class="row">
            <td class="col-2">画像NO.</td>
            <td class="col-3">画像イメージ</td>
            <td class="col-3">画像名</td>
            <td class="col-2">ファイル名</td>
            <td class="col-2"></td>
        <thead class="col-6">
          <tr class="row">
            <td class="col-2">画像NO.</td>
            <td class="col-3">画像イメージ</td>
            <td class="col-3">画像名</td>
            <td class="col-2">ファイル名</td>
            <td class="col-2"></td>
          </tr>
        </thead>

        @foreach($images as $image)
          {{-- テーブルの列クリックで編集ページ --}}
          <a href="/photobon92/public/details_92/{{ $image->id }}">
            <tbody class="col-6">
              
              <tr class="row">
                <td class="col-2">NO.{{ $image->id }}</td>
                <td class="col-3">
                  <img style="height: 100px; object-fit: cover;" class="lazy w-100" data-original="{{ asset("storage/{$image->file_path}") }}" alt="{{ $image->image_name }}">
                </td>
                <td class="col-3">{{ $image->image_name }}</td>
                <td class="col-2">{{ $image->file_name }}</td>
                <td class="col-2">
                  <a href="/photobon92/public/details_92/{{ $image->id }}" class="btn btn-primary">編集</a>
                </td>
              </tr>
            </tbody>
          </a>
        @endforeach
      </table>
        
    </div>

    {{-- ページネーションリンク --}}
    {{ $images->appends(request()->input())->links() }}

  </div>
@endif

@endsection