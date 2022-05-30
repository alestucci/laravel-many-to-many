@extends('layouts.app')

@section('title', 'Index')

@section('content')

<div class="container">
    @if (session('deleted'))
    <div class="alert alert-warning">{{ session('deleted') }}</div>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                <td>
                    <a class="btn btn-primary" href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                </td>
                <td>
                    <button class="btn btn-danger delete-button" data-id="{{ $category->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
<div id="background" class="d-none"></div>
<div id="alert-window" class="d-flex flex-column justify-content-evenly d-none">
    <h1 class="text-blue text-center">Confermi l'eliminazione?</h1>
    <div class="w-75 mx-auto d-flex justify-content-around">
        <form id="confirmation-form" method="POST" data-base="{{ route('admin.categories.index') }}">
            @csrf
            @method('DELETE')
            <button id="confirm-button" class="btn btn-outline-danger">Conferma</button>
        </form>
        <button id="cancel-button" class="btn btn-outline-secondary">Annulla</button>
    </div>
</div>

@endsection