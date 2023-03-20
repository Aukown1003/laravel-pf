@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      @include('users.user')
    </div>
    <div class="col-md-9">
      <h1>投稿一覧</h1>

      {{-- 検索フォーム --}}
      <form action="{{ route('books.index') }}" method="get">
        <div class="d-flex">
          <input type="search" placeholder="タイトルを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
          <button type="submit" class="btn btn-secondary">検索</button>
        </div>
      </form>

      <table class="table table-hover table-inverse">
        <thead>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Content</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($books as $book)
            <tr>
              {{-- <a href="{{ route('books.show', $book) }}"><h2>{{ $book->title }}</h2></a> --}}
              <td><img src="{{ $book->image }}" class="books_image"></td>
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
    </div>
  </div>
</div>
@endsection