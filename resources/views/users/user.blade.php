<h1>プロフィール</h1>
<div>{{ $user->name }}</div>
<div>{{ $user->email }}</div>
<div>
  <a href="{{ route('books.create') }}">新規投稿</a>
</div>