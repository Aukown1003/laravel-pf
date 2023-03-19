@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h1>新規投稿</h1>
      <div>
        <a href="{{ route('books.index') }}">戻る</a>
      </div>
      <form action="{{ route('books.store') }}" method="POST">
        {{-- @csrf = サイバー攻撃からアプリを保護するためのコード、必ず記述 --}}
        @csrf
        <div>
          <label for="title">タイトル</label>
          <input type="text" name="title">
        </div>
        <div>
          <label for="context" name="context">紹介文</label>
          <textarea name="content"></textarea>
        </div>
        <button type="submit">投稿</button>
      </form>
    </div>
  </div>
</div>
@endsection