@extends('components/layout')
@section('content')
    <form action="" method="POST">
        @csrf
        <label for="name">Имя пользователя</label>
        <input type="text" name="name" id="name" value={{old('name')}}>

        <label for="password">Пароль</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Войти">
        <div>
            @foreach ($errors->all() as $message)
                <div class="error-message">{{$message}}</div>
            @endforeach
        </div>
    </form>
    <a href="{{route("register")}}">Зарегистрироваться</a>
@endsection