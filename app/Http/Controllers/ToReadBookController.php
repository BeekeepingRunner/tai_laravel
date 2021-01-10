<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToReadBook;
use App\Models\Book;

class ToReadBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // If a user is not logged in
        if (!\Auth::check()) {
            return view('welcome');
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
        // If a user is not logged in
        if (!\Auth::check()) {
            return redirect()->route('bookbase');
        }
        
        // Check if user already has this book in his collection
        $matchThese = ['user_id' => \Auth::user()->id, 'book_id' => $id];
        if (ToReadBook::where($matchThese)->get()->isEmpty())
        {
            $toReadBook = new ToReadBook();
            $toReadBook->user_id = \Auth::user()->id;
            $toReadBook->book_id = $id;
            if ($toReadBook->save()) {
                return redirect()->route('bookbase');
            } else {
                return "Wystąpił błąd";
            }
        } else {
            // TODO: komunikat o posiadaniu książki w kolekcji
            return redirect()->route('bookbase');
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
        if (!ToReadBook::where($matchThese)->delete())
        {
            return redirect()->route('userToReadBooks')->with(['success' => false,
                'message_type' => 'danger',
                'message' => 'Wystąpił błąd podczas usuwania książki z kolekcji. Spróbuj później']);
        }
        else
        {
            return redirect()->route('userToReadBooks')->with(['success' => true,
                'message_type' => 'success',
                'message' => 'Pomyślnie skasowano książkę z kolekcji.']);
        }
    }
}
