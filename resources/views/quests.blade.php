@extends('layouts.app')
@section('content')
@if (count($userQuests) > 0)
    @foreach ($userQuests as $quest)
        <a href="/quests/{{ $quest->id }}">
            <div class="user_quest @if ($quest->complete != 0) done @endif">
                <p class="user_quest_title">Квест №{{ $quest->id }}</p>
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
<div class="btn_back">
    <a href="/account">Назад</a>
</div>
<script src="/assets/js/startChallenge.js"></script>
@endsection