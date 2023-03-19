@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      @if (session('flash_message'))
        <p>{{ session('flash_message') }}</p>
      @endif
      <div>
        <a href="{{ route('books.index') }}">戻る</a>
      </div>
      <div>
        <h2>{{ $book->title }}</h2>
        <p>{{ $book->content }}</p>
        <a href="{{ route('books.edit', $book) }}">編集</a>
      </div>
    </div>
  </div>
</div>
@endsection