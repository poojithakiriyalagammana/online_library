<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register',[RegisterController::class,'store']);
// Route::post('/login',[LoginController::class,'check']);
Route::get('/books',[BookController::class,'index'])->name('books.index'); 