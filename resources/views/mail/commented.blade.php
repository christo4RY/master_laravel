<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comment</title>
</head>
<body>
    <h1>Hi, {{$blog->author->name}}</h1>

    <p>
        Someone has commented on your blog post
        <a href="{{ route('blogs.show',['blog'=>$blog->id]) }}">
            {{ $blog->title }}
        </a>
    </p>

    <hr/>

    <p>
        <a href="{{ route('user.show', ['user' => auth()->user()->id]) }}">
            {{ auth()->user()->name }}
        </a> said:
    </p>

    <p>
        "{{ $content }}"
    </p>
</body>
</html>
