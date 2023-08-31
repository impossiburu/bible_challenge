@extends('layouts.app')
@section('content')
<div class="content">
    <div class="user_info">
        <div class="user_info_basic">
            <div class="user_name">
                {{ Auth()->user()->name }}
            </div>
        </div>
    </div>
    <div class="user_data">
        <div class="user_notes">
            {{ count(Auth()->user()->notes) }}
            <div class="user_notes_title">
                Записей
            </div>
        </div>
        <div class="user_status">
            {{ Auth()->user()->level }}
            <div class="user_level_status">
                Уровень
            </div>
        </div>
    </div>
    <hr>
    <div class="profile_ctrl">
        <div class="settings_block">
            <a href="/account/settings"><i class="fa-solid fa-gear"></i></a>
        </div>
    </div>
</div>
<div class="notes_list">
    @if (count($userNotes) > 0)
        @foreach ($userNotes as $note)
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
                    <p class="note_date">{{ $note->created_at }}</p>
                </div>
            </div>
        @endforeach
        <div class="nav">
            {{ $userNotes->links() }}
        </div>
    @else
    <div class="btn_back">
        <a href="/notes/new"><i class="fa-regular fa-square-plus"></i></a>
    </div>
    @endif
</div>
<script src="//api.bibleonline.ru/ref/bible.js" type="text/javascript" charset="utf-8" defer="defer"></script>
@endsection