@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      @include('users.user')
    </div>
    <div class="col-md-9">
      <h1>投稿一覧</h1>
      <div>
        <a href="{{ route('books.index') }}">戻る</a>
      </div>
      <div>
        <h2>{{ $book->title }}</h2>
        <p>{{ $book->content }}</p>
        <a href="{{ route('books.edit', $book) }}">編集</a>
        <form action="{{ route('books.destroy', $book) }}" method="post">
          @csrf
          @method('delete')
          <button type="submit">削除</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection