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
//カスタムバリデーションの使用宣言
use App\Http\Requests\StoreBookRequest;
use App\Jobs\BookStore;

class BookController extends Controller
{
    //indexページの表示
    public function index(Request $request) {
        // @books = Book.all
        $books = Book::all();

        $search = $request->input('search');

        if ($search) {
            // $books = Book::where('title', 'LIKE', '%'.$search.'%')->get();
            $books = Book::where('title', 'LIKE', "%{$search}%")
            ->orWhereHas('user', function ($query) use ($search) {$query->where('name', 'LIKE', "%{$search}%");})
            ->get();
        }

        return view('books.index', compact('books','search'));
    }

    public function show(Book $book) {
        return view('books.show', compact('book'));
    }

    //createページの表示
    public function create() {
        return view('books.create');
    }

    // booksをjsonで取得
    public function getData() {
        $books = Book::orderBy('created_at', 'DESC')->get();
        $json = ["books" => $books];
        return response()->json($json);
    }
    // public function store(StoreBookRequest $request) {
    //     $validated = $request->validated();
    //     $title = $request->input('title');
    //     $content = $request->input('content');
    //     $user_id = Auth::id();
    //     $image_file = $request->file('image');
    //     if ($image_file) {
    //         $path = Storage::disk('s3')->putFile('image', $image, 'public');
    //         $image = Storage::disk('s3')->url($path);
    //     } else {
    //         $image = null;
    //     }
    //     dispatch(new BookStore($title, $content, $user_id, $image));
    //     return response()->json(['message' => '保存しました']);
    // }

    //保存
    public function store(StoreBookRequest $request) {
        //バリデーションの設定
        $validated = $request->validated();

        //基本のバリデーション
        // $request->validate([
            // 'title' => 'required',
            // 'content' => 'required',
        // ]);

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
