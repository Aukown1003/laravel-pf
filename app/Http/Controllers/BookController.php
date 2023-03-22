<?php

// 「このPostControllerクラスはApp\Http\Controllersフォルダの中にあることを明示
namespace App\Http\Controllers;
// このファイルではIlluminate\Httpフォルダの中にあるRequestクラスを使う、Requestクラスは、フォームから送信された内容などを取得
use Illuminate\Http\Request;
 // やりとりするモデルを宣言する
use App\Models\Book;
//画像等のストレージの宣言
use Illuminate\Support\Facades\Storage;
use Auth;

class BookController extends Controller
{
    //indexページの表示
    public function index(Request $request) {
        // @books = Book.all
        $books = Book::all();

        $search = $request->input('search');

        if ($search) {
            $books = Book::where('title', 'LIKE', '%'.$search.'%')->get();
        }
        // @user = current_user
        $user = Auth::user();

        return view('books.index')->with(['books' => $books,'search' => $search, 'user' => $user]);
    }

    public function show(Book $book) {
        $user = Auth::user();
        return view('books.show')->with(['book' => $book, 'user' => $user]);
    }

    //createページの表示
    public function create() {
        return view('books.create');
    }

    //保存
    public function store(Request $request) {
        //バリデーションの設定
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        // @book = Book.new
        $book = new Book();
        // @book.title = params[:book][:title]
        $book->title = $request->input('title');
        //@book.content = params[:book][:content]
        $book->content = $request->input('content');
        $book->user_id = Auth::id();

        // s3の設定
        $image = $request->file('image');
        if ($image) {
            $path = Storage::disk('s3')->putFile('image', $image, 'public');
            $book->image = Storage::disk('s3')->url($path);
        }

        //@book.save
        $book->save();

        //redirect_to books_path
        return redirect()->route('books.index')->with('flash_message', '投稿が完了しました');
    }

    //編集画面の表示
    public function edit(Book $book) {
        return view('books.edit', compact('book'));
    }

    //アップデート
    public function update(Request $request, Book $book) {

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $book->title = $request->input('title');
        $book->content = $request->input('content');

        $image = $request->file('image');
        if ($image) {
            $path = Storage::disk('s3')->putFile('image', $image, 'public');
            $book->image = Storage::disk('s3')->url($path);
        }

        $book->save();
        return redirect()->route('books.show', $book)->with('flash_message', '編集に成功しました');
    }

    //削除
    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('books.index')->with('flash_message', '本を削除しました');
    }

}
