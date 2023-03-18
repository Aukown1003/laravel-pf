<?php

// 「このPostControllerクラスはApp\Http\Controllersフォルダの中にあることを明示
namespace App\Http\Controllers;
// このファイルではIlluminate\Httpフォルダの中にあるRequestクラスを使う、Requestクラスは、フォームから送信された内容などを取得
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function index() {
        return view('books.index');
    }
}
