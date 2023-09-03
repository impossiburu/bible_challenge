@extends('layouts.app')
@section('content')
@if (count($userQuests) > 0)
    @foreach ($userQuests as $quest)
        <a href="/quests/{{ $quest->id }}">
            <div class="user_quest @if ($quest->complete != 0) done @endif">
                <p class="user_quest_title" data-book="{{ $quest->book_id }}" data-chapter="{{ $quest->chapter_id }}">
                    {{ $quest->book_name }} {{ $quest->book_id + 1 }}:{{ $quest->chapter_id + 1 }}
                </p>
                <p></p>
                @if ($quest->complete == 1) 
                    Прочитано 
                @endif
            </div>
        </a>
    @endforeach
    {{ $userQuests->links() }}
    <!-- <script src="/assets/js/questInit.js?{{ time() }}"></script> -->
    @else
    @if (count($errors) > 0)
        <div class="errors">
            @foreach ($errors->all() as $err)
                <p>{{ $err }}</p>
            @endforeach
        </div>
    @endif
    <div class="content">
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
    </div>
    <script src="/assets/js/startChallenge.js?{{ time() }}"></script>
@endif
<div class="btn_back">
    <a href="/account">Назад</a>
</div>
@endsection