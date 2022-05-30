<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <x-navbar color="dark"/>

        <div class="container mt-4">
            <div class="row">
                <div class="col-2">
                    <a href="{{ route('admin.posts.index') }}" class="d-block btn btn-warning my-2" >All Posts</a>
                    <a href="{{ route('admin.posts.create') }}" class="d-block btn btn-warning my-2" >New Post</a>
                    <a href="{{ route('admin.categories.index') }}" class="d-block btn btn-warning my-2" >All categories</a>
                    <a href="{{ route('admin.categories.create') }}" class="d-block btn btn-warning my-2" >New Category</a>
                </div>
                <div class="col-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
