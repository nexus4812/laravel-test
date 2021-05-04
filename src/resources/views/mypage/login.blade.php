@extends('layouts.index')

@section('content')
    @csrf
    @include('error.index')
    <h1>ログイン</h1>
    <form action="post">
        <p><span>メールアドレス</span><input type="email" name="email" value="{{old('email')}}"></p>
        <p><span>パスワード</span><input type="password" name="password" value="{{old('password')}}"></p>
        <p><input type="submit" name="送信する"></p>
    </form>
@endsection
