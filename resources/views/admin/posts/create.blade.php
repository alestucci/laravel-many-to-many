@extends('layouts.app')

@section('title', 'Aggiungi un post')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                {{-- TITOLO --}}
                <div class="mb-3">
                    <label for="title" class="form-label">{{__('Title')}}</label>
                    <input type="text" class="form-control" id="title" placeholder="{{__('Title')}}" name="title" value="{{ old('title') }}">
                </div>
                
                @error ('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- SLUG --}}
                <div class="mb-3">
                    <label for="slug" class="form-label">{{__('Slug')}}</label>
                    <input type="text" class="form-control" id="slug" placeholder="{{__('Slug')}}" name="slug" value="{{ old('slug') }}">
                    <input type="button" value="Genera Slug" id="slugger-btn" class="btn btn-secondary mt-1">
                </div>
                
                @error ('slug')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- CATEGORIA --}}
                <select name="category_id" id="category_id" class="form-select mb-3">
                    <option selected>Seleziona una categoria</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @if ($category->id == old('category_id')) selected @endif>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                
                @error ('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                {{-- CONTENUTO --}}
                <div class="mb-1">
                    <label for="content" class="form-label">{{__('Content')}}</label>
                    <textarea class="form-control" id="content" placeholder="{{__('Content')}}" rows="10" name="content">{{ old('content')}}</textarea>
                </div>

                @error ('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Salva</button>
            </form>
        </div>
    </div>


</div>

@endsection