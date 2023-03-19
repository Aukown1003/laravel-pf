@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h1>新規投稿</h1>
      <div>
        <a href="{{ route('books.index') }}">戻る</a>
      </div>
      <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('patch')
        <div>
          <label for="title">タイトル</label>
          <input type="text" name="title" value="{{ $book->title }}">
        </div>
        <div>
          <label for="context" name="context">紹介文</label>
          <textarea name="content">{{ $book->content }}</textarea>
        </div>
        <button type="submit">更新</button>
      </form>
    </div>
  </div>
</div>
@endsection