@extends('layouts.app')
@section('content')
<div class="notes_list">
    @if (count($notes) > 0)
        @foreach ($notes as $note)
            <div class="note">
                <div class="note_ctrl">
                    <div class="note_ctrl_btn">
                        <a href="{{ route('note_edit', $note->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{ route('note_delete', $note->id) }}"><i class="fa-solid fa-xmark"></i></a>
                    </div>
                </div>
                <div class="note_text">
                    <p>{{ $note->text }}</p>
                    <p class="bibleref" onclick="return false;">{{ $note->verse ?? '' }}</p>
                </div>
            </div>
        @endforeach
    @else
    <p>...а в ответ лишь тишина</p>
    @endif
</div>

<div class="quest_btn_back">
    <a href="/account">Назад</a>
</div>
@endsection