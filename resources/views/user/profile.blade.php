@extends('components/layout')
@section('content')
    <h1>Профиль пользователя</h1>
    <div>
        Имя: {{$user->name}}
    </div>
    <div>
        Адрес эл. почты: {{$user->email}}
    </div>
    <h2>Ваши статьи</h2>
    <a href={{route("articles.create")}}>Создать статью</a>
    @foreach ($user->articles as $article)
        <div>------------</div>
        <h3>{{$article->title}}</h3>
        <div>{{$article->description}}</div>
        <a href="{{route("articles.edit", ["article" => $article])}}">Редактировать</a>
        <form action={{route('articles.destroy', ['article' => $article])}} method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Удалить">
        </form>
    @endforeach
    <form action="{{route("logout")}}" method="post">
        @csrf
        <input type="submit" value="Выйти">
    </form>
@endsection