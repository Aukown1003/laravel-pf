<h2 class="text-center">新規投稿</h2>
<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="form-group mb-3">
    <label for="title">タイトル</label>
    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
  </div>

  <div class="form-group mb-3">
    <label for="context" name="context">紹介文</label>
    <textarea class="form-control" name="content">{{ old('content') }}</textarea>
  </div>

  <div class="form-group mb-3">
    <label for="image" name="image">画像</label>
    <input type="file" class="form-control" name="image">
  </div>

  <div>
    <button type="submit" id="submit-button" class="btn btn-outline-primary w-100">投稿</button>
  </div>
</form>
