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
    </div>
  </div>
</div>
@endsection