@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-3">
      @include('users.user')
      @include('books.create')
    </div>

    <div class="col-md-9 text-center">
      <h2>投稿一覧</h2>

      {{-- 検索フォーム --}}
      <form action="{{ route('books.index') }}" method="get">
        <div class="d-flex justify-content-center mb-3">
          <input type="search" placeholder="タイトルを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
          <button type="submit" class="btn btn-secondary">検索</button>
        </div>
      </form>

      <table class="table table-hover table-inverse">
        <thead>
          <tr>
            <th class="book-image-width"></th>
            <th>Title</th>
            <th>User_name</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          @foreach($books as $book)
            <tr>
              <td class="text-center">
                @if ($book->image)
                  <img src="{{ $book->image }}" class="books_image">
                @else
                  <img src="{{ asset('img/no_image.png') }}" class="books_image">
                @endif
              </td>

              <td class="align-middle">{{ $book->title }}</td>

              <td class="align-middle">{{ $book->user->name }}</td>

              <td class="align-middle"><a href="{{ route('books.show', $book) }}" class="btn btn-primary">詳細</a></td>

              @if (Auth::id() == $book->user->id)
                <td class="align-middle"><a href="{{ route('books.edit', $book) }}" class="btn btn-success">編集</a></td>
                <form action="{{ route('books.destroy', $book) }}" method="post">
                  @csrf
                  @method('delete')
                  <td class="align-middle"><button type="submit" class="btn btn-danger" onclick="delete_alert(event);return false;">削除</button></td>
                </form>
              @endif

            </tr>
          @endforeach
        </tbody>

      </table>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  function delete_alert(e) {
    if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました');
      return false;
    }
    document.deleteform.submit();
}
</script>
@endsection