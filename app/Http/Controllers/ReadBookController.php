<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\ToReadBook;
use App\Models\ReadBook;

class ReadBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // If a user is not logged in
        if (!\Auth::check()) {
            return view('welcome');
        }
        // Save all id's of user's read books
        $booksRefs = ReadBook::where('user_id', \Auth::user()->id)->get();
        $bookIdArr = array();
        foreach ($booksRefs as $ref) {
            array_push($bookIdArr, $ref->book_id);
        }
        // return books with proper id's
        $readBooks = Book::whereIn('id', $bookIdArr)->get();
        return view('userReadBooks', compact('readBooks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        // If a user is not logged in
        if (!\Auth::check()) {
            return redirect()->route('bookbase');
        }
        
        $matchThese = ['user_id' => \Auth::user()->id, 'book_id' => $id];
        
        // if book is in to-read books, we should remove it from there
        if (!ToReadBook::where($matchThese)->get()->isEmpty())
        {
            if (!ToReadBook::where($matchThese)->delete()) {
                return redirect()->route('bookbase')->with('error', 'Wystąpił błąd, spróbuj później');
            }
        }
        // if book is not in "read" collection     
        if (ReadBook::where($matchThese)->get()->isEmpty())
        {
            $readBook = new ReadBook();
            $readBook->user_id = \Auth::user()->id;
            $readBook->book_id = $id;
            if ($readBook->save()) {
                return redirect()->route('userReadBooks')->with('success', 'Dodano książkę do kolekcji');
            } else {
                return "Wystąpił błąd";
            }
        } else {
            return redirect()->route('bookbase')->with('error', 'Posiadasz już tę książkę w swojej kolekcji');
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // If a user is not logged in
        if (!\Auth::check()) {
            return redirect()->route('bookbase');
        }
        
        $matchThese = ['user_id' => \Auth::user()->id, 'book_id' => $id];
        if (!ReadBook::where($matchThese)->delete())
        {
            return redirect()->route('userReadBooks')->with(['success' => false,
                'message_type' => 'danger',
                'message' => 'Wystąpił błąd podczas usuwania książki z kolekcji. Spróbuj później']);
        }
        else
        {
            return redirect()->route('userReadBooks')->with('success', 'Pomyślnie usunięto książkę z kolekcji');
        }
    }
}
