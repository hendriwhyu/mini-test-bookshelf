<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' =>'required|string|max:255',
            'category_id' =>'required|exists:categories,id',
            'year' =>'required|numeric',
            'author' =>'required|string|max:255',
            'publisher' =>'required|string|max:255',
            'cover' =>'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        try {
            $file = $request->file('cover');
            $fileName = $file->hashName();
            Storage::disk('public')->putFileAs('covers_book', $file, $fileName);

            Book::create([
                'title' => $validate['title'],
                'category_id' => $validate['category_id'],
                'year' => $validate['year'],
                'cover' => $fileName,
                'author' => $validate['author'],
                'publisher' => $validate['publisher'],
                'description' => $request->description,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Book created successfully.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Book could not be created.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $book = Book::find($id);
            if ($book) {
                if($book->cover){
                    Storage::delete('cover_book/', $book->cover);
                }
                $book->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Book deleted successfully.',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
               'success' => false,
               'message' => 'Book could not be deleted.',
            ]);
        }

    }
}
