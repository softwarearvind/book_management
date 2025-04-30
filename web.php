<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login.user',[LoginController::class, 'login'])->name('login.user');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('user.profile/{id}', [AdminController::class, 'userProfile'])->name('user.profile');
    Route::get('view/user',[UserController::class, 'viewUser'])->name('view.user');
    Route::get('add/user',[UserController::class, 'addUser'])->name('add.user');
    Route::post('user/store',[UserController::class, 'store'])->name('user.store');
});

Route::middleware(['auth', 'role:Librarian'])->prefix('librarian')->group(function () {
    Route::get('/dashboard', [LibrarianController::class, 'index'])->name('librarian.dashboard');
   
});

Route::middleware(['auth', 'role:Visitor'])->prefix('visitor')->group(function () {
    Route::get('/dashboard', [VisitorController::class, 'index'])->name('visitor.dashboard');
    Route::get('/books', [BookController::class, 'index'])->name('visitor.books');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('read.user');
    Route::post('visitor/books/store',[BookController::class, 'store'])->name('visitor.books.store');
    Route::get('visitor/books/issued',[BookController::class, 'issuedBooks'])->name('visitor.books.issued');
    Route::post('/book/return/{book}', [BookController::class, 'returnBook'])->name('book.return');
    Route::get('/books/delete/{id}', [BookController::class, 'softDelete'])->name('books.softdelete');
    Route::get('/books/restore/{id}', [BookController::class, 'restore'])->name('books.restore');
    Route::get('/books/trashed', [BookController::class, 'trashedBooks'])->name('books.trashed');
    




   
});

