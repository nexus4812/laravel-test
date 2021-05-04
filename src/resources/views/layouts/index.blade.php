<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link type="text/css" rel="stylesheet" href="/css/style.css">
</head>
<body>

<ul>
    @if(! \Illuminate\Support\Facades\Auth::user())
        <li><a href="{{route('singup.get')}}">ユーザー登録</a></li>
        <li><a href="{{route('login.get')}}">ログイン</a></li>
    @endif

    @if(\Illuminate\Support\Facades\Auth::user())
        <li><a href="{{route('logout')}}">ログアウト</a></li>
    @endif

    <li><a href="{{route('blog.list')}}">ブログ一覧</a></li>
</ul>

@yield('content')

</body>
</html>
