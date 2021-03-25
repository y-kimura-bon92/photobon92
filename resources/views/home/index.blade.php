@extends('layouts.layout')
@section('content')

<div class="mt_120 mb_120 container">
  <div class="row">
    <div class="col-7 mt_80 sp_mt_0">
      <h2 class="display-5" style="font-weight: 500;">Photobon_92で
        <br>家族の成長を家族で共有しよう！</h2>
      <p class="size_18">毎日いろいろなことを見て経験する子どもたち。
        <br>久しぶりに会ったおじいちゃん、おばあちゃん、親戚の人たちが子どもの成長にびっくりさせられます。
        <br>Photobon_92は見逃したくない子どもの成長を見逃さずしっかり記録し共有できます。
      </p>
      <div class="mt_80">
        <p class="text-center"><a href="{{ route('getList') }}" class="btn btn-primary w-50" style="padding: 17px;">画像一覧</a></p>
      </div>
    </div>
    <div class="col-5">
      <p><img data-original="{{ asset('images/IMG_3135.png') }}" alt="" class="w-100 home_column_image lazy"></p>
    </div>
  </div>

  <div class="mt_120">
    <h4 class="text-center display-6">ワンクリックでかんたんに画像をダウンロード出来ます。</h4>
    <p class="text-center size_18">まずは、Photobon_92で好きな画像をダウンロードしてみましょう。<br>ご自身の画像を共有したくなったら次は画像をアップロードしてみましょう。<br>家族みんなで一生の思い出を共有していこう！</p>
    <p class="mt_80"><img data-original="{{ asset('images/photobon_92_image.png') }}" alt="" class="w-100 home_column_image lazy"></p>
  </div>
</div>

@endsection