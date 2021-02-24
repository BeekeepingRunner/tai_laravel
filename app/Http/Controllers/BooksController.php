<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;

use App\Models\BookImage;
use App\Http\Controllers\BookImageController;

// use Illuminate\Support\Facades\DB;

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
        return view('addbooktobase', compact('book'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $book = new Book();
        $book->user_id = \Auth::user()->id;
        $book->title = $request->title;
        $book->author = $request->author;
        if ($request->description != null){
            $book->description = $request->description;
        }

        if ($request->file())   // if file has been uploaded by user
        {
            if (!$this->saveBookImage($request, $book))
            {
                return back()->with('error', 'Wystąpił błąd przy dodawaniu zdjęcia');
            }
        }
        
        if ($book->save()) {
            return redirect()->route('booksAddedByUser')->with('success', 'dodano książkę do bazy');
        }
        else {
            return back()->with('error', 'Wystąpił błąd przy dodawaniu książki');
        }
    }
    
    private function saveBookImage(BookRequest $request, Book $book)
    {
        $imgID = BookImageController::store($request);
        if ($imgID) {
            $book->img_id = $imgID;
            $image = BookImage::find($imgID);
            if ($image == null) {
                return false;
            }

            $book->img_src = substr($image->src, strlen('public/images/'));
            return true;
        }
        else {
            return false;
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
    
    public function showUserBooks()
    {
        $books = Book::where('user_id', \Auth::user()->id)->orderBy('title', 'asc')->get();
        
        return view('userBookBase', compact('books'));
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
        if ($book == null) {
            return back()->with('error', 'Nie ma takiej książki');
        }
        // Check if current user added the book to the base
        if (\Auth::user()->id != $book->user_id)
        {
            return back()->with('error', 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.');
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
    public function update(BookRequest $request, $id)
    {
        $book = Book::find($id);
        // Check if user is an owner of this book
        if(\Auth::user()->id != $book->user_id)
        {
            return back()->with('success', 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.');
        }
        // New values
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        
        // if a new image has been uploaded by the user
        if ($request->file())   
        {
            $oldImageID = $book->img_id;
            
            // save new image in DB and bind it to the book
            if (!$this->saveBookImage($request, $book))
            {
                return back()->with('error', 'Wystąpił błąd przy dodawaniu zdjęcia');
            }
            
            // delete old image from DB
            if ($oldImageID != null && $oldImageID != 1)
            {
                if (!BookImageController::destroy($imageID)) {
                    return back()->with('error', 'Wystąpił błąd podczas usuwania zdjęcia książki.'); // future exception
                }
            }
        }
        
        if($book->save()) {
            return redirect()->route('booksAddedByUser')->with('success', 'Pomyślnie zapisano zmiany');   // 'book added by user route' later
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
            return back()->with('success', 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.');
        }
        
        $imageID = $book->img_id;
        if (!$book->delete())
        {
            return back()->with('error', 'Wystąpił błąd podczas kasowania książki z bazy. Spróbuj później.');
        }

        if ($imageID != null && $imageID != 1)
        {
            if (!BookImageController::destroy($imageID)) {
                return back()->with('error', 'Wystąpił błąd podczas usuwania zdjęcia książki.'); // future exception
            }
        }
        
        return redirect()->route('booksAddedByUser')->with('success', 'Pomyślnie skasowano książkę z bazy.');
    }
}
