<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
            'price' => 'required|numeric',
            // 'is_borrowed' is not required for creation
        ]);

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'genre' => $request->genre,
            'price' => $request->price,
            // 'is_borrowed' will be defaulted to false if not provided
        ]);

        return response()->json($book, 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }


    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'genre' => 'string|max:255',
            'price' => 'numeric',
            'is_borrowed' => 'boolean',
        ]);
    
        $book = Book::findOrFail($id);
        $book->update($request->all());
    
        return response()->json($book);
    }

      // Remove the specified resource from storage.
   public function destroy($id)
   {
       $book = Book::findOrFail($id);
       $book->delete();
       return response()->json(null, 204);
   }
   
    // Search for books based on title, description, or genre.
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        if (empty($search)) {
            return response()->json(['message' => 'Search query cannot be empty'], 400);
        }

        $query = Book::query();

        // Apply search filters
        $query->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('genre', 'like', "%{$search}%");

        $books = $query->paginate(10); // Adjust pagination as needed

        // Log the SQL query and bindings for debugging
        Log::info('Search Query: ' . $query->toSql());
        Log::info('Bindings: ' . json_encode($query->getBindings()));

        return response()->json($books);
    }
}
