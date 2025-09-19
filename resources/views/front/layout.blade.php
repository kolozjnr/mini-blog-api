<!DOCTYPE html>
<html>
<head>
    <title>Mini Blog</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <header>
        <h1><a href="{{ route('blog.index') }}">Mini Blog</a></h1>
        <nav>
            <a href="{{ route('blog.index') }}">Home</a>
            <a href="{{ route('blog.create') }}">New Post</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
