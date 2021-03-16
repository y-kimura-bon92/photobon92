@extends('layouts.admin_layout')
@section('title', 'SE画像投稿｜PhotoBon_92')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/seCommon.css') }}">
@endpush

@section('content')



{{-- 画像一覧 --}}
<h2 class="mt_120">管理画面｜画像アップロード</h2>

@if (session('err_msg'))
  <p class="text-danger">
    {{ session('err_msg') }}
  </p>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger mt_80">
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<form method="post" action="{{ route('SePostUpload_92') }}" enctype="multipart/form-data" class="mt_40">
	@csrf

	<div class="card bg-light">
    <div class="card-body">
      <table class="table table-bordered bg-white">
        <tbody>
          <tr>
						<td class="text-center" style="vertical-align: middle">画像</td>
            <td>
              <input type="file" name="image" accept="image/png, image/jpeg ,image/jpg" class="form-control">
            </td>
          </tr>
          <tr>
						<td class="text-center" style="vertical-align: middle">画像（サムネイル）</td>
            <td>
              <input type="file" name="image_th" accept="image/png, image/jpeg ,image/jpg" class="form-control">
            </td>
          </tr>
          <tr>
						<td class="text-center" style="vertical-align: middle">画像名</td>
            <td><input type="text" name="image_name" class="form-control"></td>
          </tr>
          <tr>
            <td class="text-center" style="vertical-align: middle">カテゴリー</td>
            <td><textarea name="image_category" id="" cols="30" rows="10" class="form-control"></textarea>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

	<div class="row mt_40 mb_120">
    <input type="submit" value="登録する" class="btn btn-success">
  </div>

</form>


<script>
  function checkSubmit(){
  if(window.confirm('保存してよろしいですか？')){
      return true;
  } else {
      return false;
  }
  }
</script>

@endsection