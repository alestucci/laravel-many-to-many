@extends('layouts.app')

@section('title', 'Index')

@section('content')

<div class="container">
    @if (session('deleted'))
    <div class="alert alert-warning">{{ session('deleted') }}</div>
    @endif

    <form action="" method="GET">
        <div class="mb-3">
            <label for="search-string" class="form-label">{{ __('Stringa di ricerca') }}</label>
            <input type="text" class="form-control" id="search-string" name="s" value="{{ old('title') }}">
        </div>

        <select class="form-select mb-3" name="category" id="category">
            <option value="" selected>Seleziona una categoria</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <select class="form-select mb-3" name="author" id="author">
            <option value="" selected>Seleziona un autore</option>
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <button class="btn btn-primary">Filtra</button>
    </form>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Slug</th>
                <th scope="col">Autore</th>
                <th scope="col">Categoria</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td scope="row">{{ $post->id }}</td>
                <td scope="row"><a href="{{ route('admin.posts.show', $post->slug) }}">{{ $post->title }}</a></td>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->user_id }}</td>
                <td>{{ $post->category_id }}</td>
                <td>
                    @if (Auth::id() === $post->user_id)
                    <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->slug) }}">Edit</a>
                    @endif
                </td>
                <td>
                    @if (Auth::id() === $post->user_id)
                    <button class="btn btn-danger delete-button" data-id="{{ $post->slug }}">Delete</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
</div>
<div id="background" class="d-none"></div>
<div id="alert-window" class="d-flex flex-column justify-content-evenly d-none">
    <h1 class="text-blue text-center">Confermi l'eliminazione?</h1>
    <div class="w-75 mx-auto d-flex justify-content-around">
        <form id="confirmation-form" method="POST" data-base="{{ route('admin.posts.index') }}">
            @csrf
            @method('DELETE')
            <button id="confirm-button" class="btn btn-outline-danger">Conferma</button>
        </form>
        <button id="cancel-button" class="btn btn-outline-secondary">Annulla</button>
    </div>
</div>

@endsection