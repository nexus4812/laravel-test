@extends('layouts.index')

@section('content')
    <ul>
        <li><a href="{{route('blog.list')}}">ブログ一覧</a></li>
    </ul>

    <h1>{{$blog->title}}</h1>

    <h2>{{$blog->user->name}}</h2>

    <div>
        {{nl2br($blog->body)}}
    </div>

    <h2 style="margin-top: 2em">コメント</h2>
    @foreach($blog->comments as $comment)
        <p> {{ $comment->body }} <span style="font-size: 0.7em">{{$comment->name}}</span></p>
    @endforeach
@endsection
