@extends('layouts.app')

@section('currentNavPage', 'Książki')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        Ksiąążkii
        @auth
            Dodaaaj ksiąkę do bazy
        @endauth
    </div>
</div>
@endsection
