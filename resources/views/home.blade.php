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
                        <div class="card-body-interface d-flex flex-wrap">
                            <a class="btn btn-link" href="#">
                                Dodaj książkę
                            </a>
                            <a class="btn btn-link" href="#">
                                Moja kolekcja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
