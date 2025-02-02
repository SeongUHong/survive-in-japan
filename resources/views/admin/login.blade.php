@extends('admin/layout')
@section('content')
  <p></p>
  <h1>管理者ログイン</h1>
  <p></p>
  
  {{-- 에러메세지 --}}
  @if (isset($login_error))
  <p>ログインできませんでした。</p>
  @endif
  <br>
  {{-- 폼 --}}
  <form action="{{ url('admin_login_exec') }}" method="post">
    @csrf  
    <input type="text" name="login_id">
    <input type="password" name="password">
    <input type="submit" value="ログインする" class="btn btn-primary">  
  </form>  
  <p><br></p>
@endsection