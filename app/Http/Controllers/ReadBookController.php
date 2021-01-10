<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        if (ReadBook::where($matchThese)->get()->isEmpty())
        {
            $readBook = new ReadBook();
            $readBook->user_id = \Auth::user()->id;
            $readBook->book_id = $id;
            if ($readBook->save()) {
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
        //
    }
}
