@extends('layouts.app')

@section('title', 'Aggiungi una categoria')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                {{-- NOME --}}
                <div class="mb-3">
                    <label for="name" class="form-label">{{__('Name')}}</label>
                    <input type="text" class="form-control" id="name" placeholder="{{__('Name')}}" name="name" value="{{ old('name') }}">
                </div>
                
                @error ('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                {{-- DESCRIZIONE --}}
                <div class="mb-1">
                    <label for="description" class="form-label">{{__('Description')}}</label>
                    <textarea class="form-control" id="description" placeholder="{{__('Description')}}" rows="10" name="description">{{ old('description')}}</textarea>
                </div>

                @error ('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Salva</button>
            </form>
        </div>
    </div>


</div>

@endsection