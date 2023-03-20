@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h1>プロフィールその他を入れる</h1>
    </div>
    <div class="col-md-6">
      <h1>投稿一覧</h1>
      <table class="table table-hover table-inverse">
        <thead>
          <tr>
            <th>Title</th>
            <th>Content</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($books as $book)
            <tr>
              {{-- <a href="{{ route('books.show', $book) }}"><h2>{{ $book->title }}</h2></a> --}}
              <td><img src="{{ $book->image }}"></td>
              <td>{{ $book->title }}</td>
              <td>{{ $book->content }}</td>
              <td ><a href="{{ route('books.show', $book) }}" class="btn btn-primary">詳細</a></td>
              <td><a href="{{ route('books.edit', $book) }}" class="btn btn-success">編集</a></td>
              <form action="{{ route('books.destroy', $book) }}" method="post">
                @csrf
                @method('delete')
                <td><button type="submit" class="btn btn-danger">削除</button></td>
              </form>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div>
        <a href="{{ route('books.create') }}">新規投稿</a>
      </div>
    </div>
  </div>
</div>
@endsection