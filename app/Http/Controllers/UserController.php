<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $image = $request->file('profile_image');
        if ($image) {
            $path = Storage::disk('s3')->putFile('user_image', $image, 'public');
            $user->profile_image = Storage::disk('s3')->url($path);
        }

        $user->save();
        return redirect()->route('books.index')->with('flash_message', 'ユーザー情報の編集に成功しました');
    }
}
