@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h1>投稿一覧</h1>
      @if (session('flash_message'))
        <p>{{ session('flash_message') }}</p>
      @endif
      <div>
        <a href="{{ route('books.create') }}">新規投稿</a>
      </div>
      <div>
        @foreach($books as $book)
          <div>
              {{-- <a href="{{ route('books.show', $book) }}"><h2>{{ $book->title }}</h2></a> --}}
              <h2>{{ $book->title }}</h2>
              <p>{{ $book->content }}</p>
              <a href="{{ route('books.show', $book) }}">詳細</a>
              <a href="{{ route('books.edit', $book) }}">編集</a>
              <form action="{{ route('books.destroy', $book) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit">削除</button>
              </form>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection