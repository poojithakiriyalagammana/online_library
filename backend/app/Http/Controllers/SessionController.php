<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function getCartBooks()
    {
        $user = Auth::user();
        $borrowedBooks = Book::where('is_borrowed', true)
                              ->where('borrowed_by', $user->id)
                              ->get();

        return response()->json($borrowedBooks);
    }
}
