@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mycard">
                <div class="card-header">{{ __('Panel użytkownika') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex flex-column">
                        <div class="card-body-userdata d-flex flex-wrap">
                            <img class="p-2" src="images/samples/userIcon.jpg" width="150" height="150" alt="sample user icon" style="flex: ">

                            <div class="p-2">
                                <h3>Dane użytkownika</h3>
                                <table class="table">
                                    <tr><td><b>Nazwa</b></td><td>{{ Auth::user()->name }}</td></tr>
                                    <tr><td><b>Email</b></td><td>{{ Auth::user()->email }}</td></tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="card-body-interface flex-wrap">
                            
                            <div class="d-flex justify-content-center">
                                Kolekcje
                            </div>
                            <hr/>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-success border" href="{{ route('userReadBooks') }}">
                                    Przeczytane książki
                                </a>
                                <a class="btn btn-success border" href="{{ route('userToReadBooks') }}">
                                    Do przeczytania
                                </a>
                            </div>
                            <br />
                            
                            <div class="d-flex justify-content-center">
                                Baza książek
                            </div>
                            <hr/>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-primary" href="{{ route('addBookToBase') }}">
                                    Dodaj książkę
                                </a>
                                <a class="btn btn-link" href="{{ route('booksAddedByUser') }}">
                                    Dodane książki
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
