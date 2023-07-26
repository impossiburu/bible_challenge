@extends('layouts.app')
@section('content')
<div class="container">
    <div class="auth_block">
        <h1>Регистрация</h1>
        @if (count($errors) > 0)
            @foreach ($errors as $error)
                <ul>
                    <li>{{ $error }}</li>
                </ul>
            @endforeach
        @endif
        <form action="{{ route('register_req') }}" method="post">
            @csrf
            <label for="phone">Телефон:</label>
            <input type="tel" id="phone" name="phone" placeholder="9101234567">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" placeholder="Введите пароль">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Введите email">
            <p>Регистрируясь, вы даете согласие на обработку персональных данных</p>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
</div>
@endsection