<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $countBooks = Book::count();
        $countCategories = Category::count();

        $books = Book::latest('created_at')->take(3)->get();

        return view('admin.index', compact('books', 'countBooks', 'countCategories'));
    }
}
