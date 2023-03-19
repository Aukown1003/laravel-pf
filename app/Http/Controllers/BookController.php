<?php

// 「このPostControllerクラスはApp\Http\Controllersフォルダの中にあることを明示
namespace App\Http\Controllers;
// このファイルではIlluminate\Httpフォルダの中にあるRequestクラスを使う、Requestクラスは、フォームから送信された内容などを取得
use Illuminate\Http\Request;
 // やりとりするモデルを宣言する
use App\Models\Book;

class BookController extends Controller
{
    //indexページの表示
    public function index() {
        return view('books.index');
    }

    //createページの表示
    public function create() {
        return view('books.create');
    }

    //保存
    public function store(Request $request) {
        // @book = Book.new
        $book = new Book();
        // @book.title = params[:book][:title]
        $book->title = $request->input('title');
        //@book.content = params[:book][:content]
        $book->content = $request->input('content');
        //@book.save
        $book->save();
        //redirect_to books_path
        // with()メソッドは以下のように第1引数にキー、第2引数に値を指定することで、セッションにそのデータを保存、ビューで使用
        return redirect()->route('books.index')->with('flash_message', '投稿が完了しました');
    }
}
