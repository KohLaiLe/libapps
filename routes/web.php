<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\HistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WebController::class, 'index'])->name('index');

// search
Route::get('/search', [BookController::class, 'search'])->name('book.search');

// login
Route::get('/auth/login', [UserController::class, 'login_index'])->name('login_index');
Route::post('/auth/login', [UserController::class, 'login'])->name('login');
Route::post('/auth/logout', [UserController::class, 'logout'])->name('logout');

// register
Route::get('/auth/register', [UserController::class, 'register_index'])->name('register_index');
Route::post('auth/register', [UserController::class, 'register'])->name('register');

// borrow
Route::get('/borrow/{id_book}', [BorrowController::class, 'borrow_index'])->name('borrow_index');
Route::post('borrow/{id_book}', [BorrowController::class, 'borrow'])->name('borrow');

// history
Route::get('/history', [HistoryController::class, 'history_index'])->name('history_index');
Route::put('/history/return/{id_borrow_book}', [HistoryController::class, 'book_return'])->name('book_return');
Route::put('/history/lost/{id_borrow_book}', [HistoryController::class, 'book_lost'])->name('book_lost');

// book
Route::get('/book', [BookController::class, 'book_manage'])->name('book_manage');
Route::get('/book/edit/{id_book}', [BookController::class, 'book_edit'])->name('book_edit');
Route::put('book/edit/{id_book}', [BookController::class, 'book_edit_execute'])->name('book_edit_execute');
Route::delete('/book/delete/{id_book}', [BookController::class, 'book_delete'])->name('book_delete');
Route::get('/book/create', [BookController::class, 'book_create'])->name('book_create');
Route::post('/book/create', [BookController::class, 'book_create_execute'])->name('book_create_execute');
Route::get('/book/detail/{id_book}', [BookController::class, 'book_detail'])->name('book_detail');
