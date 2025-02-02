@extends('admin/layout')
@section('content')
디버그용<br>
<h2>@if(isset($msg)) {{ $msg }} @endif</h2>
@if(isset($msg))
  <img src="{{ asset($msg) }}">
@endif
<form action="{{ url('admin_post_image_upload') }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="input-group">
    <input type="file" class="form-control" name="image">
    <input type="submit" class="btn btn-outline-secondary" value="追加">
  </div>
</form>
@endsection