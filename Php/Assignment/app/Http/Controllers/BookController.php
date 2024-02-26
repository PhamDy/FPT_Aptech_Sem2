<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function showBooks()
    {
        $books = Books::all();

        return view('books', ['books' => $books]);
    }

    public function searchBook(Request $request)
    {
        if ($request->isMethod('post')) {
            $name = $request->input('search');
            $book = Books::where('title', 'like', "%$name%")->get();
            return view('showSearchBooks', ['book' => $book]);
        }

    }

//    public function showSearchBook()
//    {
//        return view('showSearchBooks');
//    }
}
