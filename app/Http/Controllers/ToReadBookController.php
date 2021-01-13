<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToReadBook;
use App\Models\ReadBook;
use App\Models\Book;

class ToReadBookController extends Controller
{
    public function redirectIfNotLoggedIn($routeName)
    {
        if (!\Auth::check()) {
            return redirect()->route($routeName);
        }
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!\Auth::check()) {
            return redirect()->route('bookbase');
        }

        // Save all id's of user's books to read
        $booksRefs = ToReadBook::where('user_id', \Auth::user()->id)->get();
        $bookIdArr = array();
        foreach ($booksRefs as $ref) {
            array_push($bookIdArr, $ref->book_id);
        }
        // return books with proper id's
        $booksToRead = Book::whereIn('id', $bookIdArr)->get();
        return view('userToReadBooks', compact('booksToRead'));
    }

    /**
     *
     */
    public function store($id)
    {
        if (!\Auth::check()) {
            return redirect()->route('bookbase');
        }

        $matchThese = ['user_id' => \Auth::user()->id, 'book_id' => $id];
        
        // If the book is in to-read collection, we should remove it from there
        if (!ReadBook::where($matchThese)->get()->isEmpty())
        {
            if (!ReadBook::where($matchThese)->delete()) {
                return redirect()->route('bookbase')->with('error', 'Wystąpił błąd, spróbuj później');
            }
        }
        
        // Check if user already has this book in his collection
        if (ToReadBook::where($matchThese)->get()->isEmpty())
        {
            $toReadBook = new ToReadBook();
            $toReadBook->user_id = \Auth::user()->id;
            $toReadBook->book_id = $id;
            if ($toReadBook->save()) {
                return redirect()->route('bookbase')->with('success', 'Dodano książkę do kolekcji');
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
        if (!\Auth::check()) {
            return redirect()->route('bookbase');
        }
        
        $matchThese = ['user_id' => \Auth::user()->id, 'book_id' => $id];
        if (!ToReadBook::where($matchThese)->delete())
        {
            return redirect()->route('userToReadBooks')->with(['success' => false,
                'message_type' => 'danger',
                'message' => 'Wystąpił błąd podczas usuwania książki z kolekcji. Spróbuj później']);
        }
        else
        {
            return redirect()->route('userToReadBooks')->with('success', 'Pomyślnie usunięto książkę z kolekcji');
        }
    }
    
    // Remove a book from books to read and send book id to ReadBookController
    public function markAsRead($id)
    {
        if (!\Auth::check()) {
            return redirect()->route('bookbase');
        }
        
        $userId = \Auth::user()->id;
        $matchThese = ['user_id' => $userId, 'book_id' => $id];
        if (!ToReadBook::where($matchThese)->delete())
        {
            return redirect()->route('userToReadBooks')->with(['success' => false,
                'message_type' => 'danger',
                'message' => 'Wystąpił błąd podczas przenoszenia książki. Spróbuj później']);
        }
        
        // save book in readbooks
        return redirect()->route('addAsRead', $id);
    }
    
    
}
