@extends('layouts.app')

@section('title', $category->name)

@section('content')

<div class="container">
    <h1 class="text-center">{{ $category->name }}</h1>
    <h2 class="font-italic">@if ($category->description) {{ $category->description }} @endif</h2>
</div>
    
@endsection