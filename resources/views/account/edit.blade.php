@extends('layouts.app')
@section('content')
<div class="content">
    <div class="local_block">
        <h1>Настройки</h1>
        @if (count($errors) > 0)
        <div class="errors">
             @foreach ($errors->all() as $err)
                <p>{{ $err }}</p>
            @endforeach
        </div>
        @endif
        <form action="/account/settings" method="post">
            @csrf
            <label for="name">Логин:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}">
            <label for="phone">Телефон:</label>
            <input type="number" id="phone" pattern="pattern="[0-9]{11}" min="11" name="phone" value="{{ $user->phone }}">
            <button type="submit">Сохранить изменения</button>
        </form>
    </div>
    <a href="/logout"><i class="fa-solid fa-right-from-bracket"></i> Выйти</a>
</div>
<div class="btn_back">
    <a href="/account">Назад</a>
</div>
@endsection