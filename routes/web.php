<?php

use App\Http\Controllers\AuthController;
use App\Models\Quest;
use App\Models\User;
use App\Services\BibleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->middleware('guest')->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('login_req')->middleware('guest');

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [AuthController::class, 'register'])->name('register_req');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/account', function () {
    $userUncompleteQuest = Quest::where('complete', '<>', 1)->first();

    return view('account', [
        'startChallenge' => null,
        'currentProgressBook' => $userUncompleteQuest,
    ]);
})->middleware('auth');

Route::get('/quests', function () {
    $userQuests = User::find(Auth()->user()->id)->quests()->get();
    $bible = new BibleService();
    $bibleBookNames = $bible->getBibleNames($bible);

    return view('quests', [
        'userQuests' => $userQuests,
        'bookNames' => $bibleBookNames,
    ]);
})->middleware('auth');

Route::post('/quests/add', function (Request $request) {
    Quest::create([
        'user_id' => Auth()->user()->id,
        'book_id' => $request->book_id,
        'chapter_id' => $request->chapter_id,
    ]);

    return redirect('/account');
});

Route::get('/quests/{id}', function ($id) {
    $quest = Quest::find($id)->first();
    $bibleService = new BibleService();
    $bibleService->setBookId($quest->book_id);
    $bibleService->setChapterId($quest->chapter_id);

    return view('/quest', [
        'bibleChapters' => $bibleService->getCurrentDayBibleChapters(),
        'quest' => $quest,
    ]);
});

Route::post('/quests/finish', function (Request $request) {
    $quest = Quest::find($request->quest_id)->first();
    $timesLeft = Carbon::parse($quest->created_at)->diffInMinutes(Carbon::now());
    // если разница меньше 3-х минут
    if ($timesLeft < 3) {
        return back()->withErrors('Наверное ты сверхчеловек, раз читаешь так быстро :)');
    }

    $quest->complete = true;
    $quest->save();

    return redirect('/quests');
});

Route::get('/account/bible', function() {
    $bible = new BibleService();
    return Response::json($bible->bible());
})->middleware('auth');

