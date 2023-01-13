<h1>Профиль пользователя</h1>
<div>
    Имя: {{$user->name}}
</div>
<div>
    Адрес эл. почты: {{$user->email}}
</div>
<h2>Ваши статьи</h2>
@foreach ($user->articles as $article)
    <div>{{$article->title}}</div>
    <div>{{$article->description}}</div>
    <a href="{{route("articles.edit", ["article" => $article])}}">Редактировать</a>
@endforeach
<form action="{{route("logout")}}" method="post">
    @csrf
    <input type="submit" value="Выйти">
</form>