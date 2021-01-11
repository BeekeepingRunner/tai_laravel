@extends('layouts.app')

@section('currentNavPage', 'Przeczytane')

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
                <h3>Twoje przeczytane książki</h3>
            </div>
  
            <table class="table">
                <thead>
                    <tr>
                        <th>Lp.</th>
                        <!-- <th>zdjęcie</th> -->
                        <th>Tytuł</th>
                        <th>Autor</th>
                        <th>Opis</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($readBooks as $book)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><b>{{ $book->title }}</b></td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->description }}</td>
                            <td>
                                <a href="{{ route('deleteFromRead', $book) }}"
                                   class="btn btn-danger btn-x"
                                   onclick="return confirm('Jesteś pewien?')"
                                   title="Skasuj"><i class="fa fa-trash-o"></i> Usuń
                                </a>
                                <!-- wystaw opinie -->
                            </td>
                        </tr>
                    <?php
                    $i += 1;
                    ?>
                    @endforeach
                 </tbody>
            </table>
        </div>     
    </div>
</div>
@endsection
