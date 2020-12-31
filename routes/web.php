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

Route::get('/number', [\App\Http\Controllers\NumberController::class, 'number'])->name('number');
Auth::routes();


