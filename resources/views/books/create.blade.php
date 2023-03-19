@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h1>新規投稿</h1>
      <form action="{{ route('books.store') }}" method="POST">
        {{-- @csrf = サイバー攻撃からアプリを保護するためのコード、必ず記述 --}}
        @csrf
        <div class="form-group mb-3">
          <label for="title">タイトル</label>
          <input type="text" class="form-control" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group mb-3">
          <label for="context" name="context">紹介文</label>
          <textarea class="form-control" name="content">{{ old('content') }}</textarea>
        </div>
        <div>
          <button type="submit" class="btn btn-outline-primary">投稿</button>
          <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">戻る</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection