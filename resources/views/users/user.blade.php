<h2 class="text-center">プロフィール</h2>
<table class="table">

  <div class="text-center mb-2">
    @if ($user->profile_image)
      <img src="{{ $user->profile_image }}" class="user_profile">
    @else
      <img src="{{ asset('img/no_image_user.png') }}" class="user_profile">
    @endif
  </div>

  <tr>
    <th>name:</th>
    <th>{{ $user->name }}</th>
  </tr>

  <tr>
    <th>email:</th>
    <th>{{ $user->email }}</th>
  </tr>

</table>

<div class=" mb-4 text-center">
  <a href="{{ route('users.edit', $user) }}" class="btn btn-success">プロフィール編集</a>
</div>