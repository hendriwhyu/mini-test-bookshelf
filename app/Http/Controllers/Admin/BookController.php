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
            'release_date' => 'required|date',
            'isbn' => 'string|max:255',
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
                'isbn' => $validate['isbn'],
                'release_date' => $validate['release_date'],
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
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.detail', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' =>'required|string|max:255',
            'category_id' =>'exists:categories,id',
            'release_date' => 'required|date',
            'isbn' => 'string|max:255',
            'author' =>'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'cover' =>'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        try {
            $book = Book::find($id);
            if ($book) {
                $file = $request->file('cover');
                if ($file) {
                    Storage::disk('public')->delete('covers_book/'. $book->cover);

                    $fileName = $file->hashName();
                    Storage::disk('public')->putFileAs('covers_book', $file, $fileName);
                    $book->cover = $fileName;
                }
                $book->update([
                    'title' => $validate['title'],
                    'category_id' => $validate['category_id'],
                    'isbn' => $validate['isbn'],
                    'release_date' => $validate['release_date'],
                    'author' => $validate['author'],
                    'publisher' => $validate['publisher'],
                    'description' => $request->description,
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Book updated successfully.',
                    'book' => $book,
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Book could not be updated.',
            ], 500);
        }
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
                    Storage::disk('public')->delete('covers_book/'. $book->cover);
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
