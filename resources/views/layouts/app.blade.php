<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css?{{ time() }}">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>BibleChallenge</title>
</head>
<body>
    <div class="container">
        @yield('content')
        @if (Auth::check())
            <div class="controls">
                <div class="control_notes">
                    <a href="/notes/new" title="Новая мысль"><i class="fa-regular fa-square-plus"></i></a>
                </div>
                <div class="control_quests">
                    <a href="/quests" title="Квесты"><i class="fa-solid fa-list-check"></i></a>
                </div>
                <div class="control_profile">
                    <a href="/account" title="Профиль"><i class="fa-solid fa-user"></i></a>
                </div>
                <div class="control_help">
                    <a href="" title="Обратная связь"><i class="fa-solid fa-circle-question"></i></a>
                </div>
            </div>
        @endif
    </div>
</body>
</html>