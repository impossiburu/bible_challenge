@extends('layouts.app')
@section('content')
<div class="content">
    <div class="local_block">
        <h1>Новая мысль</h1>
        @if (count($errors) > 0)
        <div class="errors">
            @foreach ($errors->all() as $err)
                <p>{{ $err }}</p>
            @endforeach
        </div>
        @endif
        <form action="/notes/new" method="post">
            @csrf
            <textarea name="text" id="note" cols="30" rows="10"></textarea>
            <label for="verse">Ссылка на текст из Библии (если выше стих)</label>
            <input type="text" name="verse" id="verse" placeholder="Иоанна 3:16">
            <button type="submit">Создать</button>
        </form>
    </div>
</div>
<div class="quest_btn_back">
    <a href="/account">Назад</a>
</div>
@endsection