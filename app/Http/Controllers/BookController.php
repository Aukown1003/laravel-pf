<?php

// 「このPostControllerクラスはApp\Http\Controllersフォルダの中にあることを明示
namespace App\Http\Controllers;
// このファイルではIlluminate\Httpフォルダの中にあるRequestクラスを使う、Requestクラスは、フォームから送信された内容などを取得
use Illuminate\Http\Request;
 // やりとりするモデルを宣言する
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Auth;

class BookController extends Controller
{
    //indexページの表示
    public function index(Request $request) {
        // @books = Book.all
        $books = Book::all();
        // $books = Book::with('user')->get();
        $search = $request->input('search');

        if ($search) {
            $books = Book::where('title', 'LIKE', '%'.$search.'%')->get();
        }
        $user = Auth::user();
        //@books = Book.order(created_at ASC)
        // $books = Book::latest()->get();
        // compact()関数＝引数に渡された変数とその値から配列を作成し、戻り値として返す関数
        // return view('books.index', compact('books'));
        return view('books.index')->with(['books' => $books,'search' => $search, 'user' => $user]);
    }

    public function show(Book $book) {
        return view('books.show', compact('book'));
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
        // with()メソッドは以下のように第1引数にキー、第2引数に値を指定することで、セッションにそのデータを保存、ビューで使用
        return redirect()->route('books.index')->with('flash_message', '投稿が完了しました');
    }

    public function edit(Book $book) {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $book->title = $request->input('title');
        $book->content = $request->input('content');
        $book->save();
        return redirect()->route('books.show', $book)->with('flash_message', '編集に成功しました');
    }

    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('books.index')->with('flash_message', '本を削除しました');
    }

}
