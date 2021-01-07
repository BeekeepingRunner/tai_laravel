@extends('layouts.app')

@section('currentNavPage', 'Książki')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="table-container">
            <div class="title">
                <h3>Wszystkie książki</h3>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Lp.</th>
                        <!-- <th>zdjęcie</th> -->
                        <th>Tytuł</th>
                        <th>Autor</th>
                        <th>Opis</th>
                        @auth
                        <th>Akcja</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->description }}</td>
                            @auth
                            <td>
                                <a href="{{ route('addToRead', $book) }}"
                                   class="btn btn-success btn-xs"
                                   title="toReadButton"> Dodaj do przeczytania
                                </a>
                                <a href="{{ route('addAsRead', $book) }}"
                                    class="btn btn-primary btn-xs"
                                   title="AsReadButton"> Dodaj do przeczytanych
                                </a>
                            </td>
                            @endauth
                        </tr>
                    @endforeach
                 </tbody>
            </table>
            <br>
            @auth
            <div class="footer-button">
                <a href="{{ route('addBookToBase') }}" class="btn btn-secondary">Dodaj książkę</a>
            </div>
            @endauth
        </div>     
    </div>
</div>
@endsection
