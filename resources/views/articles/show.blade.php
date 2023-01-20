@extends('components/layout')
@section('content')
    <h1 class="red">{{$article->title}}</h1>
    <div>
        Автор статьи: {{$article->user->name}}
    </div>
    <h2>Текст статьи</h2>
    <div>
        {{$article->description}}
    </div>
    @foreach ($article->images as $image)
        <img src={{Storage::url($image->path)}} alt="Image">
    @endforeach
@endsection