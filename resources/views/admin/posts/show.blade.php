@extends('layouts.app')

@section('title', $post->title)

@section('content')

<div class="container">
    <h1 class="text-center">{{ $post->title }}</h1>
    <p class="font-italic">{{ $post->user->name }} @isset($post->user->userInfo->phone) - {{ $post->user->userInfo->phone }} @endisset</p>
    <p class="text-decoration-underline">{{ $post->category->name }}</p>
    <p class="mt-3">{{ $post->content }}</p>
</div>
    
@endsection