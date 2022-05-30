@extends('layouts.app')

@section('title', $category->name)

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- NOME --}}
                <div class="mb-3">
                    <label for="name" class="form-label">{{__('Name')}}</label>
                    <input type="text" class="form-control" id="name" placeholder="{{__('Name')}}" name="name" value="{{ old('name', $category->name) }}">
                </div>
                
                @error ('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                {{-- DESCRIZIONE --}}
                <div class="mb-1">
                    <label for="description" class="form-label">{{__('Description')}}</label>
                    <textarea class="form-control" id="description" placeholder="{{__('Description')}}" rows="10" name="description">{{ old('description', $category->description)}}</textarea>
                </div>

                @error ('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary">Salva</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ml-3">Back</a>
            </form>
        </div>
    </div>


</div>

@endsection