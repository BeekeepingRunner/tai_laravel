@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="table-container">
         
            @if(\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
            @endif
            
            <div class="title">
                <h3>Książki dodane przez Ciebie</h3>
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
                            <td>
                            @auth
                                @if($book->user_id == \Auth::user()->id)
                                
                                    <a href="{{ route('deleteBookFromBase', $book) }}"
                                       class="btn btn-danger btn-x"
                                       onclick="return confirm('Jesteś pewien?')"
                                       title="Skasuj"><i class="fa fa-trash-o"></i> Usuń
                                    </a>
                                    <a href="{{ route('editBook', $book) }}"
                                       class="btn btn-success btn-xs"
                                       title="Edytuj"> Edytuj
                                    </a>
                                @endif
                            @endauth
                            </td>
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
