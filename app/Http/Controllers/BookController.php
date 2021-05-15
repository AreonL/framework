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

        // dd($books);

        // $books = [
        //     'Nalle puh',
        //     'Pippi',
        //     'Byggaren bob'
        // ];

        // $arr = array();

        // $results = Book::select('select * from books where name = Nalle Puh');

        // dd($results);

        // foreach ($results as $res) {
        //     $arr[] = $res->name;
        // }

        return view('book', [
            // 'results' => $results,
            'books' => $books,
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