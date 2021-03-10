@extends('layouts.layout')
@section('content')

<form action="{{ route('exeComplete') }}" method="POST">
  @csrf
  <table>
    <tr>
      <td></td>
      {{-- <td><img src="{{ $data['read_temp_path'] }}" alt="" class="w-100"></td> --}}
      aiueo
    </tr>
  </table>
  
</form>

@endsection