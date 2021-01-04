<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderby('id', 'asc')->get();
        return view('bookbase', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $book = new Book();
        return view('addBookToBase', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        if (\Auth::user() == null) {
            return view('bookbase');
        }
        $book = new Book();
        $book->user_id = \Auth::user()->id;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        if ($book->save()) {
            return redirect()->route('bookbase');
        }
        return "Wystąpił błąd";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        // Check if current user added the book to the base
        if (\Auth::user()->id != $book->user_id)
        {
            return back()->with(['success' => false, 'message_type' => 'danger',
                'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }
        return view('bookEditForm', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        //Sprawdzenie czy użytkownik jest autorem komentarza
        if(\Auth::user()->id != $book->user_id)
        {
            return back()->with(['success' => false, 'message_type' => 'danger',
                'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }
        // New values
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        if($book->save()) {
            return redirect()->route('bookbase');   // 'book added by user route' later
        }
        return "Wystąpił błąd.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        // Check if current user added the book to the base
        if (\Auth::user()->id != $book->user_id)
        {
            return back()->with(['success' => false, 'message_type' => 'danger',
                'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }
        if ($book->delete())
        {
            return redirect()->route('bookbase')->with(['success' => true,
                'message_type' => 'success',
                'message' => 'Pomyślnie skasowano książkę z bazy.']);
        }
        return back()->with(['success' => false, 'message_type' => 'danger',
                'message' => 'Wystąpił błąd podczas kasowania książki z bazy. Spróbuj później.']);
    }
}
