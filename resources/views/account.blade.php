@extends('layouts.app')
@section('content')
<div class="content">
    <a href="{{ route('logout') }}">Выйти</a>
    <div class="challenge_block">
        @if ($startChallenge)
            <div class="challenge_progress">
                <p>Прогресс</p>
                {{ $currentProgressBook }}
            </div>
        @endif
    </div>
</div>
@endsection