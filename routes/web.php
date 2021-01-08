<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return view('welcome');
});
Route::get('/aboutus', function() {
    return view('aboutus');
});
Route::get('/contact', function() {
    return view('contact');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/bookbase', [\App\Http\Controllers\BooksController::class, 'index'])->name('bookbase');
Route::get('/add-book-to-base', [\App\Http\Controllers\BooksController::class, 'create'])->name('addBookToBase');
Route::post('/add-book-to-base', [\App\Http\Controllers\BooksController::class, 'store'])->name('storeBookInBase');
Route::get('/delete-book-from-base/{id}', [\App\Http\Controllers\BooksController::class, 'destroy'])->name('deleteBookFromBase');
Route::get('/edit-book/{id}', [\App\Http\Controllers\BooksController::class, 'edit'])->name('editBook');
Route::put('{id}', [\App\Http\Controllers\BooksController::class, 'update'])->name('updateBook');
Route::get('/books-added-by-user', [\App\Http\Controllers\BooksController::class, 'showUserBooks'])->name('booksAddedByUser');

Route::get('/add-to-read/{id}', [\App\Http\Controllers\ToReadBookController::class, 'store'])->name('addToRead');
Route::get('/add-as-read/{id}', [App\Http\Controllers\ReadBookController::class, 'store'])->name('addAsRead');

Route::get('/user-to-read', [App\Http\Controllers\ToReadBookController::class, 'index'])->name('userToReadBooks');

Route::get('/number', [\App\Http\Controllers\NumberController::class, 'number'])->name('number');
Auth::routes();
