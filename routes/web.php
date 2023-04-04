<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController; //会員登録
use App\Http\Controllers\IdeaWordController; //ファン会員の投稿データを扱う
use App\Http\Controllers\NetaMemoController;
use App\Http\Controllers\WorkInfoController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //
});

require __DIR__ . '/auth.php';

//
// 以降追加

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::middleware(['auth', 'user_type:0'])->group(function () {
    Route::get('/test1', function () {
        return view('test1');
    })->name('test1');

    Route::get('/test2', function () {
        return view('test2');
    })->name('test2');

    // ネタ帳
    // Route::get('/for_fan/netacho', [IdeaWordController::class, 'index'])->name('idea_words.index');
    // Route::get('/for_fan/netacho/create', [IdeaWordController::class, 'create'])->name('idea_words.create'); // 追加
    // Route::post('/for_fan/netacho', [IdeaWordController::class, 'store'])->name('idea_words.store');
    // Route::get('/for_fan/netacho/{id}', [IdeaWordController::class, 'show'])->name('idea_words.show');
});

Route::middleware(['auth', 'user_type:1'])->group(function () {
    Route::get('/test3', function () {
        return view('test3');
    })->name('test3');

    Route::get('/test4', function () {
        return view('test4');
    })->name('test4');
});

// Laravel Breeze のデフォルトルート
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post'); // ポストルートを追加
}); //guest=>ログインしていない場合のルート

// ログイン会員のみ可能なルート
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // そのうちファン会員のみ可能
    Route::middleware(['user_type:0'])->group(function () {
        // ネタ帳
        Route::get('/for_fan/netacho', [IdeaWordController::class, 'index_for_fan'])->name('idea_words.index_for_fan');
        Route::get('/for_fan/netacho/create', [IdeaWordController::class, 'create'])->name('idea_words.create');
        Route::post('/for_fan/netacho', [IdeaWordController::class, 'store'])->name('idea_words.store');
        Route::get('/for_fan/netacho/{id}', [IdeaWordController::class, 'show'])->name('idea_words.show');

        // our_work一覧
        Route::get('/for_fan/our_work', [WorkInfoController::class, 'our_work'])->name('work_infos.our_work');
    });

    // そのうち芸人会員のみ可能
    Route::middleware(['user_type:1'])->group(function () {
        // ネタ帳
        Route::get('/for_comedian/netacho', [IdeaWordController::class, 'index_for_comedian'])->name('idea_words.index_for_comedian'); //一覧を見る
        Route::post('/for_comedian/netacho', [NetaMemoController::class, 'store'])->name('neta_memos.store');
        // Route::post('/for_comedian/netacho', [\App\Http\Controllers\NetaMemoController::class, 'store'])->name('neta_memos.store');

        // my memos
        Route::get('/for_comedian/netacho/my_memos', [NetaMemoController::class, 'my_memos_for_comedian'])->name('neta_memos.my_memos_for_comedian');        // 一覧表示と並べ替え クラス指定はルール
        Route::post('/work_infos', [\App\Http\Controllers\WorkInfoController::class, 'store'])->name('work_infos.store');
    });
    //
}); //auth=>ログインしている場合のルート
