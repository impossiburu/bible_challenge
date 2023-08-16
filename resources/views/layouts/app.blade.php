<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <title>BibleChallenge</title>
</head>
<body>
    <div class="container">
        @yield('content')
        @if (Auth::check())
            <div class="controls">
                <!-- <div class="control_public">
                    <a href="/feed"><i class="fa-solid fa-house"></i></a>
                </div> -->
                <!-- <div class="control_search">
                    <a href="/search"><i class="fa-solid fa-magnifying-glass"></i></a>
                </div> -->
                <div class="control_notes">
                    <a href="/notes/new" title="Новая мысль"><i class="fa-regular fa-square-plus"></i></a>
                </div>
                <div class="control_quests">
                    <a href="/quests" title="Квесты"><i class="fa-solid fa-list-check"></i></a>
                </div>
                <div class="control_profile">
                    <a href="/account" title="Профиль"><i class="fa-solid fa-user"></i></a>
                </div>
                <div class="control_exit">
                    <a href="/logout" title="Выход"><i class="fa-solid fa-right-from-bracket"></i></a>
                </div>
            </div>
        @endif
    </div>
</body>
</html>