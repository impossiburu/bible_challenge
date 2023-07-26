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
</div>
<div class="quest_btn">
    <a href="/quests">Назад</a>
    @if ($quest->complete != 1)
        <form action="/quests/finish" method="post">
            @csrf
            <input type="hidden" name="quest_id" value="{{ $quest->id }}">
            <button type="submit">Прочитано</button>
        </form>
    @endif
</div>
@endsection