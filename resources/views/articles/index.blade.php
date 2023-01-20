@extends('components/layout')
@section('content')
    <h1>Hello!</h1>
    <div>
        @auth
            <a href={{route('profile')}}>Профиль</a>
        @else
            <a href={{route('login')}}>Войти</a>
        @endauth
    </div>
    @foreach ($articles as $article)
        <h2><a href={{route('articles.show', ['article' => $article])}}>{{$article->title}}</a></h2>
        <div>{{$article->description}}</div>
    @endforeach
@endsection