@extends('layouts.app')
@section('content')
<div class="content">
    <div class="user_info">
        <div class="user_name">
            John
        </div>
        <div class="user_status">
            Only Jesus
        </div>
        <div class="user_data">
            <div class="user_notes">
                45
                <div class="user_notes_title">
                    Записей
                </div>
            </div>
            <div class="user_followers">
                1233
                <div class="user_followers_title">
                    Подписчиков
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="profile_ctrl">
        <div class="follow_block">
            <a href="">Подписаться</a>
        </div>
        <div class="settings_block">
            <i class="fa-solid fa-gear"></i>
        </div>
    </div>
    <div class="challenge_block">
        @if ($startChallenge)
            <div class="challenge_progress">
                <p>Прогресс</p>
                {{ $currentProgressBook }}
            </div>
        @endif
    </div>
</div>
<div class="content">
    <div class="notes_list">
        <div class="note">
            <div class="note_ctrl">
                <div class="note_ctrl_btn">
                    <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href=""><i class="fa-solid fa-xmark"></i></a>
                </div>
            </div>
            <blockquote>
                <p>Яви светлое лице Твое рабу Твоему; спаси меня милостью Твоею.</p>
                <footer>
                    <cite class="bibleref" onclick="return false;">Псалтирь 30:17</cite>
                </footer>
            </blockquote>
        </div>
    </div>
</div>
<script src="//api.bibleonline.ru/ref/bible.js" type="text/javascript" charset="utf-8" defer="defer"></script>
@endsection