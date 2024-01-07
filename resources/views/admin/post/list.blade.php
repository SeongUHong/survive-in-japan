@extends('admin/layout')
@section('content')
記事一覧<br>
<div style="padding:1rem">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>カテゴリー</th>
        <th>タイトル</th>
        <th>ステータス</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($postList as $post)
        <tr>
          <td>{{ $post['id'] }}</td>
          <td>{{ $categoryNameById[$post['category_id']] }}</td>
          <td>{{ $post['title'] }}</td>
          <td>{{ $statusNameById[$post['status']] }}</td>
          <td><a href="{{ url('admin_post_edit').'/'.$post['id'] }}" class="btn btn-primary btn-sm">編集</a></td>
          <td><a href="{{ url('').'/'.$post['id'] }}" class="btn btn-danger btn-sm">削除</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection