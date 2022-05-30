@extends('layouts.app')

@section('title', $post->title)

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.posts.update', $post->slug) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- TITOLO --}}
                <div class="mb-3">
                    <label for="title" class="form-label">{{__('Title')}}</label>
                    <input type="text" class="form-control" id="title" placeholder="{{__('Title')}}" name="title" value="{{ old('title')? old('title') : $post->title }}">
                </div>

                @error ('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- SLUG --}}
                <div class="mb-3">
                    <label for="slug" class="form-label">{{__('Slug')}}</label>
                    <input type="text" class="form-control" id="slug" placeholder="{{__('Slug')}}" name="slug" value="{{ old('slug')? old('slug') : $post->slug }}">
                    <input type="button" value="Genera Slug" id="slugger-btn">
                </div>

                @error ('slug')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- CATEGORIA --}}
                <select name="category_id" id="category_id" class="form-select mb-3">
                    <option selected>Seleziona una categoria</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category', $post->category_id) ? 'selected' : ''}}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>

                @error ('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- CONTENUTO --}}
                <div class="mb-3">
                    <label for="content" class="form-label">{{__('Content')}}</label>
                    <textarea class="form-control" id="content" placeholder="{{__('Content')}}" rows="10" name="content">{{ old('content')? old('content') : $post->content }}</textarea>
                </div>
                @error ('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Salva</button>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary ml-3">Back</a>
            </form>
        </div>
    </div>


</div>

@endsection