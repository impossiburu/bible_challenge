<?php

use App\Entities\Bible;
use App\Http\Controllers\AuthController;
use App\Models\Note;
use App\Models\Quest;
use App\Models\User;
use App\Services\BibleService;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

/** Форма авторизации */
Route::get('/', function () {
    return view('login');
})->middleware('guest')->name('home');


/** Авторизация */
Route::post('/login', [AuthController::class, 'login'])->name('login_req')->middleware('guest');

/** Форма регистрации */
Route::get('/register', function () {
    return view('register');
});

/** Регистрация */
Route::post('/register', [AuthController::class, 'register'])->name('register_req');

/** Выход из аккаунта */
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/** Аккаунт пользователя */
Route::get('/account', function () {
    $userUncompleteQuest = Quest::where('complete', '<>', 1)->first();
    $userNotes = Note::where('user_id', Auth()->user()->id)->simplePaginate(3);

    return view('account.account', [
        'startChallenge' => null,
        'currentProgressBook' => $userUncompleteQuest,
        'userNotes' => $userNotes,
    ]);
})->middleware('auth');

/** Форма настройки аккаунта */
Route::get('/account/settings', function () {
    $currentUser = User::find(Auth()->user()->id);

    return view('account.edit', [
        'user' => $currentUser,
    ]);
})->middleware('auth');

/** Сохранение настроек аккаунта */
Route::post('/account/settings', function (Request $request) {
    $fields = Validator::make($request->only(['name', 'phone', 'email']), [
        'phone' => 'numeric|digits:10',
        'email' => 'email',
        'name' => 'alpha_num|min:3',
    ]);

    if ($fields->fails()) {
        return back()->withErrors($fields);
    }

    $user = User::find(Auth()->user()->id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->save();

    return redirect('/account');
})->middleware('auth');

/** Список всех квестов */
Route::get('/quests', function () {
    $userQuests = User::find(Auth()->user()->id)->quests()->get();
    $bibleService = new BibleService(new Bible());
    $bibleBookNames = $bibleService->getBibleNames();

    return view('quests', [
        'userQuests' => $userQuests,
        'bookNames' => $bibleBookNames,
    ]);
})->middleware('auth');

/** Стартовое создание квеста (Бытие 1:1) */
Route::post('/quests/add', function (Request $request) {

    Quest::create([
        'user_id' => Auth()->user()->id,
        'book_id' => $request->book_id,
        'chapter_id' => $request->chapter_id,
    ]);

    return redirect('/account');
});

/** Детальная страница квеста */
Route::get('/quests/{id}', function ($id) {
    $quest = Quest::find($id);
    $quest->updated_at = Carbon::now('Europe/Moscow');
    $quest->save();

    $bibleService = new BibleService(new Bible());

    return view('/quest', [
        'bibleChapters' => $bibleService->bible->getCurrentDayBibleChapters($quest->book_id, $quest->chapter_id),
        'quest' => $quest,
    ]);
});

/**  Завершение квеста */
Route::post('/quests/finish', function (Request $request) {
    $quest = Quest::find($request->quest_id);
    //TODO
    $timesLeft = Carbon::parse($quest->updated_at)->diffInMinutes(Carbon::now('Europe/Moscow'));
    // если разница меньше 3-х минут после открытии квеста
    if ($timesLeft < 3) {
        return back()->withErrors('Наверное ты сверхчеловек, раз читаешь так быстро :)');
    }

    $quest->complete = true;
    $quest->save();

    return redirect('/quests');
});

/** Форма создание новой записи */
Route::get('/notes/new', function() {
    return view('note.new');
})->middleware('auth');

/** Создание новой записи */
Route::post('/notes/new', function(Request $request) {
    $fields = Validator::make($request->only(['text', 'verse']), [
        'verse' => 'nullable',
        'text' => 'min:3',
    ]);

    if ($fields->fails()) {
        return back()->withErrors($fields);
    }

    Note::create([
        'user_id' => Auth()->user()->id,
        'text' => $request->text,
        'verse' => $request->verse ?? '',
    ]);

    return redirect('/notes');
})->middleware('auth');

/** Форма редактирования записи */
Route::get('/notes/edit/{id}', function($id) {
    $note = Note::find($id);
    if (!$note) {
        abort(404);
    }
    return view('note.edit', ['note' => $note]);
})->middleware('auth')->name('note_edit');

/** Редактирование записи */
Route::post('/notes/edit/{id}', function($id, Request $request) {
    $fields = Validator::make($request->only(['text', 'verse']), [
        'verse' => 'nullable',
        'text' => 'min:3',
    ]);

    if ($fields->fails()) {
        return back()->withErrors($fields);
    }
      
    $note = Note::find($id);
    if (!$note) {
        abort(404);
    }
    $note->text = $request->text;
    $note->verse = $request->verse ?? '';
    $note->save();

    return redirect('/notes');
})->middleware('auth')->name('note_edit_store');

/** Список всех записей */
Route::get('/notes', function() {
    $notes = Note::where('user_id', Auth()->user()->id)->get();
    return view('note.list', ['notes' => $notes]);
})->middleware('auth');

/** Удаление записи */
Route::get('/notes/delete/{id}', function($id) {
    $note = Note::find($id);
    if (!$note) {
        abort(404);
    }
    $note->delete();

    return redirect('/account');
})->middleware('auth')->name('note_delete');

// ajax method only
Route::get('/account/bible', function(Request $request) {
    if ($request->ajax()) {
        $bibleService = new BibleService(new Bible());
        return $bibleService->bibleBookAjax();
    }
    abort(404);
    
})->middleware('auth');

