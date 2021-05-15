<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = request()->validate([
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