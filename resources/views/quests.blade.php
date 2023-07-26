@extends('layouts.app')
@section('content')
<div class="content">
    @if (count($errors) > 0)
        @foreach ($errors as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    @endif
    @if (count($userQuests) > 0)
        @foreach ($userQuests as $quest)
            <a href="/quests/{{ $quest->id }}">
                <div class="user_quest">
                    <p>Квест №{{ $quest->id }}</p>
                    @if ($quest->complete != 0)
                        <p>Прочитано</p>
                    @else
                        <p>Не прочитано</p>
                    @endif
                </div>
            </a>
        @endforeach
    @else
    <form action="/quests/add" method="post">
            @csrf
            <p>Выберите книгу, с которой начать:</p>
            <div>
                <select class="books_select" name="book_id">
                </select>
            </div>
            <p>Выберите главу, с которой начать:</p>
            <div>
                <select class="chapters_select" name="chapter_id">
                </select>
            </div>
            <button type="submit">Начать испытание</button>
        </form>
    @endif
</div>
<div class="quest_btn">
    <a href="/account">Назад</a>
</div>
<script src="/assets/js/startChallenge.js"></script>
@endsection