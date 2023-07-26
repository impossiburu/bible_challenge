@extends('layouts.app')
@section('content')
<div class="container">
    <div class="auth_block">
        <h1>Войти</h1>
        <form action="{{ route('login_req') }}" method="post">
            @csrf
            <label for="phone">Телефон:</label>
            <input type="tel" id="phone" name="phone" placeholder="Введите ваш телефон">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" placeholder="Введите пароль"><br><br>
            <p>Нет аккаунта? <a href="/register">Регистрация</a></p>
            <button type="submit">Войти</button>
        </form>
    </div>
</div>
@endsection