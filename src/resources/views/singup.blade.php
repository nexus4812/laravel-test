@extends('layouts.index')

@section('content')
    @include('error.index')
    <h1>ユーザー登録</h1>
    <form method="post" action="{{route('singup.post')}}">
        @csrf
        <p><span>名前</span><input type="text" name="name" value="{{old('name')}}"></p>
        <p><span>メールアドレス</span><input type="email" name="email" value="{{old('email')}}"></p>
        <p><span>パスワード</span><input type="password" name="password" value="{{old('password')}}"></p>
        <p><input type="submit" name="送信する"></p>
    </form>
@endsection
