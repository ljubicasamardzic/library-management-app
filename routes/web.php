<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCopyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::resource('authors', AuthorController::class);
Route::resource('publishers', PublisherController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('genres', GenreController::class);
Route::resource('users', UserController::class);
Route::resource('books', BookController::class);
Route::resource('book-copies', BookCopyController::class);
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
