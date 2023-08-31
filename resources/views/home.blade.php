@extends('layouts.app')
@section('content')
<div class="content">
    <h1 style="text-align:center"><i class="fa-solid fa-book-bible"></i> BibleChallenge App</h1>
    <p style="text-align:center">Изучай Библию, записывай свои мысли, набирай уровни</p>
</div>
<div class="btn_back">
    <a href="{{ route('login') }}">Вход</a>
</div>
@endsection