@extends('layouts.app')

@section('scripts')
<script src="{{ asset('/js/imageUploading.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @auth
                <div class="card-header">{{ __('Edycja książki z bazy') }}</div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('updateBook', $book) }}" id="book-form" enctype="multipart/form-data">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        
                        <div class="form-group row{{ $errors->has('message')?'has-error':'' }}" id="roles-box">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Tytuł') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" name="title" value="{{ $book->title }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group row{{ $errors->has('message')?'has-error':'' }}" id="roles-box">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Autor') }}</label>
                            <div class="col-md-6">
                                <input id="author" type="text" name="author" value="{{ $book->author }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group row{{ $errors->has('message')?'has-error':'' }}" id="roles-box">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Opis') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" name="description" rows="6", cols="24" required>{{ $book->description }}</textarea>
                            </div>
                        </div>
                        
                        <!-- IMAGE UPLOAD -->
                        <div class="form-group row{{ $errors->has('message')?'has-error':'' }}" id="roles-box">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Zdjęcie') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="file" id="imgFile" accept="image/*" enctype="multipart/form-data" />
                                <br><br>
                                <img id="old-img-preview" src="{{ asset('storage/images/'.$book->img_src) }}" alt="old image" />
                                <img id="img-preview" src="#" alt="uploaded image" hidden />
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Zapisz zmiany') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endauth
            
            @guest
            <b>Zaloguj się aby dodać książkę.</b>
            @endguest
            </div>
        </div>
    </div>
</div>
@endsection
