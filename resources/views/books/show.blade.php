@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div>
        <a href="{{ route('books.index') }}">戻る</a>
      </div>
      <div>
        <h2>{{ $book->title }}</h2>
        <p>{{ $book->content }}</p>
      </div>
    </div>
  </div>
</div>
@endsection