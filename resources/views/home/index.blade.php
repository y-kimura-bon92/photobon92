@extends('layouts.layout')
@section('content')

<div class="card mt-5">
  <div class="card-body">
    <p><a href="{{ route('getList') }}" class="btn btn-primary">画像一覧</a></p>
  </div>
</div>

@endsection