@extends('admin/layout')
@section('content')
韓国語記事<br>
<a href="{{ url('admin_index') }}">管理者TOP</a><br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>カテゴリー</th>
      <th>タイトル</th>
      <th>ステータス</th>
    </tr>
  </thead>
  <tbody>
    @foreach($postList as $post)
      <tr>
        <td>{{ $post['id'] }}</td>
        <td>{{ $categoryNameById[$post['category_id']] }}</td>
        <td><a href="{{ url('admin_post_edit').'/'.$post['id'] }}">{{ $post['title'] }}</a></td>
        <td>{{ $statusNameById[$post['status']] }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection