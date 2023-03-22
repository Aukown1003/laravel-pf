@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9 mx-auto">
      <div class="card">
        <div class="card-header text-center">
          <h2 class="mb-0">{{ __('投稿編集') }}</h2>
          {{-- <h2 class="mb-0">投稿編集</h2> --}}
        </div>
        <div class="card-body">
          <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="row mb-3">
              <h4>写真</h4>
              <div class="col-md-6">
                @if ($book->image)
                  <div class="mb-2">
                    <p class="mb-0">現在の写真 ※ファイルが未選択の場合、変更は行われません</p>
                    <img src="{{ $book->image }}" class="book_image_detail img-fluid">
                  </div>
                @endif
                <input type="file" class="form-control" name="image">
              </div>
            </div>

            <div class="row mb-3">
              <h4>タイトル</h4>
              <div class="col form-group">
                <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}">
              </div>
            </div>

            <div class="row mb-3">
              <h4>紹介文</h4>
              <div class="col form-group">
                <textarea name="content" class="form-control">{{ old('content', $book->content) }}</textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-outline-primary w-100">更新</button>
          </form>
        </div>
      </div>
      <div class="mt-3 px-3">
        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary w-100">一覧に戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection