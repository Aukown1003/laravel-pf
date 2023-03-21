<h2 class="text-center">プロフィール</h2>
<table class="table mb-5">
  <div class="text-center mb-2">
    @if ($user->image)
      <img src="{{ $user->image }}" class="user_profile">
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