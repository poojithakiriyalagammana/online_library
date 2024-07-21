<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SessionController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'check']);
Route::post('/register', [RegisterController::class, 'store']);

// Get all books
Route::get('/books', [BookController::class, 'index']);
// Create a new book
Route::post('/books', [BookController::class, 'store']);
// Get a single book by ID
Route::get('/books/{id}', [BookController::class, 'show']);
// Update a book by ID
Route::put('/books/{id}', [BookController::class, 'update']);
// Delete a book by ID
Route::delete('/books/{id}', [BookController::class, 'destroy']);

// Route::get('/cart', [SessionController::class, 'getCartBooks']);
Route::get('/books/search', [BookController::class, 'search']);
