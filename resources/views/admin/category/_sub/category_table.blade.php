<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>カテゴリー名</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($categoryList as $category)
      <tr>
        <td>{{ $category['id'] }}</td>
        <td>{{ $category['name'] }}</td>
        <td>
          <a href="{{ url('admin_category_delete_confirm').'/'.$category['id'] }}">削除</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
