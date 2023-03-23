<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController; //会員登録
use App\Http\Controllers\IdeaWordController; //ファン会員の投稿データを扱う


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
    Route::get('/for_fan/netacho', [IdeaWordController::class, 'index'])->name('idea_words.index');
    Route::get('/for_fan/netacho/create', [IdeaWordController::class, 'create'])->name('idea_words.create'); // 追加
    Route::post('/for_fan/netacho', [IdeaWordController::class, 'store'])->name('idea_words.store');
    Route::get('/for_fan/netacho/{id}', [IdeaWordController::class, 'show'])->name('idea_words.show');
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

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
}); //auth=>ログインしている場合のルート

Route::resource('netacho', IdeaWordController::class);
//仮置き
