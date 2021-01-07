<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToReadBook;

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
        
        $books = ReadBook::where('user_id', \Auth::user()->id)->orderBy('title', 'asc')->get();
        
        return view('userReadBooks', compact('books'));
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
        if (ToReadBook::where($matchThese)->get() != null)
        {
            $toReadBook = new ToReadBook();
            $toReadBook->user_id = \Auth::user()->id;
            $toReadBook->book_id = $id;
            if ($toReadBook->save()) {
                return redirect()->route('bookbase');
            } else {
                return "Wystąpił błąd";
            }
        }
        else
        {
            return redirect()->route('bookbase')
                    ->with(['success' => false, 'message_type' => 'danger',
                    'message' => 'Posiadasz już tę książkę w swojej kolekcji.']);
        }

        return view('bookEditForm', compact('book'));
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
        //
    }
}
