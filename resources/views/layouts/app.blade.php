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
        <div class="controls">
            <div class="control_public">
                <i class="fa-solid fa-house"></i>
            </div>
            <div class="control_search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="control_notes">
                <i class="fa-regular fa-square-plus"></i>
            </div>
            <div class="control_quests">
                <a href="/quests"><i class="fa-solid fa-list-check"></i></a>
            </div>
            <div class="control_profile">
                <a href="/account"><i class="fa-solid fa-user"></i></a>
            </div>
        </div>
    </div>
</body>
</html>