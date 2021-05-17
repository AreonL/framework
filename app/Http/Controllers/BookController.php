<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('book', [
            'books' => $books ?? null,
            'header' => 'Booooks'
        ]);
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'ISBN' => 'required',
            'author' => 'required',
            'picture' => 'required',
        ]);

        $book = new Book();
        $book->title = request('title');
        $book->ISBN = request('ISBN');
        $book->author = request('author');
        $book->url = request('picture');
        $book->save();

        return back();
    }
}
