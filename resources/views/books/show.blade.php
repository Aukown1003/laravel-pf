@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-3 mb-4 mb-md-0">
      @include('users.user', ['user' => Auth::user()])
      @include('books.create')
    </div>

    <div class="col-md-9">
      <div class="card">
        <div class="card-header text-center">
          <h2 class="mb-0">{{ __('投稿詳細') }}</h2>
        </div>
        <div class="card-body">

          <div class="row mb-3">
            <h4>写真</h4>
            <div class="col text-center">
              @if ($book->image)
                <img src="{{ $book->image }}" class="book_image_detail img-fluid">
              @else
                <img src="{{ asset('img/no_image.png') }}" class="book_image_detail img-fluid">
              @endif
            </div>
          </div>

          <div class="row mb-3">
            <h4>タイトル</h4>
            <div class="col">
              <h5>{{ $book->title }}</h5>
            </div>
          </div>

          <div class="row mb-3">
            <h4>紹介文</h4>
            <div class="col">
              <p>{{ $book->content }}</p>
            </div>
          </div>

          @if (Auth::id() == $book->user->id)
            <div class="d-flex">
              <div class="me-1">
                <a href="{{ route('books.edit', $book) }}" class="btn btn-success">編集</a>
              </div>

              <div class="ms-1">
                <form action="{{ route('books.destroy', $book) }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger" onclick="delete_alert(event);return false;">削除</button>
                </form>
              </div>
            </div>

        </div>
      </div>

      <div class="mt-3">
        <a href="{{ route('books.index') }}" class="btn btn-primary w-100">一覧に戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  function delete_alert(e) {
    if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました');
      return false;
    }
    document.deleteform.submit();
}
</script>
@endsection