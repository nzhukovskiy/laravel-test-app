<h1>Hello!</h1>
@foreach ($articles as $article)
    <h2>{{$article->title}}</h2>
    <div>{{$article->description}}</div>
@endforeach