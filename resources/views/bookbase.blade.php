@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="table-container">
            
            @if(\Session::has('error'))
            <div class="alert alert-warning">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
            @endif
            
            <div class="title">
                <h3>Wszystkie książki</h3>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Lp.</th>
                        <th>-</th>
                        <th>Tytuł</th>
                        <th>Autor</th>
                        <th>Opis</th>
                        @auth
                        <th>Akcja</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $i . '.' }}</td>
                            <td><image class="bookImg"
                                       src="{{ asset('storage/images/'.$book->img_src) }}"
                                       alt="book image"></td>
                            <td><b>{{ $book->title }}</b></td>
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
                    <?php
                    $i += 1;
                    ?>
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
