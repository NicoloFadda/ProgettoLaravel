@extends('layouts.app')

@section('title', 'Modifica Libro')

@section('content')
    <main class="container">
        <section class="row">
            <div class="col-md-12 my-4">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Libri</a>
                    <a href="{{ route('authors.index') }}" class="btn btn-secondary">Autori</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Categorie</a>
                </div>
                <h2 class="mt-5 mb-4">Modifica Libro</h2>
            </div>
            <div class="col-md-5">
                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" placeholder="Il nome della Rosa" required>
                        <label for="title">Titolo</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control textarea-height" placeholder="Inserisci la descrizione" id="description" name="description">{{ $book->description }}</textarea>
                        <label for="description">Descrizione (opzionale)</label>
                    </div>
                    <div class="mb-3 form-floating nr_pages_width">
                        <input type="number" class="form-control" id="pages" name="pages" value="{{ $book->pages }}" placeholder="10">
                        <label for="pages">N° Pagine (opzionale)</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <select class="form-select" aria-label="Seleziona l'Autore" id="author" name="author_id" required>
                            <option selected>Seleziona l'Autore</option>
                            @foreach($authors as $autore)
                                <option value="{{ $autore->id }}" {{ $book->author_id == $autore->id ? 'selected' : '' }}>{{ $autore->name }}</option>
                            @endforeach
                        </select>
                        <label for="author">Autore</label>
                    </div>
                    <div class="mb-4 form-floating">
                        <select class="form-select" aria-label="Seleziona la Categoria" id="category" name="category_id" required>
                            <option selected>Seleziona la Categoria</option>
                            @foreach($categories as $categoria)
                                <option value="{{ $categoria->id }}" {{ $book->category_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                        <label for="category">Categoria</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="Copertina Libro" accept="image/*">
                        <label for="cover_image">Copertina del Libro (opzionale)</label>
                        <small class="form-text text-muted">Formato accettato: jpeg, png, jpg, gif. Max 2MB.</small>
                    </div>
                    <div class="pt-4 border-top">
                        <button type="submit" class="btn btn-primary me-3">Aggiorna Libro</button>
                        <a href="{{ route('books.index') }}" class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Annulla</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
