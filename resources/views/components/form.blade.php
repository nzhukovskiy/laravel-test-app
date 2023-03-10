@extends('components/layout')
@section('content')
    <form action="{{$article->id ? route("articles.update", ["article" => $article]): route("articles.store")}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{$article->id ? method_field('PUT') : method_field('POST')}}
        <div>{{$article->id}}</div>
        <div>
            <label for="title">Заголовок</label>
            <input name="title" id="title" value="{{$article->title ? $article->title : old("title")}}">
        </div>
        
        <div>
            <label for="description">Текст</label>
            <textarea name="description" id="description">
                {{$article->description ? $article->description : old("description")}}
            </textarea>
        </div>
        <div>
            <label for="images[]">Загрузите изображения</label>
            <input type="file" name="images[]" id="images[]" multiple>
        </div>
        <input type="submit">
        <div>
            @foreach ($errors->all() as $error)
                <div>
                    {{$error}}
                </div>
            @endforeach
        </div>
    </form>
@endsection