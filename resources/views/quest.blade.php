@extends('layouts.app')
@section('content')
<div class="content">
    @if ($bibleChapters)
    <div class="quest_block">
        @if ($bibleChapters)
            <p><b>Книга {{ $bibleChapters['bookName'] }}. </b></p>
            @foreach ($bibleChapters['chapters'] as $chapters)
                <br>
                <p><b>Глава {{ $chapters['ChapterId'] }}. </b></p>
                <br>
                @foreach ($chapters['Verses'] as $verses)
                    <p><span class="vers_num">{{ $verses['VerseId'] }}</span>. {{ $verses['Text'] }}</p>
                @endforeach
            @endforeach
        @endif
    </div>
    @endif
    
    @if (count($errors) > 0)
        <div class="errors">
            @foreach ($errors->all() as $err)
                <p>{{ $err }}</p>
            @endforeach
        </div>
    @endif
</div>
@if ($quest->complete != 1)
<div class="quest_btn_back">
    <form action="/quests/finish" method="post">
        @csrf
        <input type="hidden" name="quest_id" value="{{ $quest->id }}">
        <button type="submit" style="background-color:transparent; border: none; cursor: pointer">Прочитано</button>
    </form>
</div>
@endif
<div class="quest_btn_back">
    <a href="/quests">Назад</a>
</div>
@endsection