@extends('layouts.app')
@section('content')
<div class="content">
    <div class="local_block">
        <h1>Новая мысль</h1>
        @if (count($errors) > 0)
        <div class="errors">
            @foreach ($errors->all() as $err)
                <p>{{ $err }}</p>
            @endforeach
        </div>
        @endif
        <form action="{{ route('note_edit_store', $note->id) }}" method="post">
            @csrf
            <textarea name="text" id="note" cols="30" rows="10">{{ $note->text }}</textarea>
            <label for="verse">Ссылка на текст из Библии (если выше стих)</label>
            <input type="text" name="verse" id="verse" placeholder="Иоанна 3:16" value="{{ $note->verse ?? '' }}">
            <button type="submit">Сохранить изменения</button>
        </form>
    </div>
</div>
<div class="btn_back">
    <a href="/account">Назад</a>
</div>
@endsection