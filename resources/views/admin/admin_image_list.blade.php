@extends('layouts.admin_layout')
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
            <th>カテゴリ</th>
            <td>
              <div class="grad-wrap">
                <input id="trigger{{$image->id}}" class="grad-trigger" type="checkbox">
                <label class="grad-btn" for="trigger{{$image->id}}"></label>
                <div class="grad-item">{{ $image->image_category }}</div>
              </div>
            </td>
          </tr>
          <tr>
            <th>ファイル名</th>
            <td>{{ $image->file_name }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    @endforeach

    {{-- ページネーションリンク --}}
    {{ $images->appends(request()->input())->links() }}

  </div>
@endif

@endsection