<?php

use Illuminate\Support\Facades\Route;
// ルーティングを設定するコントローラを宣言する
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    // ここにログインが必要なルートを定義
    Route::resource('books', BookController::class);
    // Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::resource('users', UserController::class)->only([
        'edit', 'update'
    ]);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/books', [BookController::class, 'index'])->name('books.index');
// Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
// Route::post('/books', [BookController::class, 'store'])->name('books.store');
// Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
// Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
// Route::patch('books/{book}', [BookController::class, 'update'])->name('books.update');
// Route::delete('books/{book}', [BookController::class, 'delete'])->name('books.destroy');