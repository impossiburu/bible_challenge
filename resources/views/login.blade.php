@extends('layouts.app')
@section('content')
<div class="container">
    <div class="auth_block">
        <h1>Войти</h1>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $err)
                <ul>
                    <li>{{ $err }}</li>
                </ul>
            @endforeach
        @endif
        <form action="{{ route('login_req') }}" method="post">
            @csrf
            <label for="phone">Телефон:</label>
            <input type="number" pattern="[0-9]{11}" minlength="11" id="phone" name="phone" placeholder="9101234567">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" placeholder="Введите пароль"><br><br>
            <p>Нет аккаунта? <a href="{{ route('register') }}">Регистрация</a></p>
            <button type="submit">Войти</button>
        </form>
    </div>
</div>
@endsection