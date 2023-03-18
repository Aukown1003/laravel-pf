@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h1>投稿一覧</h1>
      <div>
        <a href="{{ route('books.index') }}">投稿アプリ</a>
      </div>
    </div>
  </div>
</div>
@endsection