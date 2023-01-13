<form action="" method="POST">
    @csrf
    <label for="name">Имя пользователя</label>
    <input type="text" name="name" id="name">

    <label for="password">Пароль</label>
    <input type="password" name="password" id="password">
    <input type="submit">
    <div>
        @foreach ($errors->all() as $message)
            <div class="error-message">{{$message}}</div>
        @endforeach
    </div>
</form>
<a href="{{route("register")}}">Зарегистрироваться</a>